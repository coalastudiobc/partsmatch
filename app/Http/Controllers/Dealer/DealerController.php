<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\ShippoPurchasedLabel;
use App\Models\User;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function dashboard()
    {      
        try {
            $totalAmountOfAllOrders = Order::where('order_for', auth()->id())->sum('total_amount');
            $ordersCount = Order::where('order_for', auth()->id())->count();
            $orderIds = Order::where('order_for', auth()->id())->pluck('id')->toArray();
            $fulfilledIds = [];
            $pendingOrders = 0;
            $fulfilledOrders = 0;
        
            if (!empty($orderIds)) {
                $fulfilledIds = ShippoPurchasedLabel::whereIn('order_id', $orderIds)->pluck('order_id')->toArray();
        
                $pendingOrders = Order::whereIn('id', $orderIds)
                    ->when(!empty($fulfilledIds), function ($query) use ($fulfilledIds) {
                        return $query->whereNotIn('id', $fulfilledIds);
                    })
                    ->orderBy('created_at', 'DESC')
                    ->count();
        
                $fulfilledOrders = Order::whereIn('id', $fulfilledIds)->count();
            }
        
            return view('dealer.dashboard', compact('ordersCount', 'pendingOrders', 'fulfilledOrders','totalAmountOfAllOrders'));                                                                                                                                                         
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }


    public function dealerPublicProfile(User $dealer)
    {
        $user = $dealer;
        $allproducts = Product::with('productImage', 'category')->where('user_id', $dealer->id)->get();
        return view('dealer.profile.dealer_public_profile', compact('user', 'allproducts'));
    }

    public function toggleStatus(Request $request)
    {
        $id = $request->id;
        try {
            $class = "App\Models\\{$request->model}";

            if (empty($class)) {
                return response()->json(['status' => 'error', 'message' => ucwords($request->model) . ' not found'], 404);
            }
            $result = $class::where('id', $id)->firstOrFail();
            $status = ($result->status == "ACTIVE") ? 'INACTIVE' : 'ACTIVE';
            if ($result->update(['status' => $status])) {
                if ($status == 'ACTIVE') {
                    return response()->json(['status' => 'success', 'message' => $request->model . " has been activated"], 200);
                } else {
                    return response()->json(['status' => 'danger', 'message' => $request->model . " has been deactivated"], 200);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'status' . ' has not been updated.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
