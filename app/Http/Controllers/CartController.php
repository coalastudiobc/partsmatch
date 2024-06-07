<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\ShippingSetting;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart =  Cart::with('cartProducts', 'cartProducts.product', 'cartProducts.product.productImage')->where('user_id', auth()->id())->first();
        $shippingCharges = ShippingSetting::all();
        $user =  User::with('cart', 'cart.cartProducts')->where('id', auth()->user()->id)->first();
        return view('dealer.cart.index', compact('cart', 'shippingCharges', 'user'));
    }

    public function cart()
    {
    }

    public function addToCart(Request $request, $product_id)
    {
        try {
            $product = Product::where('id', $product_id)->first();

            $cart = Cart::where('user_id', auth()->id())->first();
            if (!$cart) {
                $cart = [
                    'user_id' => auth()->user()->id,
                    'amount' => null,
                    'status' => 1,
                ];
                $cart = Cart::create($cart);
            }
            $cart_product = [
                'product_id' => $product->id,
                'cart_id' => $cart->id,
                'quantity' => 1,
                'product_price' => $product->price,
            ];
            CartProduct::create($cart_product);

            $user =  User::with('cart', 'cart.cartProducts')->where('id', auth()->user()->id)->first();


            $cart_icon = view('components.cart-icon', compact('user'))->render();
            return response()->json(['success' => true, 'cart_icon' => $cart_icon, 'msg' => "Cart added successfully"]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function removeFromCart(CartProduct $product)
    {
        $product->delete();
        $cart =  Cart::with('cartProducts', 'cartProducts.product', 'cartProducts.product.productImage')->where('user_id', auth()->id())->first();
        $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();
        $user =  User::with('cart', 'cart.cartProducts')->where('id', auth()->user()->id)->first();
        $cart = view('components.cart', compact('cart', 'shippingCharge'))->render();
        $cart_icon = view('components.cart-icon', compact('user'))->render();
        $data = ['success' => true, 'cart_icon' => $cart_icon, 'cart' => $cart];
        return response()->json($data);
    }

    public function updateToCart(Request $request,  CartProduct $product)
    {
        try {
            $productDetails = Product::find($product->product_id);

            if (intval($request->quantity) <= intval($productDetails->stocks_avaliable)) {
                $product->update(['quantity' => $request->quantity]);
                $cart =  Cart::with('cartProducts', 'cartProducts.product', 'cartProducts.product.productImage')->where('user_id', auth()->id())->first();
                $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();
                $cart = view('components.cart', compact('cart', 'shippingCharge'))->render();
                $data = ['success' => true, 'cart' => $cart, 'status' => true, "message" => "product Quantity updated  successfully"];
                return response()->json($data);
            } else {
                $cart =  Cart::with('cartProducts', 'cartProducts.product', 'cartProducts.product.productImage')->where('user_id', auth()->id())->first();
                $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();
                $cart = view('components.cart', compact('cart', 'shippingCharge'))->render();
                $data = ['success' => true, 'cart' => $cart, 'status' => false, 'message' => "stocks not available"];
                return response()->json($data);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
