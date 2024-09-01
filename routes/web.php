<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;


/* Admin Auth Routes */
Route::group(['middleware' => 'guest'], function () {
    Route::get('admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
});

require __DIR__ . '/auth.php';

// Show Home Page
Route::get('/', [FrontendController::class, 'index'])->name('home');

// Show Product details page
Route::get('/product/{slug}', [FrontendController::class, 'showProduct'])->name('product.show');

// product Modal Route
Route::get('/load-product-modal{productId}', [FrontendController::class, 'loadProductModal'])->name('load-product-modal');

// Add to cart Route
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');

Route::get('get-cart-products', [CartController::class, 'gatCartProduct'])->name('get-cart-products');

Route::get('cart-product-remove/{rowId}', [CartController::class, 'cartProductRemove'])->name('cart-product-remove');

