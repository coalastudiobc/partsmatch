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
use App\Models\AdminSetting;
use App\Models\AllModel;
use App\Models\CarBrandMake;
use Exception;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
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
        $collections = Category::with('products')->has('products')->where('parent_id', '!=', null)->where('status', '1')->inRandomOrder()->take(10)->get();
        $subcategories = Category::with('products')->has('products')->Where('parent_id', '!=', null)->where('status', '1')->inRandomOrder()->take(6)->get();
        $brands = CarBrandMake::inRandomOrder()->get();
        if (Auth::user()) {
            if (Auth::user()->hasRole("Administrator")) {
                return redirect()->route('admin.category.index');
            }
        }
        return view('welcome', compact('category', 'subcategories', 'collections', "subcategory_id", "brands"));
    }

    public function brands()
    {
        $brands = CarBrandMake::all();

        return view('brands', compact("brands"));
    }
    public function categoryCard()
    {
        $categories = Category::all();
        return view('category_card', compact('categories'));
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
        // if($request->method() == "POST")
            // dd($request);
        $brands = CarBrandMake::distinct('makes')->get();

        $sdk = \CarApiSdk\CarApi::build([
            'token' => env('CAR_API_TOKEN'),
            'secret' => env('CAR_API_SECRET'),
        ]);
        $filePath = storage_path('app/text.txt');
        $jwt = file_exists($filePath) ? file_get_contents($filePath) : null;

        if (empty($jwt) || $sdk->loadJwt($jwt)->isJwtExpired()) {
            try {
                $jwt = $sdk->authenticate();
                file_put_contents($filePath, $jwt);
            } catch (Exception $e) {
                Log::channel('daily')->error($e->getMessage());
                return;
            }
        }
        $years = $sdk->years();
        $request_test = $this->searchByVin($request,$sdk);
        if($request_test){
            $request = $request->merge($request_test);
        }
        $models = AllModel::all();
        $products = Product::with('productImage', 'featuredProduct', 'productCompatible')->where('status','1')->global()->category()->compatiblity($request)->price()->paginate(12)->appends($request->query());
        $categories =  Category::with('children')->has('children')->orWhereNull('parent_id')->get();
        return view('public_shop', compact("categories", "products", "brands", "years", "models"));
    }

    public function ProductDetail(Request $request ,  $product)
    {
        $product = Product::withTrashed()->find($product);
        $userdetails = User::where(function($query) use ($product){
                $query->where('id',$product->user_id)
                ->orWhere('id', '=', $product->dealer_id);
        })->first();
        $productImages = $product->productImage;
        $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();
        $allproducts = Product::with(['productImage','productOfDealer'])->where('status','1')->where('user_id', $userdetails->id)->inRandomOrder()->limit(5)->get();
        if (auth()->user()) {
            $cart =  Cart::with('cartProducts', 'cartProducts.product', 'cartProducts.product.productImage')->where('user_id', auth()->id())->first();
            return view('product_details', compact('product', 'productImages', 'shippingCharge', 'userdetails', 'allproducts', 'cart'));
        }
        return view('product_details', compact('product', 'productImages', 'shippingCharge', 'userdetails', 'allproducts'));
    }

    public function getProductsForCategory(Request $request, Category $category)
    {
        $products = Product::where('status','1')->where('subcategory_id',$category->id)->inRandomOrder()->limit(5)->get();
        $data = view('components.home-product', compact('products'))->render();

        return response()->json(['status' => true, 'message' => 'products fetched successfully', 'data' => $data], 200);
    }

    public function getProductsCollectionForCategory(Request $request, Category $category)
    {
        $products = $category->products;
        $data = view('components.home-product', compact('products'))->render();

        return response()->json(['status' => true, 'message' => 'products fetched successfully', 'data' => $data], 200);
    }
    public function dealerProfile(Product $product)
    {
        $user = $product->user;
        $allproducts = Product::with('productImage', 'category')->where('user_id', $product->user->id)->limit(5)->get();
        return view('dealer.profile.dealer_profile', compact('user', 'allproducts', 'product'));
    }

    public function searchByVin(Request $request,$sdk)
    {
        try{
            $request_clone = $request;
            $vin = $request_clone->globalquery;
            if (empty($vin)) {
                return null;
            }
            
            $apiResponse = $sdk->vin($vin);
            $data=[
                'year'=>[$apiResponse->year] ?? ' ',
                'brand'=>[$apiResponse->make] ?? ' ',
                'model'=>[$apiResponse->model] ?? ' ',
            ];
            return $data;
        }catch(Exception $e){
            return null;
        }
       
    }
}
