<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts =  Cart::with('cart_product.product.productImage')->get();
        $totalamount = Cart::sum('amount');
        $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();

        return view('dealer.cart.index', compact('carts', 'totalamount', 'shippingCharge'));
    }

    public function cart()
    {
    }

    public function addToCart(Request $request, $product_id)
    {
        $product = Product::where('id', $product_id)->first();
        $cart = [
            'user_id' => auth()->user()->id,
            'amount' => $product->price,
            'status' => 1,
        ];
        $cart = Cart::create($cart);
        $cart_product = [
            'product_id' => $product->id,
            'cart_id' => $cart->id,
            'quantity' => 1,
            'product_price' => $product->price,
        ];
        CartProduct::create($cart_product);

        return response()->json(['success' => true, 'msg' => "Cart added successfully"]);
    }

    public function removeFromCart(Cart $cart_id)
    {
        $cartproduct = CartProduct::where('cart_id', $cart_id->id)->first();
        $cartproduct->delete();
        $cart_id->delete();

        $carts =  Cart::with('cart_product.product.productImage')->get();
        $totalamount = Cart::sum('amount');
        $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();

        $cart = view('components.cart-component', compact('carts', 'totalamount', 'shippingCharge'))->render();
        $data = ['success' => true, 'cart' => $cart];
        return response()->json($data);
    }

    public function updateToCart(Request $request, Cart $cart_id, Product $product_id)
    {
        if ($request->dataminus != "minusQuantity") {

            $totalamount = $request->quantity * $product_id->price;
            $cart = [
                'user_id' => auth()->user()->id,
                'amount' => $totalamount,
                'status' => 1,
            ];
            $cart = $cart_id->update($cart);
            // dd($cart_id);
            $cartProduct = CartProduct::where('cart_id', $cart_id->id)->first();
            $cart_product = [
                'product_id' => $product_id->id,
                'cart_id' => $cart_id->id,
                'quantity' => $request->quantity,
                'product_price' => $product_id->price,
            ];
            $cartProduct->update($cart_product);
        } else {

            $totalamount = $cart_id->amount - $product_id->price;
            $cart = [
                'user_id' => auth()->user()->id,
                'amount' => $totalamount,
                'status' => 1,
            ];
            $cart = $cart_id->update($cart);
            // dd($cart_id);
            $cartProduct = CartProduct::where('cart_id', $cart_id->id)->first();
            $cart_product = [
                'product_id' => $product_id->id,
                'cart_id' => $cart_id->id,
                'quantity' => $request->quantity,
                'product_price' => $product_id->price,
            ];
            $cartProduct->update($cart_product);
        }
        return response()->json(['success' => true]);
    }
}
