<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        // $ordersitem =  OrderItem::with('product', 'order')->whereRelation('product', 'products.user_id', auth()->user()->id)->orderByDesc('id')->get();
        $orders =  Order::with('orderItem')->where('order_for', auth()->id())->orderBy('created_at', 'DESC')->paginate(__('pagination.pagination_nuber'));
        // dd($orders);
        return view('dealer.order.order_list', compact('orders'))->with(['status' => 'success', 'message' => 'Order Placed Successfully']);
    }
    public function testing(){
        return view('dealer.order.products');
    }
}
