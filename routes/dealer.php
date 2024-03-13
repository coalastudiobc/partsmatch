<?php

use App\Http\Controllers\Dealer\AccountSettingController;
use App\Http\Controllers\Dealer\DealerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->namespace('App\Http\Controllers\Dealer')->name('dealer.')->group(function () {
    Route::get('/dashboard', [DealerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AccountSettingController::class, 'profile'])->name('profile');
    Route::post('profile/update', [AccountSettingController::class, 'update'])->name('profile.update');
    Route::post('change-password', [AccountSettingController::class, 'updatePassword'])->name('changepassword');
    // products
    Route::name('products')->group(function(){
        
        Route::get('/products', [ProductController::class, 'index'])->name('profile');
    });

});
