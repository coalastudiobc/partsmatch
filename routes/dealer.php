<?php

use App\Http\Controllers\Admin\CmsManagementController;
use App\Http\Controllers\Dealer\AccountSettingController;
use App\Http\Controllers\Dealer\DealerController;
use App\Http\Controllers\Dealer\PartsManagerController;
use App\Http\Controllers\Dealer\ProductController;
use App\Http\Controllers\Dealer\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/products/status', [App\Http\Controllers\HomeController::class, 'togglestatus'])->name('dealer.products.status');

    // cms page
    Route::get('view/{slug}', [CmsManagementController::class, 'cms'])->name('view');
});
Route::middleware(['auth', 'verified'])->namespace('App\Http\Controllers\Dealer')->name('dealer.')->group(function () {
    Route::get('/dashboard', [DealerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AccountSettingController::class, 'profile'])->name('profile');
    Route::post('profile/update', [AccountSettingController::class, 'update'])->name('profile.update');
    Route::post('change-password', [AccountSettingController::class, 'updatePassword'])->name('changepassword');
    Route::match(['GET', "POST"], 'dealers/status', [DealerController::class, 'toggleStatus'])->name('status');

    // products
    Route::name('products.')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('create');
        Route::get('/products', [ProductController::class, 'index'])->name('index');
        Route::post('/products/store', [ProductController::class, 'store'])->name('store');
        Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/products/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::get('/products/delete/{product}', [ProductController::class, 'destroy'])->name('delete');
        Route::get('/products/subcategory/{id}', [ProductController::class, 'subcategory'])->name('subcategory');
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
    });
});
