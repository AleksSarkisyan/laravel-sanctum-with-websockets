<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Broadcast;

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

// Route::prefix('order')->group(function () {
//     Route::post('/add', [OrderController::class, 'add']);
//     Route::get('/get', [OrderController::class, 'get']);
// });

Route::get('/api/cart/get', [CartController::class, 'get']);

Route::prefix('api')->group(function () {
    Route::get('/cart/get', [CartController::class, 'get']);
});

Broadcast::channel('items', function () {
    return 'kvooo ';
});

Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', [AuthController::class, 'getUser']);

    Route::prefix('order')->group(function () {
        Route::post('/add', [OrderController::class, 'add']);
        Route::get('/get', [OrderController::class, 'get']);
    });

    // Broadcast::channel('orders', function ($user, $id) {
    //     return 'kvooo ';
    // });
});
