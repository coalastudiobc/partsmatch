<?php

namespace App\Http\Controllers\Dealer;

use toastr;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Country;
use App\Models\Product;
use App\Models\OrderItem;
use Stripe\PaymentIntent;
use App\Traits\ShippoTrait;
use Illuminate\Support\Str;
use App\Models\BuyerAddress;
use App\Models\OrderParcels;
use Illuminate\Http\Request;
use App\Models\UserAddresses;
use App\Models\FulFilledOrder;
use App\Models\ShippingAddress;
use App\Models\ShippmentCreation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ShippoPurchasedLabel;
use App\Models\ShippmentAddressDetail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ShippingAddressRequest;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class OrderController extends Controller
{
    use ShippoTrait;
    public function order()
    {
        try {
            // $orderIds = Order::where('order_for', auth()->id())->pluck('id')->toArray();
            // if (empty($orderIds)) {
            //     return redirect()->back()->with(['error' => 'No orders found for the authenticated user.']);
            // }

            // $fulfilledIds = ShippoPurchasedLabel::whereIn('order_id', $orderIds)->pluck('order_id')->toArray();

            // $fulfilledIds = FulFilledOrder::whereIn('order_id', $orderIds)->pluck('order_id')->toArray();

            // if (empty($fulfilledIds)) {
            //     return redirect()->back()->with(['info' => 'No fulfilled shipments found for the orders.']);
            // }
            $fulfilledIds = FulFilledOrder::forUser(auth()->id());
        
            $orders =  Order::forUser(auth()->id())
                ->notFulfilled($fulfilledIds)
                ->orderBy('created_at', 'DESC')
                ->paginate(__('pagination.pagination_nuber'));
        

            // $orders = Order::whereIn('id', $orderIds)
            // ->when(!empty($fulfilledIds), function ($query) use ($fulfilledIds) {
            //     return $query->whereNotIn('id', $fulfilledIds);
            // })
            // ->orderBy('created_at', 'DESC')
            // ->paginate(__('pagination.pagination_nuber'));

            // $orders = Order::whereIn('id', $orderIds)->whereNotIn('id', $fulfilledIds)->orderBy('created_at', 'DESC')->paginate(__('pagination.pagination_nuber'));
            // $orders =  Order::with('orderItem')->where('order_for', auth()->id())->orderBy('created_at', 'DESC')->paginate(__('pagination.pagination_nuber'));
            return view('dealer.order.order_list', compact('orders'));
        } catch (\Exception $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function fullfilledShippment()
    {
        try {
            // $orderIds = Order::where('order_for', auth()->id())->pluck('id')->toArray();
            // if (empty($orderIds)) {
            //     return redirect()->back()->with([
            //         'error' => 'No orders found for the authenticated user.'
            //     ]);
            // }

            // $fulfilledIds = ShippoPurchasedLabel::whereIn('order_id', $orderIds)->pluck('order_id')->toArray();
            // $fulfilledOrders = Order::whereIn('id', $fulfilledIds)->latest()->get();

            // $fulfilledOrders = FulFilledOrder::whereIn('user_id', auth()->id())->latest()->get();
            $fulfilledOrders = FulFilledOrder::with('orderDetails')->fulFilledOrders()->get();
            return view('dealer.order.fullfilled_order', compact('fulfilledOrders'));
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function testing()
    {
        return view('dealer.order.products');
    }
    public function pickAddressOfShippment(Order $orderid)
    {
        try {
            $getSelectedStuff = ShippmentAddressDetail::where('order_id', $orderid->id)->where('user_id', auth()->id())->first();
            $previousAddresses =  UserAddresses::where('user_id', auth()->user()->id)->where('type', 'Pickup')->get();
            $countries = Country::whereIn('name', ['Canada', 'United States'])->get();
            if (!is_null($getSelectedStuff)) {
                return view('dealer.order.pick_address', compact('countries', 'previousAddresses', 'orderid', 'getSelectedStuff'));
            }
            return view('dealer.order.pick_address', compact('countries', 'previousAddresses', 'orderid'));
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function productParcels(Request $request, Order $order)
    {
        // $messages = [
        //     'date.required' => 'The date is required.',
        //     'date.date' => 'The date must be a valid date.',
        //     'date.after_or_equal' => 'The date must be today or a future date.',
        // ];

        // $request->validate([
        //     'date' => 'required|date|after_or_equal:today',
        //     'selectadress' => 'required',
        // ], $messages);
        $validator = Validator::make($request->all(), [
            'date' => 'required|date|after_or_equal:today',
            'selectadress' => 'required',
        ], [
            'date.required' => 'The date is required.',
            'date.date' => 'The date must be a valid date.',
            'date.after_or_equal' => 'The date must be today or a future date.',
        ]);
        try {
            if ($validator->fails()) {
                toastr()->error($validator->errors()->first());
                return redirect()->back();
            }
            $this->savingShippmentDateandAddress($request, $order);
            session()->put('selectedPickAddressId', $request->selectadress);
            $orderProducts = OrderItem::with('product', 'parcel')->where('order_id', $order->id)->get();
            foreach ($orderProducts as $single) {
                $check = OrderParcels::where('orderItem_id', $single->id)->first();
                if (!$check) {
                    OrderParcels::updateOrCreate(
                        ['orderItem_id' => $single->id, 'product_id' => $single->product_id],
                        ['parcel_id' => random_int(10000, 99999), 'status' => 0]
                    );
                }
            }
            $groups = groupWith($orderProducts[0]->getOrderIdsWithSameParcel());
            return view('dealer.order.product_parcel', compact('order', 'groups'));
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
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
    public function productDimension(Request $request)
    {
        try {
            $products = explode(',', $request->products);
            $parcel_id =  $this->createParcel($request);
            $orderProducts = OrderItem::with('product', 'parcel')->where('order_id', $request->order_id)->whereIn('product_id', $products)->get();
            foreach ($orderProducts as $singleItem) {
                OrderParcels::updateOrCreate(
                    ['orderItem_id' => $singleItem->id, 'product_id' => $singleItem->product_id],
                    ['parcel_id' => $parcel_id, 'status' => 1]
                );
            }
            $orderProducts = OrderItem::with('product', 'parcel')->where('order_id', $request->order_id)->get();
            foreach ($orderProducts as $single) {
                $check = OrderParcels::where('orderItem_id', $single->id)->first();
                if (!$check) {
                    OrderParcels::updateOrCreate(
                        ['orderItem_id' => $single->id, 'product_id' => $single->product_id],
                        ['parcel_id' => random_int(10000, 99999), 'status' => 0]
                    );
                }
            }
            $groups = groupWith($orderProducts[0]->getOrderIdsWithSameParcel());
            $all_order_parcels = view('components.group-parcel', ['groups' => $groups])->render();
            $data = ['status' => true,  'payment' => isFullFilledOrder($orderProducts[0]->order_id), 'data' => $all_order_parcels, 'paymentUrl' => route('Dealer.order.shippment.rates', ['order' => $orderProducts[0]->order_id]), 'message' => 'Product dimensions data saved successfully.', 'change_at' => $request->element_to_change];
            return response()->json($data);
        } catch (\Throwable $th) {
            $data = ['status' => false,  'message' => $th->getMessage()];
            return response()->json($data);
        }
    }

    public function createGroups(Request $request)
    {
        try {
            $products = $request->product_ids;
            $parcel_dummy = random_int(10000, 99999);
            foreach ($products as $product) {
                $orderItem = OrderItem::where('id', $product)->first();
                OrderParcels::updateOrCreate(
                    ['orderItem_id' => $orderItem->id, 'product_id' => $orderItem->product_id],
                    ['parcel_id' => $parcel_dummy, 'status' => 0]
                );
            }
            $orderProducts = OrderItem::with('product', 'parcel')->where('order_id', $request->order_id)->get();
            foreach ($orderProducts as $single) {
                $check = OrderParcels::where('orderItem_id', $single->id)->first();
                if (!$check) {
                    OrderParcels::updateOrCreate(
                        ['orderItem_id' => $single->id, 'product_id' => $single->product_id],
                        ['parcel_id' => random_int(10000, 99999), 'status' => 0]
                    );
                }
            }
            $groups = groupWith($orderProducts[0]->getOrderIdsWithSameParcel());
            $all_order_parcels = view('components.group-parcel', ['groups' => $groups])->render();
            $data = ['status' => true,  'payment' => isFullFilledOrder($orderItem->order_id), 'data' => $all_order_parcels, 'paymentUrl' => route('Dealer.order.shippment.rates', ['order' => $orderItem->order_id]), 'message' => 'Product dimensions data saved successfully.', 'change_at' => $request->element_to_change];
            return response()->json($data);
        } catch (\Throwable $th) {
            $data = ['status' => false,  'message' => $th->getMessage()];
            return response()->json($data);
        }
    }

    public function deleteGroups(Request $request)
    {
        try {
            $products = explode(',', $request->product_ids);
            $orderProducts = OrderItem::with('product', 'parcel')->where('order_id', $request->order_id)->whereIn('product_id', $products)->get();
            foreach ($orderProducts as $single) {
                $check = OrderParcels::where('orderItem_id', $single->id)->where('product_id', $single->product_id)->first();
                if ($check) {
                    $check->update(['parcel_id' => random_int(10000, 99999), 'status' => 0]);
                }
            }
            $groups = groupWith($orderProducts[0]->getOrderIdsWithSameParcel());
            $all_order_parcels = view('components.group-parcel', ['groups' => $groups])->render();
            $data = ['status' => true,  'payment_btn_disable' => true, 'data' => $all_order_parcels, 'paymentUrl' => route('Dealer.order.shippment.rates', ['order' => $request->order_id]), 'message' => 'group dismantle', 'change_at' => $request->element_to_change];
            return response()->json($data);
        } catch (\Throwable $th) {
            $data = ['status' => false,  'message' => $th->getMessage()];
            return response()->json($data);
        }
    }

    public function createShippment(Request $request)
    {
        try {
            $selectedPickupAddressId = ShippmentAddressDetail::where('order_id', $request->order)->where('user_id', auth()->id())->first();
            if (is_null($selectedPickupAddressId)) {
                throw new \Exception('Pick up address not found for this particular order');
            }
            $pickupAddress = UserAddresses::where('id', $selectedPickupAddressId->selected_shippo_address)->first();
            if (is_null($pickupAddress)) {
                throw new \Exception('Pick up address not found for this particular order');
            }
            $shippmentDate = $selectedPickupAddressId->shippment_date;
            $formattedDate = \Carbon\Carbon::parse($shippmentDate)->format('Y-m-d\TH:i');
            $selected_order_id = $request->order;
            if (is_null($selected_order_id)) {
                throw new \Exception('Order id does not found for this particular order');
            }
            $to_address = BuyerAddress::where('order_id', $selected_order_id)->pluck('shippo_address_id')->first();
            if (is_null($to_address)) {
                throw new \Exception('Buyer Address did not found for this order');
            }
            $reciever_address = ShippingAddress::where('order_id', $selected_order_id)->first();
            $getOrderItemIds =  OrderItem::where('order_id', $request->order)->get();
            $parcelsIdInArray = [];
            foreach ($getOrderItemIds as $key => $value) {
                $parcelsIdInArray[] = OrderParcels::where('orderItem_id', $value->id)->pluck('parcel_id')->first();
            }
            $body = [
                "address_from" => $pickupAddress->shippo_address_id,
                "address_to" => $to_address,
                "parcel" => $parcelsIdInArray,
                "object_purpose" => "PURCHASE",
                "async" => false,
                "shipment_date" => $this->getCurrentTimeFormatted()
            ];
            $endpoint = 'shipments/';
            $response_in_array = $this->createPostRequest($endpoint, $body);
            if ($response_in_array->object_status == "SUCCESS") {
                $data = [
                    'user_id' => auth()->user()->id,
                    'address_to' => $to_address,
                    'address_from' => $pickupAddress->shippo_address_id,
                    'shippment_id' => $response_in_array->object_id,
                    'shippment_date' => $formattedDate,
                ];
                // $this->saveInDb($data, $parcelsIdInArray);
               $ifDataSave = $this->saveFulfilledShippmentOfDealer($selected_order_id,$response_in_array);
               if($ifDataSave){
                toastr()->success('Order fulfilled successfully');
                return redirect()->route('Dealer.order.fulllfilled');
               }else{
                throw new Exception("Error something went wrong in saving data");
               }
                // $stripeCustomer = auth()->user()->createOrGetStripeCustomer();
                // $intent = auth()->user()->createSetupIntent();
                // dd($response_in_array);
                // return view('dealer.order.payment', compact('pickupAddress', 'response_in_array', 'stripeCustomer', 'intent', 'reciever_address', 'selected_order_id', 'shippmentDate'));
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->route('Dealer.order.orderlist');
        }
    }

    public function saveInDb($data, $parcelsIdInArray = null)
    {
        try {
            DB::beginTransaction();
            if ($parcelsIdInArray) {
                foreach ($parcelsIdInArray as $item) {
                    ShippmentCreation::where('parcel_id', $item)->update($data);
                }
            } else {
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
            $res = $this->shippmentTranscation($request->rate_id, $request);
            $this->stripeTranscation($request);
            toastr()->success('Order fulfilled successfully');
            return redirect()->route('Dealer.order.fulllfilled');
        } catch (\Exception $th) {
            toastr()->error($th->getMessage());
            return redirect()->route('Dealer.order.orderlist');
        }
    }
    public function shippmentTranscation($rate_id, $request)
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
                return  $this->storeRateDetails($rateDetails, $response, $request);
            }
        } catch (\Exception $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }
    public function storeRateDetails($response, $masterResponse, $request)
    {
        try {
            $data = [
                'order_id' => $request->order_id,
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
    public function savingShippmentDateandAddress($request, $order)
    {
        try {
            //code...
            // $date = Carbon::parse($request->date)->format('Y-m-d');
            // $date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->date)->format('Y-m-d');
            // Parse the selected date
            $selectedDate = Carbon::parse($request->date);
            $currentTime = Carbon::now();
            // Apply the current hours and minutes to the selected date
            $shipmentDateTime = $selectedDate->setTime($currentTime->hour, $currentTime->minute);
            ShippmentAddressDetail::updateOrCreate(
                ['order_id' => $order->id, 'user_id' => auth()->id()],
                ['selected_shippo_address' => $request->selectadress, 'shippment_date' => $shipmentDateTime]
            );
        } catch (\Throwable $th) {
            throw new \Exception('Error in shippment address and time : ' . $th->getMessage());
        }
    }
    public function detailsOfFullfilledShippment($order_id)
    {
        try {
            $shippmentDetails = ShippoPurchasedLabel::where('order_id', $order_id)->first();
            if (empty($shippmentDetails)) {
                return redirect()->back()->with(['info' => 'Shippment label creation not done yet by platfom managers. please try again later.']);
            }
            // dd($shippmentDetails);
           $selectedShippmentDate= ShippmentAddressDetail::where('order_id',$order_id)->pluck('shippment_date')->first();
        //    if(empty($selectedShippmentDate)){
        //     return redirect()->back()->with(['error' => 'Something went wrong. Selected Shippment Date not found']);
        //    }
          $buyerAddress= ShippingAddress::where('order_id',$order_id)->first();
            return view('dealer.order.shippment_details', compact('shippmentDetails','buyerAddress','selectedShippmentDate'));
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function getFullfilledOrdersParcelsGroups($order)
    {
        try {
            $orderProducts = OrderItem::with('product', 'parcel')->where('order_id', $order->id)->get();
            $groups = groupWith($orderProducts[0]->getOrderIdsWithSameParcel());
        } catch (\Throwable $th) {
        }
    }
    public function saveFulfilledShippmentOfDealer($selected_order_id,$response_in_array)
    {
        try {
            $data=[
                'user_id'=>auth()->id(),
                'order_id'=>$selected_order_id,
                'fullfilled_ship_id'=>$response_in_array->object_id,
            ];
            FulFilledOrder::create($data);
            return true;
        } catch (\Exception $th) {
            throw new Exception("Error in saving Fulfilled Shippmentm Data: ". $th->getMessage());
        }
    }
}
