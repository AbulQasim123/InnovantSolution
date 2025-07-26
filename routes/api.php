<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CartController,
    CustomerController
};

// Cart Routes
Route::controller(CartController::class)->group(function () {
    Route::get('get-product', 'getProdct')->name('get.Product');
    Route::post('add-to-cart', 'addToCart')->name('add.To.Cart');
    Route::get('get-cart', 'getCart')->name('get.Cart');
    Route::post('update-cart', 'updateCart')->name('update.Cart');
    Route::delete('delete-cart', 'deleteCart')->name('delete.Cart');
    Route::post('checkout', 'checkout')->name('checkout');
});

// Customer Routes
Route::controller(CustomerController::class)->group(function () {
    Route::post('add-customer', 'AddCustomer')->name('add.Customer');
    Route::get('get-customer', 'getCustomer')->name('get.Customer');
});
