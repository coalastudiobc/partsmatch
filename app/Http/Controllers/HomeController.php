<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $category = Category::get();
        $products = Product::with('productImage')->where('status', '1')->inRandomOrder()->get();
        return view('welcome', compact('category', 'products'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {

        if ('POST' == $request->method()) {
            Auth::user()->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('admin.dashboard')->with(["status" => "success", "message" => "Password Updated Successfully"]);
        }
        return view('admin.change_password');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function redirectToDashboard()
    {
        if (Auth::user()->hasRole("Administrator")) {

            return redirect()->route('admin.category.index');
        } else if (Auth::user()->hasRole("Dealer")) {
            return redirect()->route('dealer.dashboard');
        } else if (Auth::user()->hasRole("Manager")) {
            return redirect()->route('dealer.dashboard');
        } else {
            return "ROLE NOT ASSIGNED";
        }
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
            $status = ($result->status == 1) ? '0' : '1';

            if ($result->update(['status' => $status])) {
                if ($status == '1') {
                    if ($class != "App\Models\Package") {
                        return response()->json(['status' => 'success', 'message' => $request->model . " has been activated"], 200);
                    } else {
                        return response()->json(['status' => 'success', 'message' => "Subscription plan" . " has been activated"], 200);
                    }
                } else {
                    if ($class != "App\Models\Package") {
                        return response()->json(['status' => 'danger', 'message' => $request->model . " has been deactivated"], 200);
                    } else {
                        return response()->json(['status' => 'danger', 'message' => "Subscription plan" . " has been deactivated"], 200);
                    }
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'status' . ' has not been updated.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
