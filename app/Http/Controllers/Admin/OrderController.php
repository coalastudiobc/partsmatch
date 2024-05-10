<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders =  OrderItem::with('product', 'order')->orderByDesc('id')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }
}
