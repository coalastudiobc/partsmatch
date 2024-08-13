<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FulFilledOrder;
use App\Models\UserAddresses;
use App\Models\ShippmentAddressDetail;
use App\Models\ShippingAddress;
use App\Models\Order;
use GuzzleHttp\Client;
use Stripe\PaymentIntent;
use App\Models\ShippoPurchasedLabel;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

use App\Traits\ShippoTrait;

class shippmentController extends Controller
{
    use ShippoTrait;

    public function index()
    {
        $fulfilledShippmentIds = ShippoPurchasedLabel::whereNotNull('order_id')->pluck('order_id')->toArray();

        $fulfilledOrders = FulFilledOrder::with('orderDetails')
            ->whereNotIn('order_id', $fulfilledShippmentIds)
            ->latest()
            ->paginate(__('pagination.admin_paginaion_number'));
        return view('admin.shippment.index',compact('fulfilledOrders'));
    }

    public function getShippmentRates($fulfilled_id)
    {
        try
        {
       
            $result= $this->getFulFilledDbData($fulfilled_id);
            $orderId=$result->order_id;
            $url = 'https://api.goshippo.com/shipments/'.$result->fullfilled_ship_id;
            $headers = $this->getHeadersCurl();
    
            $responseOfShippo = $this->makeCurlRequest($url, $headers);
            if(is_null($responseOfShippo)){
                throw new \Exception('Something went wrong in curl request :  ' . $e->getMessage());
            }
            $responseShippoInArray=  json_decode($responseOfShippo);
            $stripeCustomer = auth()->user()->createOrGetStripeCustomer();
            $intent = auth()->user()->createSetupIntent();
       

    //    $endpoint='/shipments/'.$result->fullfilled_ship_id;
    //    $response_in_array=$this->makeGetRequest($endpoint);
    //    $endpoint='/addresses/'.$res->address_from;
    // //    $from_address=$this->makeGetRequest($endpoint);
    //    dd($result,$res,$res->address_from);
    //    dd($response_in_array);
   
        return view('admin.shippment.payment', compact( 'responseShippoInArray', 'stripeCustomer', 'intent','orderId'));
        } catch (\Exception $th) {
            toastr()->error($th->getMessage());
            return redirect()->route('admin.shippment.listing');
        }

    }

