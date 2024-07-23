<?php

namespace App\Http\Controllers\Dealer;

use toastr;
use App\Models\Order;
use App\Models\Country;
use App\Models\Product;
use App\Models\OrderItem;
use App\Traits\ShippoTrait;
use Illuminate\Http\Request;
use App\Models\UserAddresses;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingAddressRequest;
use App\Models\OrderParcels;
use App\Models\ShippmentCreation;

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
        $orderProducts = OrderItem::where('order_id', $order->id)->get();
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
        return view('dealer.order.payment');
    }
}
