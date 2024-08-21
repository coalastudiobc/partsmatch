<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders =  OrderItem::with('product', 'order')->orderBy('created_at', 'DESC')->paginate(__('pagination.admin_paginaion_number'));
        return view('admin.order.index', compact('orders'));
    }
   public function hlo(){
    return view('dealer.order.payment');
   }
}
