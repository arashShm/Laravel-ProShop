<?php

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

Route::prefix('cart')->group(function () {
    Route::get('/', [Modules\Cart\Http\Controllers\Frontend\CartController::class, 'cart'])->name('cart');
    Route::post('/add/{product}', [Modules\Cart\Http\Controllers\Frontend\CartController::class, 'addToCart'])->name('add.cart');
    Route::patch('/quantity/change', [Modules\Cart\Http\Controllers\Frontend\CartController::class, 'quantityChange']);
    Route::delete('/delete/{cart}', [Modules\Cart\Http\Controllers\Frontend\CartController::class, 'deleteFromCart'])->name('cart.destroy');
});
