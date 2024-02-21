<?php

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

Route::middleware(['auth','verified','admin'])->namespace('App\Http\Controllers\Admin')->name('admin.')->group(function () {
   Route::match('get', 'dashboard', 'AdminController@dashboard')->name('dashboard');
   Route::get('show', 'AdminController@show')->name('show');
   Route::get('edit', 'AdminController@edit')->name('edit');

   // Stripe settings
   Route::name('settings.')->group(function () {
      Route::get('settings', 'AdminController@settings')->name('view');
      Route::post('settings/update', 'AdminController@settingsUpdate')->name('update');
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
      Route::get('cms/edit/{id}', 'CmsManagementController@edit')->name('edit');
      Route::get('cms/restore/{id}', 'CmsManagementController@restore')->name('restore');
      Route::post('cms/update/{id}', 'CmsManagementController@update')->name('update');
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
   Route::name('users.')->group(function () {
      Route::get('users', 'UserController@index')->name('all');
      Route::get('pre/users', 'UserController@preLaunchIndex')->name('pre.launch.all');
      Route::get('pre/users/export', 'UserController@preUserExport')->name('pre.export');
      Route::get('add/user', 'UserController@create')->name('add');
      Route::get('user/profile/{id}', 'UserController@userProfile')->name('show');
      // Route::post('user/store/{id?}', 'UserController@store')->name('store');
      Route::get('user/edit/{id}', 'UserController@edit')->name('edit');
      Route::get('user/delete/{id}', 'UserController@destroy')->name('delete');
      Route::get('users/deleted', 'UserController@deletedUsers')->name('deleted');
      Route::get('user/restore/{id}', 'UserController@restore')->name('restore');
      Route::post('update/{id}', 'UserController@store')->name('update');
   });

});
