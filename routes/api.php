<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['as' => 'api.'], function() {
    Route::apiResources([
        'categories' => CategoryController::class,
        'products' => ProductController::class
    ]);

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function() {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::patch('/{order}/approve', [OrderController::class, 'approve'])->name('approve');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
    });
});
