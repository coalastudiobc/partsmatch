<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function index()
    {
        $request = request();

        $users = User::with('product')->where('id', '!=', 1)->Search()->get();
        return view('admin.user.index', compact('users'));
    }
    public function products(User $user)
    {
        $products = Product::where('user_id', $user->id)->get();
        return view('admin.user.product_list', compact('products', 'user'));
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

    public function dealerProfile(Request $request, User $user)
    {
        $paymentdetail = $user->paymentDetail;

        return view('admin.user.view', compact('user', 'paymentdetail'));
    }
}
