<?php

use App\Http\Controllers\Dealer\AccountSettingController;
use App\Http\Controllers\Dealer\DealerController;
use App\Http\Controllers\Dealer\PartsManagerController;
use App\Http\Controllers\Dealer\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->namespace('App\Http\Controllers\Dealer')->name('dealer.')->group(function () {
    Route::get('/dashboard', [DealerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AccountSettingController::class, 'profile'])->name('profile');
    Route::post('profile/update', [AccountSettingController::class, 'update'])->name('profile.update');
    Route::post('change-password', [AccountSettingController::class, 'updatePassword'])->name('changepassword');
    Route::match(['GET', "POST"], 'dealers/status', [DealerController::class, 'toggleStatus'])->name('status');

    // products
    Route::name('products')->group(function () {

        Route::get('/products', [ProductController::class, 'index'])->name('profile');
    });

    Route::name('partsmanager.')->group(function () {
        Route::get('parts/manager/index', [PartsManagerController::class, 'index'])->name('index');
        Route::post('parts/manager/store', [PartsManagerController::class, 'store'])->name('store');
        Route::get('parts/manager/edit/{user}', [PartsManagerController::class, 'edit'])->name('edit');
        Route::post('parts/manager/update/{user}', [PartsManagerController::class, 'update'])->name('update');
        Route::get('parts/manager/delete/{user}', [PartsManagerController::class, 'delete'])->name('delete');
    });
});
