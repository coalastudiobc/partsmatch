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
            
            $cart = Cart::where('user_id', auth()->id())->first();
            $product = Product::where('id', $product_id)->first();

            if (!$cart) {
                $cart = [
                    'user_id' => auth()->user()->id,
                    'amount' => null,
                    'status' => 1,
                ];
                $cart = Cart::create($cart);
            }
            $message = "Product already in Cart.";

            $dealerCheck = CartProduct::where('cart_id', $cart->id)->first();
            if($dealerCheck){
                if($dealerCheck->product_of != $product->user_id){
                    return response()->json(['success' => true, 'product_id' => $product->id, 'url' => route('Dealer.view.public',['dealer' => $dealerCheck->product_of ])]);
                }
            }
            $alreadyProduct =  CartProduct::where('product_id', $product->id)->where('cart_id', $cart->id)->first();

            if (!$alreadyProduct) {
                $cart_product = [
                    'product_id' => $product->id,
                    'cart_id' => $cart->id,
                    'quantity' => 1,
                    'product_price' => $product->price,
                ];

                CartProduct::create($cart_product);
                $message = "Cart added successfully";
            }
            $user =  User::with('cart', 'cart.cartProducts')->where('id', auth()->user()->id)->first();
            $cart_icon = view('components.cart-icon', compact('user'))->render();
            return response()->json(['success' => true, 'cart_icon' => $cart_icon, 'message' => $message]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function removeFromCart(CartProduct $product)
    {
        $product->delete();
        $cart =  Cart::with('cartProducts', 'cartProducts.product', 'cartProducts.product.productImage')->where('user_id', auth()->id())->first();
        $shippingCharges = ShippingSetting::all();
        $user =  User::with('cart', 'cart.cartProducts')->where('id', auth()->user()->id)->first();
        $cart = view('components.cart', compact('cart', 'shippingCharges'))->render();
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
                $shippingCharges = ShippingSetting::all();
                $cart = view('components.cart', compact('cart', 'shippingCharges'))->render();
                $data = ['success' => true, 'cart' => $cart, 'status' => true, "message" => "product Quantity updated  successfully"];
                return response()->json($data);
            } else {
                $cart =  Cart::with('cartProducts', 'cartProducts.product', 'cartProducts.product.productImage')->where('user_id', auth()->id())->first();
                // $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();
                $shippingCharges = ShippingSetting::all();
                $cart = view('components.cart', compact('cart', 'shippingCharges'))->render();
                $data = ['success' => true, 'cart' => $cart, 'status' => false, 'message' => "stocks not available"];
                return response()->json($data);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
