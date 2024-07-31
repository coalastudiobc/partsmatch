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

    public function addToCart(Request $request, $product_id)
    {
        try {
            if($request->has('quantity')){
                $quantity = $request->quantity;
            }else{
                $quantity = 1;
            }
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

            $stock=false;
            $dealerCheck = CartProduct::where('cart_id', $cart->id)->first();
            if ($dealerCheck) {
                if ($dealerCheck->product_of != $product->user_id) {
                    return response()->json(['success' => true, 'product_id' => $product->id, 'dealer_url' => route('Dealer.view.public', ['dealer' => $dealerCheck->product_of]), 'product_url' => route('Dealer.cart.delete.add', ['product_id' => $product->id]),'quantity'=>$quantity]);
                }
            }
            $alreadyProduct =  CartProduct::where('product_id', $product->id)->where('cart_id', $cart->id)->first();

            if (!$alreadyProduct) {
                $cart_product = [
                    'product_id' => $product->id,
                    'cart_id' => $cart->id,
                    'quantity' => $quantity,
                    'product_price' => $product->price,
                ];

                CartProduct::create($cart_product);
                $message = "Product added to cart.";
            }else{
                if((intval($quantity) + intval($alreadyProduct->quantity)) <= intval($product->stocks_avaliable)){

                    $alreadyProduct->update(['quantity' => (intval($quantity) + intval($alreadyProduct->quantity))]);
                    $message = "Product quantity updated.";
                    $stock = false;
                }else {
                    $stock = true;
                    $message = "Product out of stock";
                }
            }
            $user =  User::with('cart', 'cart.cartProducts')->where('id', auth()->user()->id)->first();
            $cart_icon = view('components.cart-icon', compact('user'))->render();
            return response()->json(['success' => true, 'cart_icon' => $cart_icon, 'message' => $message,'out_of_stock'=> $stock]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteAndAddToCart(Request $request, $product_id)
    {
        try {

            if($request->has('quantity')){
                $quantity = $request->quantity;
            }else{
                $quantity = 1;
            }

            $cart = Cart::where('user_id', auth()->id())->first();
            $product = Product::where('id', $product_id)->first();

            $delete = CartProduct::where('cart_id', $cart->id)->delete();
            if ($delete) {
                $cartDelete = Cart::where('id',$cart->id)->delete();
                $cart = [
                    'user_id' => auth()->user()->id,
                    'amount' => null,
                    'status' => 1,
                ];
                $cart = Cart::create($cart);
                $cart_product = [
                    'product_id' => $product->id,
                    'cart_id' => $cart->id,
                    'quantity' =>  $quantity,
                    'product_price' => $product->price,
                ];
                CartProduct::create($cart_product);
                $message = "Product added to cart.";
            }
            $user =  User::with('cart', 'cart.cartProducts')->where('id', auth()->user()->id)->first();
            $cart_icon = view('components.cart-icon', compact('user'))->render();
            return response()->json(['success' => true, 'cart_icon' => $cart_icon, 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
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
                $product->update(['quantity' => intval($request->quantity)]);
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
                $data = ['success' => true, 'cart' => $cart, 'stock'=>true, 'status' => false, 'message' => "stocks not available"];
                return response()->json($data);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
