<?php

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

Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);

Route::resource('items', App\Http\Controllers\ItemController::class);
Route::get('items/categories/{id}', [App\Http\Controllers\ItemController::class, 'itemCategory'])->name('item_category');
Route::get('carts', [App\Http\Controllers\ItemController::class, 'itemCart'])->name('item_cart');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('users',App\Http\Controllers\UserController::class)->middleware('auth');

Route::post('orderNow',[App\Http\Controllers\ItemController::class, 'orderNow'])->name('orderNow');
//Admim backend

Route::group(['middleware'=>['auth','role:Super Admin|Admin'],'prefix'=>'backend', 'as'=>'backend.'],function(){
    Route::get('/',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('items', App\Http\Controllers\Admin\ItemController::class);
    Route::resource('users',App\Http\Controllers\Admin\UserController::class)->middleware('role:Super Admin');
    Route::get('orders',[App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders');
    Route::get('orderAccept',[App\Http\Controllers\Admin\OrderController::class, 'orderAccept'])->name('orderAccept');
    Route::get('orderComplete',[App\Http\Controllers\Admin\OrderController::class, 'orderComplete'])->name('orderComplete');

    Route::get('orders/{voucherNo}',[App\Http\Controllers\Admin\OrderController::class, 'detail'])->name('orders.detail');
    Route::put('orders/{voucherNo}',[App\Http\Controllers\Admin\OrderController::class, 'status'])->name('orders.status');

});