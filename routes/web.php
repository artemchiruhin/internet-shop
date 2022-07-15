<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\IndexController;
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
});

Route::group(['as' => 'auth.', 'middleware' => ['guest']], function() {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('auth.logout');

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
