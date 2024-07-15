<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function dashboard()
    {
        return view('dealer.dashboard');
    }

    public function dealerProfile(Product $product)
    {
        $user = $product->user;
        $allproducts = Product::with('productImage', 'category')->where('user_id', $product->user->id)->limit(5)->get();
        return view('dealer.profile.dealer_profile', compact('user', 'allproducts', 'product'));
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
