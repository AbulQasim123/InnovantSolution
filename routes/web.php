<?php

use App\Livewire\{
    AddProduct,
    Cart,
    Dashboard,
    Product,
    EditProduct,
    Profile,
    Customer
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

// Unprotected Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/admin', 'loadLogin')->name('load.login');
    Route::post('/login', 'postLogin')->name('post.login');
    Route::get('/login', function () {
        return redirect()->route('load.login');
    })->name('login');
    Route::get('/admin/dashboard', function () {
        return redirect()->route('load.login');
    });
});

// Protected Routes
Route::group(['prefix' => 'admin/', 'middleware' => ['web', 'auth', 'is_admin']], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::get('dashboad', Dashboard::class)->name('dashboard');
    Route::get('profile', Profile::class)->name('profile');

    Route::get('customers', Customer::class)->name('customer.list');
    Route::get('products', Product::class)->name('products.list');
    Route::get('add-product', AddProduct::class)->name('add.product');
    Route::get('edit-product/{id}', EditProduct::class)->name('edit.product');

    Route::get('cart', Cart::class)->name('cart.list');
});

Route::fallback(function () {
    return view('errors.404');
});
