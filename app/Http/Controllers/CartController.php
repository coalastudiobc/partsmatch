<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts =  Cart::with('cart_product.product.productImage')->get();

        return view('dealer.cart.index', compact('carts'));
    }

    public function cart()
    {
    }

    public function addToCart($product_id)
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
            'quantity' => $product->stocks_avaliable,
            'product_price' => $product->price,
        ];
        CartProduct::create($cart_product);
        session()->flash('success', 'Cart added successfully');
        return response()->json(['success' => true]);
    }

    public function removeFromCart(Cart $cart_id)
    {
        // dd($cart_id);
        $cartproduct = CartProduct::where('cart_id', $cart_id->id)->first();
        $cartproduct->delete();
        $cart_id->delete();
        return redirect()->route('welcome.index');
    }
}
