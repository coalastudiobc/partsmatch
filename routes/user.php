<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Dealer\ProductController;
use App\Http\Controllers\Dealer\CheckoutController;
use App\Http\Controllers\Dealer\DealerController;
use App\Http\Controllers\Admin\CmsManagementController;


/*
|--------------------------------------------------------------------------
| Manager Routes
|--------------------------------------------------------------------------
|
| Here is where you can register manager routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth', 'verified','user.status'])->namespace('App\Http\Controllers\Dealer')->name('User.')->group( function () 
    {

        // product dealer profile
        Route::get('/product/dealer/profile/view/{product}', [DealerController::class, 'dealerProfile'])->name('view.profile');

        Route::name('cart.')->group(function () {
            Route::get('cart/index', [CartController::class, 'index'])->name('cart.index');
            Route::post('add/to/cart/{product_id}', [CartController::class, 'addToCart'])->name('cart');
            Route::get('delete/to/cart/{product}', [CartController::class, 'removeFromCart'])->name('remove');
            Route::post('update/to/cart/{product}', [CartController::class, 'updateToCart'])->name('update');
        });
        Route::name('checkout.')->group(function () {
            Route::get('checkout/create', [CheckoutController::class, 'create'])->name('create');
            Route::post('checkout/store', [CheckoutController::class, 'store'])->name('store');
            Route::post('checkout/shiping/rates', [CheckoutController::class, 'getPaymentPage'])->name('rates');
            // Route::get('/sachin/testing', [CheckoutController::class, 'testing']);
        });

        Route::name('address.')->group(function () {
            Route::get('product/picking/address', [ShippoController::class, 'view'])->name('view');
            Route::get('shipping/methods/{country}', [CheckoutController::class, 'getShippingMethods'])->name('shipping.methods');
            Route::match(['get', 'post'],'product/shipping/toaddress', [CheckoutController::class, 'to_address'])->name('to');
        });
        Route::name('myorder.')->group(function () {
            Route::get('order', [CheckoutController::class, 'order'])->name('orderlist');
            Route::get('order/view/{order}', [CheckoutController::class, 'orderProductView'])->name('view.products');

        });
        Route::name('order.')->group(function () {
            Route::get('order/my', [OrderController::class, 'order'])->name('orderlist');
        });
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    }
);
