<?php

namespace App\Http\Controllers\Dealer;

use toastr;
use App\Models\Order;
use App\Models\Country;
use App\Models\Product;
use App\Models\OrderItem;
use App\Traits\ShippoTrait;
use App\Models\BuyerAddress;
use App\Models\OrderParcels;
use Illuminate\Http\Request;
use App\Models\UserAddresses;
use App\Models\ShippingAddress;
use Illuminate\Support\Str;
use App\Models\ShippmentCreation;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\ShippoPurchasedLabel;
use App\Http\Requests\ShippingAddressRequest;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class OrderController extends Controller
{
    use ShippoTrait;
    public function order()
    {
        // $ordersitem =  OrderItem::with('product', 'order')->whereRelation('product', 'products.user_id', auth()->user()->id)->orderByDesc('id')->get();
        $orders =  Order::with('orderItem')->where('order_for', auth()->id())->orderBy('created_at', 'DESC')->paginate(__('pagination.pagination_nuber'));
        return view('dealer.order.order_list', compact('orders'));
    }
    public function testing()
    {
        return view('dealer.order.products');
    }
    public function pickAddressOfShippment(Order $orderid)
    {
        $previousAddresses =  UserAddresses::where('user_id', auth()->user()->id)->where('type', 'Pickup')->get();
        $countries = Country::whereIn('name', ['Canada', 'United States'])->get();
        return view('dealer.order.pick_address', compact('countries', 'previousAddresses', 'orderid'));
    }
    public function productParcels(Request $request, Order $order)
    {
        // dd('here', $request->toArray());
        session()->put('selectedPickAddressId', $request->selectadress);
        session()->put('selectedOrderId', $order->id);
        $orderProducts = OrderItem::with('product')->where('order_id', $order->id)->get();
        $orderProducts1 = OrderItem::where('order_id', $order->id)->pluck('id');
        $groups = OrderParcels::with('ordeItems')->whereIn('orderItem_id', $orderProducts1)->get()->groupBy('parcel_id');
        if ($groups && count($groups)) {
            return view('dealer.order.product_parcel', compact('groups'));
        }
        foreach ($orderProducts as $key => $orderProduct) {
            OrderParcels::updateOrCreate(
                ['orderItem_id' => $orderProduct->id],
                ['product_id' => $orderProduct->product_id, 'parcel_id' => Str::random(5), 'status' => 0]
            );
        }
        return view('dealer.order.product_parcel', compact('orderProducts'));
    }
    public function addressDelete(UserAddresses $address)
    {
        try {
            $address->delete();
            toastr()->success('Address has been Deleted successfully.');
            return redirect()->back();
        } catch (\Exception $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }
    public function picking_address(ShippingAddressRequest $request)
    {
        try {
            $shippoResponse = $this->address($request);
            if ($shippoResponse->object_state == "VALID") {
                $shippo_address_id = $shippoResponse->object_id;
                $addresstype = 'Pickup';
                $this->storeAddress($request, $addresstype, $shippo_address_id);
                $data = ['status' => true, 'message' => "Picking address added successfully"];
                return response()->json($data);
            }
            $error_code = $shippoResponse->messages[0]->code;
            // $error_type = $shippoResponse->messages[0]->type;
            $error_text = $shippoResponse->messages[0]->text;
            $data = ['status' => false,  'message' => $error_text];
            return response()->json($data);
        } catch (\Exception $e) {
            $data = ['status' => false,  'message' => $e->getMessage()];
            return response()->json($data);
        }
    }
    public function productDimension(Request $request, $product)
    {
        try {
            $decodedDimensionsJSON = urldecode($product);
            $orderItemId = json_decode($decodedDimensionsJSON);


            $parcel_id =  $this->createParcel($request);
            if (gettype($orderItemId) !== 'integer') {
                foreach ($orderItemId as $key => $value) {
                    $orderItem = OrderItem::where('id', $value)->first();
                    OrderParcels::updateOrCreate(
                        ['orderItem_id' => $orderItem->id, 'product_id' => $orderItem->product_id],
                        ['parcel_id' => $parcel_id, 'status' => 1]
                    );
                }
            }
            $orderItem = OrderItem::where('id', $orderItemId)->first();
            OrderParcels::updateOrCreate(
                ['orderItem_id' => $orderItemId, 'product_id' => $orderItem->product_id],
                ['parcel_id' => $parcel_id, 'status' => 1]
            );
            $data = ['status' => true,  'message' => 'Product dimensions data saved successfully.'];
            return response()->json($data);
        } catch (\Throwable $th) {
            $data = ['status' => false,  'message' => $th->getMessage()];
            return response()->json($data);
        }
    }
    public function createShippment()
    {

        try {
            $selected_order_id = session()->get('selectedPickAddressId');
            if ($selected_order_id) {
                $pickupAddress = UserAddresses::where('id', session()->get('selectedPickAddressId'))->first();
                // session()->forget('selectedPickAddressId');
            }
            $selected_order_id = session()->get('selectedOrderId');
            if ($selected_order_id) {
                $to_address = BuyerAddress::where('order_id', $selected_order_id)->pluck('shippo_address_id')->first();
                $reciever_address = ShippingAddress::where('order_id', $selected_order_id)->first();
                $getOrderItemIds =  OrderItem::where('order_id', session()->get('selectedOrderId'))->get();
                // session()->forget('selectedOrderId');
            }
            //storing parcels into single array
            $parcelsIdInArray = [];
            foreach ($getOrderItemIds as $key => $value) {
                $parcelsIdInArray[] = OrderParcels::where('orderItem_id', $value->id)->pluck('parcel_id')->first();
            }
            // dd($parcelsIdInArray);

            $body = [
                "address_from" => $pickupAddress->shippo_address_id,
                "address_to" => $to_address,
                "parcel" => $parcelsIdInArray,
                "object_purpose" => "PURCHASE",
                "async" => false,
                "shipment_date" => $this->getCurrentTimeFormatted()
            ];

            $guzzleRequest = new GuzzleRequest(
                'POST',
                'shipments/', // endpoint path relative to base_uri
                $this->headerApi(),
                json_encode($body)
            );

            $promise = $this->Client()->sendAsync($guzzleRequest)->then(function ($response) {
                return $response->getBody()->getContents();
            });
            $res = $promise->wait();
            $response_in_array = json_decode($res);
            if ($response_in_array->object_status == "SUCCESS") {
                // $parcel_id_result = $response_in_array->object_id;
                $data = [
                    'user_id' => auth()->user()->id,
                    'address_to' => $to_address,
                    'address_from' => $pickupAddress->shippo_address_id,
                    'shippment_id' => $response_in_array->object_id,
                    'shippment_date' => $this->getCurrentTimeFormatted(),
                ];
                $this->saveInDb($data, $parcelsIdInArray);
                $stripeCustomer = auth()->user()->createOrGetStripeCustomer();
                $intent = auth()->user()->createSetupIntent();
                return view('dealer.order.payment', compact('pickupAddress', 'response_in_array', 'stripeCustomer', 'intent', 'reciever_address'));
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    public function saveInDb($data, $parcelsIdInArray = null)
    {
        try {
            DB::beginTransaction();
            if ($parcelsIdInArray) {
                foreach ($parcelsIdInArray as $item) {
                    // dump($parcelsIdInArray, $item);
                    ShippmentCreation::where('parcel_id', $item)->update($data);
                }
            } else {
                // dump($data);
                ShippmentCreation::updateOrCreate($data); //update the where parcel id match which comes from shippment function
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('storing in database: ' . $e->getMessage());
        }
    }
    public function shippmentPayment(Request $request)
    {
        try {
            $res = $this->shippmentTranscation($request->rate_id);
            $this->stripeTranscation($request);
            toastr()->success('Shippment created successfully');
            return redirect()->route('Dealer.order.orderlist');
        } catch (\Exception $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }
    public function shippmentTranscation($rate_id)
    {
        try {
            $body = [
                "rate" => $rate_id,
                "async" => false,
                "label_file_type" => "PDF_4x6",
            ];
            $response = $this->createTransaction($body);
            if ($response->object_status == 'SUCCESS') {
                $rateDetails = $this->getRateDetails($rate_id);
                return  $this->storeRateDetails($rateDetails, $response);
            }
        } catch (\Exception $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }
    public function storeRateDetails($response, $masterResponse)
    {
        try {
            $data = [
                'order_id' => session()->get('selectedOrderId'),
                'rate_id' => $response->object_id,
                'shippment_id' => $response->shipment,
                'amount' => $response->amount,
                'currency' => $response->currency,
                'rate_provider' => $response->provider,
                'service_level_token' => $response->servicelevel_token,
                'days' => $response->days,
                'result' => $masterResponse->object_status,
                'master_rateId' => $masterResponse->rate,
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
            'currency' => 'usd',
            'customer' => $request->stripeCustomer_id,
            'payment_method' => $request->token,
            'confirmation_method' => 'manual',
            'confirm' => true,
            'description' => jsencode_userdata($request->rate_id),
            'metadata' => [
                'selected_rate' => jsencode_userdata($request->rate_id), // Add your custom order ID as metadata
            ],
            'return_url' => route('Dealer.order.orderlist')
        ]);
    }
}
