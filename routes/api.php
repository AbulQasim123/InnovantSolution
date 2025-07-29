<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    CartController,
    ProductController
};

// Public Routes
Route::controller(AuthController::class)->group(function () {
    Route::post('register-customer', 'RegisterCustomer');
    Route::post('send-otp', 'sendOtp');
    Route::post('login', 'login');
});


// Product Routes
Route::controller(ProductController::class)->group(function () {
    Route::get('get-product', 'getProdct')->name('get.Product');
});

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('profile', 'profile');
        Route::post('update-profile', 'updateProfile');
        Route::post('logout', 'logout');
        Route::delete('delete-account', 'deleteAccount');
    });

    // Cart Routes
    Route::controller(CartController::class)->group(function () {
        Route::post('add-to-cart', 'addToCart')->name('add.To.Cart');
        Route::get('get-cart', 'getCart')->name('get.Cart');
        Route::post('update-cart', 'updateCart')->name('update.Cart');
        Route::delete('delete-cart', 'deleteCart')->name('delete.Cart');
        Route::post('checkout', 'checkout')->name('checkout');
        Route::post('pay-now', 'payNow')->name('pay.Now');
        Route::post('verify-payment', 'verifyPayment')->name('verify.Payment');
    });
});
