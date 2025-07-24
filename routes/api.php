<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CartController
};

Route::controller(CartController::class)->group(function () {
    Route::post('add-to-cart', 'addToCart')->name('add.To.Cart');
    Route::get('get-cart', 'getCart')->name('get.Cart');
    Route::post('update-cart', 'updateCart')->name('update.Cart');
    Route::delete('delete-cart', 'deleteCart')->name('delete.Cart');
    Route::post('checkout', 'checkout')->name('checkout');
});
