<?php

use App\Http\Controllers\Admin\CmsManagementController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Dealer\AccountSettingController;
use App\Http\Controllers\Dealer\CheckoutController;
use App\Http\Controllers\Dealer\DealerController;
use App\Http\Controllers\Dealer\OrderController;
use App\Http\Controllers\Dealer\PartsManagerController;
use App\Http\Controllers\Dealer\ProductController;
use App\Http\Controllers\Dealer\SubscriptionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/products/status', [App\Http\Controllers\HomeController::class, 'togglestatus'])->name('dealer.products.status');

    // cms page
    Route::get('view/{slug}', [CmsManagementController::class, 'cms'])->name('view');
});
Route::name('dealer.products.')->group(function () {
    Route::get('/products/interior/{subcategory}', [ProductController::class, 'interior'])->name('interior.page');
    Route::get('/products/interior', [ProductController::class, 'show'])->name('interior');

    Route::get('/products/details/{product}', [ProductController::class, 'details'])->name('details');
});
Route::middleware(['auth', 'verified'])->namespace('App\Http\Controllers\Dealer')->name('dealer.')->group(function () {
    Route::get('/dashboard', [DealerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AccountSettingController::class, 'profile'])->name('profile');
    Route::post('profile/update', [AccountSettingController::class, 'update'])->name('profile.update');
    Route::post('change-password', [AccountSettingController::class, 'updatePassword'])->name('changepassword');
    Route::match(['GET', "POST"], 'dealers/status', [DealerController::class, 'toggleStatus'])->name('status');

    Route::get('state/{country}', [CheckoutController::class, 'state'])->name('state');
    Route::get('cities/{state}', [CheckoutController::class, 'cities'])->name('cities');
    Route::get('/profile/view/{user}', [DealerController::class, 'dealerProfile'])->name('view.profile');
    // products
    Route::name('products.')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('create');
        Route::get('/products', [ProductController::class, 'index'])->name('index');
        Route::post('/products/store', [ProductController::class, 'store'])->name('store');
        Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/products/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::get('/products/delete/{product}', [ProductController::class, 'destroy'])->name('delete');
        Route::get('/products/subcategory/{id}', [ProductController::class, 'subcategory'])->name('subcategory');
        Route::post('/featured/products/create/{product}', [ProductController::class, 'featuredproductcreate'])->name('featured.create');

        Route::get('/featured/products/delete/{id}', [ProductController::class, 'featuredproductdelete'])->name('featured.products.delete');

        Route::get('/model/{year}', [ProductController::class, 'model'])->name('model');
        Route::get('/make/{model}', [ProductController::class, 'make'])->name('make');
    });
    //order
    Route::name('myorder.')->group(function () {
        Route::get('order', [CheckoutController::class, 'order'])->name('orderlist');
    });

    Route::name('order.')->group(function () {
        Route::get('order/management', [OrderController::class, 'order'])->name('orderlist');
    });
    // cart
    Route::name('cart.')->group(function () {
        Route::get('cart/index', [CartController::class, 'index'])->name('cart.index');
        Route::post('add/to/cart/{product_id}', [CartController::class, 'addToCart'])->name('cart');
        Route::get('delete/to/cart/{product}', [CartController::class, 'removeFromCart'])->name('remove');
        Route::post('update/to/cart/{product}', [CartController::class, 'updateToCart'])->name('update');
    });
    Route::name('checkout.')->group(function () {
        Route::get('checkout/create', [CheckoutController::class, 'create'])->name('create');
        Route::post('checkout/store', [CheckoutController::class, 'store'])->name('store');
    });

    // subscription
    Route::name('subscription.')->group(function () {
        Route::get('subscription/plans', [SubscriptionController::class, 'index'])->name('plan');
        Route::post('subscription/plans/purchase', [SubscriptionController::class, 'purchaseSubscription'])->name('plan.purchase');
    });

    Route::name('partsmanager.')->group(function () {
        Route::get('parts/manager/index', [PartsManagerController::class, 'index'])->name('index');
        Route::post('parts/manager/store', [PartsManagerController::class, 'store'])->name('store');
        Route::get('parts/manager/edit/{user}', [PartsManagerController::class, 'edit'])->name('edit');
        Route::post('parts/manager/update/{user}', [PartsManagerController::class, 'update'])->name('update');
        Route::get('parts/manager/delete/{user}', [PartsManagerController::class, 'delete'])->name('delete');
        Route::get('partsmanager/userDetails/{user}', [PartsManagerController::class, 'getPartManagerDetail'])->name('userDetails');
    });
});
