<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dealer\DealerController;
use App\Http\Controllers\Dealer\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    if (Auth::check())
        return redirect()->route('redirect-to-dashboard');
    else
        return view('welcome');
})->name('welcome');

Route::get('redirect-to-dashboard', [HomeController::class, 'redirectToDashboard'])->name('redirect-to-dashboard');
Route::get('verify-email/{user}/{token}', [RegisterController::class, 'verifyEmail'])->name('verify-email');

Auth::routes();


Route::middleware(['auth', 'verified'])->namespace('App\Http\Controllers')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [HomeController::class, 'logout'])->name('custom.logout');
    Route::match(['GET', 'POST'], '/change/password', [HomeController::class, 'changePassword'])->name('change.password');
});
