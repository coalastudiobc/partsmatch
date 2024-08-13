<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ShippoTrait;
use App\Models\ShippoPurchasedLabel;
use App\Models\Order;




class PayoutsController extends Controller
{     use ShippoTrait;

    public function index()
    {

        $fulfilledIds = ShippoPurchasedLabel::pluck('order_id');
        $fulfilledOrders = $fulfilledIds->isNotEmpty() ? Order::whereIn('id', $fulfilledIds)->latest()->paginate(__('pagination.admin_paginaion_number')) : collect(); 
        return view('admin.payouts.index', compact('fulfilledOrders'));

    }
    public function trackResult()
    {
        
        $endPoint="track".$trackingNumber;
    }
    

}
