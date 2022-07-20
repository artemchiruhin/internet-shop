<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\User\CartController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::group(['as' => 'user.'], function() {
    Route::get('/profile', [IndexController::class, 'profile'])->middleware('auth')->name('profile');
    Route::group(['as' => 'products.', 'prefix' => 'products'], function() {
        Route::get('/{product}', [\App\Http\Controllers\User\ProductController::class, 'show'])->name('show');
        Route::post('/products/{product}/add-to-cart', [\App\Http\Controllers\User\ProductController::class, 'addProductToCart'])->name('addToCart');
        Route::post('/products/{product}/remove-from-cart', [\App\Http\Controllers\User\ProductController::class, 'removeProductFromCart'])->name('removeFromCart');
    });
    Route::group(['as' => 'cart.'], function() {
        Route::get('/cart', [CartController::class, 'index'])->name('index');
        Route::post('/cart/make-order', [CartController::class, 'makeOrder'])->middleware('auth')->name('makeOrder');
    });
});

Route::group(['as' => 'auth.', 'middleware' => ['guest']], function() {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('auth.logout');

Route::group(['as' => 'verification.', 'prefix' => 'email/verify'], function() {
    Route::get('/', [IndexController::class, 'verificationMessage'])->middleware('auth')->name('notice');
    Route::get('/{id}/{hash}', [IndexController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verify');
});

Route::post('/email/verification-notification', [IndexController::class, 'resendEmailVerificationMessage'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::group(['as' => 'password.', 'middleware' => ['guest']], function() {
    Route::get('/forgot-password', [ResetPasswordController::class, 'forgotPasswordForm'])->name('request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->name('email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPasswordForm'])->name('reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('update');
});

Route::group(['as' => 'admin.', 'prefix' => '/admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resources([
        'categories' => CategoryController::class,
        'products' => ProductController::class
    ]);
    Route::group(['as'=> 'orders.', 'prefix' => 'orders'], function() {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::patch('/{order}/approve', [OrderController::class, 'approve'])->name('approve');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
    });
});
