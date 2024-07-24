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
use App\Models\ShippmentCreation;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingAddressRequest;

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
    public function productDimension(Request $request, OrderItem $product)
    {
        try {
            $parcel_id =  $this->createParcel($request);
            OrderParcels::updateOrCreate(
                ['orderItem_id' => $product->id, 'product_id' => $product->product_id],
                ['parcel_id' => $parcel_id]
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
            $pickupAddress = UserAddresses::where('id', session()->get('selectedPickAddressId'))->first();
            $to_address = BuyerAddress::where('order_id', session()->get('selectedOrderId'))->pluck('shippo_address_id')->first();
            $parcelsIdInArray = [];
            $getOrderItemIds =  OrderItem::where('order_id', session()->get('selectedOrderId'))->get();

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
                    'user_id' => $pickupAddress->shippo_address_id,
                    'address_to' => $to_address,
                    'address_from' => $to_address,
                    'shippment_id' => $response_in_array->object_id,
                    'shippment_date' => $this->getCurrentTimeFormatted(),
                ];
                $this->saveInDb($data, $parcelsIdInArray);
                $stripeCustomer = auth()->user()->createOrGetStripeCustomer();
                $intent = auth()->user()->createSetupIntent();

                return view('dealer.order.payment', compact('pickupAddress', 'response_in_array', 'stripeCustomer', 'intent'));
            }
        } catch (\Exception $e) {
            throw new \Exception('shipmeerror: ' . $e->getMessage());
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
    public function shippmentPayment()
    {
        return true;
    }
}
