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

Route::middleware(['auth', 'verified','user.status'])->group(function () {
    // Route::get('/products/status', [App\Http\Controllers\HomeController::class, 'togglestatus'])->name('dealer.products.status');
    // cms page
    // Route::get('manager/view/{slug}', [CmsManagementController::class, 'cms'])->name('view');
});

Route::name('Manager.products.')->group(function () {
    Route::get('/products/interior/{subcategory}', [ProductController::class, 'interior'])->name('interior.page');
    Route::get('/products/interior', [ProductController::class, 'show'])->name('interior');
    Route::get('/products/details/{product}', [ProductController::class, 'details'])->name('details');
});
Route::middleware(['auth', 'verified','user.status'])->namespace('App\Http\Controllers\Dealer')->name('Manager.')->group( function () 
    {

        Route::name('products.')->group(function () {
            Route::get('/products/create', [ProductController::class, 'create'])->name('create');
            Route::get('/products', [ProductController::class, 'index'])->name('index');
            Route::post('/products/store', [ProductController::class, 'store'])->name('store');
            Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('edit');
            Route::post('/products/update/{product}', [ProductController::class, 'update'])->name('update');
            Route::get('/products/delete/{product}', [ProductController::class, 'destroy'])->name('delete');
            Route::get('/products/subcategory/{id}', [ProductController::class, 'subcategory'])->name('subcategory');
            Route::match(['get', 'post'], '/featured/products/create/{product}', [ProductController::class, 'featuredproductcreate'])->name('featured.create');

            Route::get('/featured/products/delete/{id}', [ProductController::class, 'featuredproductdelete'])->name('featured.products.delete');

            Route::get('/model/{year}', [ProductController::class, 'model'])->name('model');
            Route::get('/make/{model}', [ProductController::class, 'make'])->name('make');
        });

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
        Route::name('myorder.')->group(function () {
            Route::get('order', [CheckoutController::class, 'order'])->name('orderlist');
            Route::get('order/view/{order}', [CheckoutController::class, 'orderProductView'])->name('view.products');
        });
        Route::name('address.')->group(function () {
            Route::match(['get', 'post'],'product/shipping/toaddress', [CheckoutController::class, 'to_address'])->name('to');
        });
    }
);
