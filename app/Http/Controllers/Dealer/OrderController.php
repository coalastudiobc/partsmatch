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
        $order =  Order::with('orderItem')->where('order_for', auth()->id())->orderByDesc('id')->first();
        // dd($order);
        return view('dealer.order.order_list', compact('order'));
    }
    public function testing(){
        return view('dealer.order.products');
    }
}
