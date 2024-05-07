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
        $carts =  Cart::with('cart_product.product.productImage')->where('user_id', auth()->user()->id)->get();
        $totalamount = Cart::where('user_id', auth()->user()->id)->sum('amount');
        $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();

        return view('dealer.cart.index', compact('carts', 'totalamount', 'shippingCharge'));
    }

    public function cart()
    {
    }

    public function addToCart(Request $request, $product_id)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function removeFromCart(Cart $cart_id)
    {
        $cartproduct = CartProduct::where('cart_id', $cart_id->id)->first();
        $cartproduct->delete();
        $cart_id->delete();

        $carts =  Cart::where('user_id', auth()->user()->id)->with('cart_product.product.productImage')->get();
        $totalamount = Cart::where('user_id', auth()->user()->id)->sum('amount');
        $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();

        $cart = view('components.cart-component', compact('carts', 'totalamount', 'shippingCharge'))->render();
        $data = ['success' => true, 'cart' => $cart];
        return response()->json($data);
    }

    public function updateToCart(Request $request, Cart $cart_id, Product $product_id)
    {
        try {
            if ($request->quantity <= $product_id->stocks_avaliable) {

                // if ($request->dataquantity == "plusQuantity") {

                // $totalamount = $request->quantity * $product_id->price;
                // $cart = [
                //     'user_id' => auth()->user()->id,
                //     'amount' => $totalamount,
                //     'status' => 1,
                // ];
                // $cart = $cart_id->update($cart);

                $cartProduct = CartProduct::where('cart_id', $cart_id->id)->first();
                $cart_product = [
                    'product_id' => $product_id->id,
                    'cart_id' => $cart_id->id,
                    'quantity' => $request->quantity,
                    'product_price' => $product_id->price,
                ];
                $cartProduct->update($cart_product);
                // }
                //  elseif ($request->dataquantity == 'minusQuantity') {

                //     $totalamount = $cart_id->amount - $product_id->price;
                //     $cart = [
                //         'user_id' => auth()->user()->id,
                //         'amount' => $totalamount,
                //         'status' => 1,
                //     ];
                //     $cart = $cart_id->update($cart);
                //   
                //     $cartProduct = CartProduct::where('cart_id', $cart_id->id)->first();
                //     $cart_product = [
                //         'product_id' => $product_id->id,
                //         'cart_id' => $cart_id->id,
                //         'quantity' => $request->quantity,
                //         'product_price' => $product_id->price,
                //     ];
                //     $cartProduct->update($cart_product);
                // }
                $carts =  Cart::where('user_id', auth()->user()->id)->with('cart_product.product.productImage')->get();
                $totalamount = Cart::where('user_id', auth()->user()->id)->sum('amount');
                $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();

                $cart = view('components.cart-component', compact('carts', 'totalamount', 'shippingCharge'))->render();
                $data = ['success' => true, 'cart' => $cart];
                return response()->json($data);
            } else {
                return response()->json(['success' => false, 'message' => "Product not available"]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
