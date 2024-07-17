<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\CarBrandMake;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

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

    public function index($subcategory_id = null)
    {
        $category = Category::where('status', '1')->get();
        $collections = Category::with('products.cartProduct')->where('parent_id', '!=', null)->where('status', '1')->inRandomOrder()->take(10)->get();
        $subcategories = Category::with('products')->has('products')->Where('parent_id', '!=', null)->where('status', '1')->inRandomOrder()->take(6)->get();
        $brands=CarBrandMake::inRandomOrder()->take(7)->get();
        return view('welcome', compact('category', 'subcategories', 'collections', "subcategory_id","brands"));
    }

    public function brands()
    {
        $brands=CarBrandMake::all();

        return view('brands', compact("brands"));
    }
    public function categoryCard()
    {
        $categories = Category::all();
        return view('category_card', compact('categories'));
    }
    public function getProductsForCategory(Request $request, Category $category)
    {
        $products = $category->products;
        $data = view('components.home-product-tab', compact('products'))->render();

        return response()->json(['status' => true, 'message' => 'products fetched successfully', 'data' => $data], 200);
    }

    public function getProductsCollectionForCategory(Request $request, Category $category)
    {
        $products = $category->products;

        $data = view('components.home-product', compact('products'))->render();

        return response()->json(['status' => true, 'message' => 'products fetched successfully', 'data' => $data], 200);
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
            return redirect()->route('Dealer.products.index');
        } else if (Auth::user()->hasRole("Manager")) {
            return redirect()->route('Manager.products.index');
        } else {
            auth()->logout();
            return redirect()->back()->with('error', 'There is some issue for this account. Please contact to administrator.');
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


    public function allProducts(Request $request)
    {
// dd($request);
        $products = Product::with('productImage', 'featuredProduct')->category()->get();
        $categories =  Category::with('children')->has('children')->orWhereNull('parent_id')->get();
        return view('public_shop', compact("categories","products"));
    }
}