    public function getManualShippment($fulfilled_id)
    { 
        try
        {
            $result= $this->getFulFilledDbData($fulfilled_id);
            $deliveryAddress= ShippingAddress::where('order_id',$result->order_id)->first();
            $selectedPickAddressAndShipmentDetails=ShippmentAddressDetail::where('order_id',$result->order_id)->first();
            $pickaddress=  UserAddresses::find($selectedPickAddressAndShipmentDetails->selected_shippo_address);
            return view('admin.shippment.manual',compact('deliveryAddress','pickaddress','selectedPickAddressAndShipmentDetails','result'));
        } catch (\Exception $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function getFulfilledShippment()
    {
        $fulfilledIds = ShippoPurchasedLabel::pluck('order_id');
        $fulfilledOrders = $fulfilledIds->isNotEmpty() ? Order::whereIn('id', $fulfilledIds)->latest()->paginate(__('pagination.admin_paginaion_number')) : collect(); 
        return view('admin.shippment.fulfilled', compact('fulfilledOrders'));
    }
    
    public function createShippmentManual(Request $request,$fulfilled_id)
    {
        try
        {
            $decrypt_order_id= jsdecode_userdata($fulfilled_id);
            ShippoPurchasedLabel::create(
                [
                    'order_id'=>$decrypt_order_id,
                    'qr_code_url'=>$request->delivery_date,
                    'service_level_token'=>$request->shipment_title,
                ]);
                toastr()->success('Manual shippment label created successfully');
                return redirect()->route('admin.shippment.fulfilled.listing');
            }catch (\Exception $th) {
                toastr()->error($th->getMessage());
                return redirect()->back();
        }
    }
    public function createShippmentPayment(Request $request)
    {
        try {
            $res = $this->shippmentTranscation($request->rate_id, $request);
            $this->stripeTranscation($request);
            toastr()->success('Order fulfilled successfully');
            return redirect()->route('admin.shippment.listing');
        } catch (\Exception $th) {
            toastr()->error($th->getMessage());
            return redirect()->route('admin.shippment.listing');
        }
    }

    public function shippmentTranscation($rate_id, $request)
    {
        try {
            $rateDetails = $this->getRateDetails($rate_id);
            if(is_null($rateDetails)){
                throw new Exception("something went wrong in getting rate details".$th->getMessage());
                
            }
           $getOrderId= FulFilledOrder::where('fullfilled_ship_id',$rateDetails->shipment)->pluck('order_id')->first();
           if(is_null($rateDetails)){
            throw new Exception("Order id did not found: ".$th->getMessage());
            
            }
            $body = [
                "rate" => $rate_id,
                "async" => false,
                "label_file_type" => "PDF_4x6",
            ];
            $response = $this->createTransaction($body);
            if ($response->object_status == 'SUCCESS') {
                $rateDetails = $this->getRateDetails($rate_id);
                return  $this->storeRateDetails($rateDetails, $response, $request,$getOrderId);
            }
            else{
               return redirect()->back()->with(['error'=>$response->messages[0]]);
            }
        } catch (\Exception $th) {
            throw new \Exception('shippment_Transcation error:  ' . $e->getMessage());

        }
    }

    public function storeRateDetails($response, $masterResponse, $request,$getOrderId)
    {
        try {
            $data = [
                'order_id' => $getOrderId,
                'rate_id' => $response->object_id,
                'shippment_id' => $response->shipment,
                'amount' => $response->amount,
                'currency' => $response->currency,
                'rate_provider' => $response->provider,
                'service_level_token' => $response->servicelevel_token,
                'days' => $response->days,
                'result' => $masterResponse->object_status,
                'master_rateId' => $masterResponse->object_id,
                'tracking_number' => $masterResponse->tracking_number,
                'tracking_url' => $masterResponse->tracking_url_provider,
                'label_url' => $masterResponse->label_url,
            ];
            $chck = ShippoPurchasedLabel::create($data);
            if ($chck) {
                return true;
            }
        } catch (\Exception $e) {
            throw new \Exception('storing_RateDetail error:  ' . $e->getMessage());
        }
    }

    public function stripeTranscation($request)
    {
        try {
            DB::beginTransaction();

            \Stripe\Stripe::setApiKey(config('services.Stripe.stripe_secret'));
            $stripeResponse = $this->StripePayment($request); //makng stripe payment for orders
            DB::commit();
            return true;
        } catch (\Exception $th) {
            DB::rollback();
            throw new \Exception('stripe transaction error: ' . $th->getMessage());
        }
    }

    private function StripePayment($request)
    {
        return  PaymentIntent::create([
            'amount' => floatval($request->amount) * 100, // amount in cents
            'currency' => config('services.Stripe.currency'),//change according to country
            'customer' => $request->stripeCustomer_id,
            'payment_method' => $request->token,
            'confirmation_method' => 'manual',
            'confirm' => true,
            'description' => jsencode_userdata($request->rate_id),
            'metadata' => [
                'selected_rate' => jsencode_userdata($request->rate_id), // Add your custom order ID as metadata
            ],
            'return_url' => route('admin.shippment.listing')
        ]);
    }

    public function getFulFilledDbData($fulfilled_id)
    {
        try {
            $result= FulFilledOrder::find(jsdecode_userdata($fulfilled_id));
            if(is_null($result)){
                throw new \Exception('order id did not found:  ' . $e->getMessage());
            }
            return $result;
        } catch (\Throwable $th) {
            throw new \Exception('FulFilledOrder data not found:  ' . $e->getMessage());

        }
    }


}
