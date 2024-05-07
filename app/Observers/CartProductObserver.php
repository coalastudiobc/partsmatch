<?php

namespace App\Observers;

use App\Models\AdminSetting;
use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Http\Request;

class CartProductObserver
{
    /**
     * Handle the CartProduct "created" event.
     */
    public function created(CartProduct $cartProduct): void
    {
    }

    /**
     * Handle the CartProduct "updated" event.
     */
    public function updated(CartProduct $cartProduct): void
    {
        // if (request()->dataquantity == 'plusQuantity') {
        $cart = Cart::where('id', $cartProduct->cart_id)->first();
        $totalamount = $cartProduct->quantity * $cartProduct->product_price;
        $cart->update([
            'user_id' => auth()->user()->id,
            'amount' => $totalamount,
            'status' => $cart->status
        ]);


        // }
        // else {
        //     $cart = Cart::where('id', $cartProduct->cart_id)->first();
        //     $totalamount = $cartProduct->quantity * $cartProduct->product_price;
        //     $cart->update([
        //         'user_id' => auth()->user()->id,
        //         'amount' => $totalamount,
        //         'status' => $cart->status
        //     ]);
        // }
    }

    /**
     * Handle the CartProduct "deleted" event.
     */
    public function deleted(CartProduct $cartProduct): void
    {
        //
    }

    /**
     * Handle the CartProduct "restored" event.
     */
    public function restored(CartProduct $cartProduct): void
    {
        //
    }

    /**
     * Handle the CartProduct "force deleted" event.
     */
    public function forceDeleted(CartProduct $cartProduct): void
    {
        //
    }
}
