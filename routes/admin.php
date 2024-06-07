<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
// use QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['GET', "POST"], 'cms/status', 'App\Http\Controllers\HomeController@toggleStatus')->name('cms.status');
Route::match(['GET', "POST"], 'product/status', 'App\Http\Controllers\HomeController@toggleStatus')->name('product.status');
Route::match(['GET', "POST"], 'category/status', 'App\Http\Controllers\HomeController@toggleStatus')->name('category.status');
Route::match(['GET', "POST"], 'package/status', 'App\Http\Controllers\HomeController@toggleStatus')->name('package.status');

Route::middleware(['auth', 'verified', 'admin'])->namespace('App\Http\Controllers\Admin')->name('admin.')->group(function () {
    Route::match('get', 'dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('show', 'AdminController@show')->name('show');
    Route::get('edit', 'AdminController@edit')->name('edit');
    Route::match(["GET", "POST"], "commission/{dealer_id?}", 'AdminController@commission')->name('commission');
    Route::post('commision/setting/{user_id?}', 'AdminController@commisionAdd')->name('comission.add');

    Route::match(["GET", "POST"], "shipping", 'AdminController@shipping')->name('shipping');
    Route::match(["GET", "POST"], 'shipping/edit/{shipping_id}', 'AdminController@shippingEdit')->name('shipping.edit');
    Route::get('shipping/add', 'AdminController@shippingAdd')->name('shipping.add');
    Route::get('shipping/delete/{shipping_id}', 'AdminController@shippingDestroy')->name('shipping.delete');
    Route::match(["GET", "POST"], "featured/product", 'AdminController@featured_list')->name('featured.product');


    // Stripe settings
    Route::name('settings.')->group(function () {
        Route::get('settings', 'AdminController@settings')->name('view');
        Route::post('settings/update', 'AdminController@stripeSettings')->name('update');
    });

    //payments history
    Route::name('payments.')->group(function () {
        Route::get('payments/history/{export?}', 'AdminController@paymentHistory')->name('all');
    });

    //cms management
    Route::name('cms.')->group(function () {
        Route::get('cms/list', 'CmsManagementController@index')->name('index');
        Route::get('cms/deleted/pages', 'CmsManagementController@deleted_pages')->name('deleted');
        Route::get('cms/delete/{id}', 'CmsManagementController@destroy')->name('delete');
        Route::get('cms/edit/{page}', 'CmsManagementController@edit')->name('edit');
        Route::get('cms/restore/{id}', 'CmsManagementController@restore')->name('restore');
        Route::post('cms/update/{page}', 'CmsManagementController@update')->name('update');
    });

    //order
    Route::name('order.')->group(function () {
        Route::get('order/management', [OrderController::class, 'index'])->name('orderlist');
    });
    //package
    Route::name('packages.')->group(function () {
        Route::get('packages', 'PackageController@index')->name('all');
        Route::get('add/packages', 'PackageController@create')->name('add');
        Route::post('packages/store/{id?}', 'PackageController@store')->name('store');
        Route::get('packages/edit/{id}', 'PackageController@edit')->name('edit');
        Route::get('packages/delete/{id}', 'PackageController@destroy')->name('delete');
    });

    //users
    Route::name('dealers.')->group(function () {
        Route::get('dealers', 'DealerController@index')->name('all');
        Route::match(['GET', "POST"], 'dealers/status', 'DealerController@toggleStatus')->name('status');
        Route::get('dealer/profile/{user}', 'DealerController@dealerProfile')->name('show');
        Route::get('product/list/{user?}', 'DealerController@products')->name('product.list');
        Route::match(['GET', 'POST'], 'product/edit/{product}', 'DealerController@productedit')->name('product.edit');
        Route::match(['GET', 'POST'], 'product/details/{product}', 'DealerController@productdetail')->name('product.detail');
        // // Route::post('user/store/{id?}', 'UserController@store')->name('store');
        // Route::get('user/edit/{id}', 'UserController@edit')->name('edit');
        // Route::get('user/delete/{id}', 'UserController@destroy')->name('delete');
        // Route::get('users/deleted', 'UserController@deletedUsers')->name('deleted');
        // Route::get('user/restore/{id}', 'UserController@restore')->name('restore');
    });
    // Route::post('update/{id}', 'UserController@store')->name('users.update');
    //category
    Route::name('category.')->group(function () {
        Route::get('categories', 'CategoryController@index')->name('index');
        Route::get('category/add', 'CategoryController@create')->name('add');
        Route::post('categories/store/{id?}', 'CategoryController@store')->name('store');
        Route::get('categories/{id}/edit', 'CategoryController@edit')->name('edit');
        Route::get('categories/{id}/delete', 'CategoryController@destroy')->name('delete');
    });
    Route::name('products.')->group(function () {
        Route::get('list', 'ProductsController@index')->name('list');
    });

    Route::name('profile.')->group(function () {
        Route::get('/profile', 'ProfileController@profile')->name('view');
        Route::post('/profile/update', 'ProfileController@update')->name('update');
    });
});
