<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dealer\OrderController;
use App\Http\Controllers\Dealer\ProductController;
use App\Http\Controllers\Dealer\OrderPaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // if (Auth::check())
    //     return redirect()->route('redirect-to-dashboard');
    // else
    return redirect()->route('welcome.index');
})->name('welcome');
Route::get('/postal/search', [RegisterController::class, 'search'])->name('postal.search');
Route::match(['get', 'post'], 'welcome/{subcategory?}/{category?}', [HomeController::class, 'index'])->name('welcome.index');
Route::get('category', [HomeController::class, 'categoryCard'])->name('categories');
Route::get('get/categorized/products/{category}', [HomeController::class, 'getProductsForCategory'])->name('categories.subcategory');
Route::get('get/categorized/collection/products/{category}', [HomeController::class, 'getProductsCollectionForCategory'])->name('categories.collection');

Route::middleware('auth')->get('redirect-to-dashboard', [HomeController::class, 'redirectToDashboard'])->name('redirect-to-dashboard');
Route::get('verify-email/{user}/{token}', [RegisterController::class, 'verifyEmail'])->name('verify-email');

Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('brands', [HomeController::class, 'brands'])->name('brands');
Route::get('/sumit', [OrderController::class, 'testing']);
Route::match(['get', 'post'], 'products', [HomeController::class, 'allProducts'])->name('products');
Route::match(['get', 'post'], 'product/detail/{product}', [HomeController::class, 'ProductDetail'])->name('product.detail');
Route::match(['get', 'post'], 'dealer/profile/{product}', [HomeController::class, 'dealerProfile'])->name('dealer.profile');


Auth::routes();
Route::middleware(['auth', 'verified','user.status','set.cache.history'])->namespace('App\Http\Controllers')->group(function () {
    Route::match(['GET', 'POST'],'/order/payment', [OrderPaymentController::class, 'index'])->name('order.payment');
});

Route::middleware(['auth', 'verified','user.status'])->namespace('App\Http\Controllers')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [HomeController::class, 'logout'])->name('custom.logout');
    Route::match(['GET', 'POST'], '/change/password', [HomeController::class, 'changePassword'])->name('change.password');
});
