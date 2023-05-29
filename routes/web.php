<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('user', 'App\Http\Controllers\UserController');


Route::resource('products', 'App\Http\Controllers\ProductController');
Route::resource('orders', 'App\Http\Controllers\OrderController');


Route::group(['middleware' => 'auth'], function () {
    Route::get('cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::put('cart', [App\Http\Controllers\CartController::class, 'put'])->name('cart.put');
    Route::delete('cart', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.removeItem');
    Route::any('cart/create', [\App\Http\Controllers\CartController::class, 'create'])->name('order.create');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
