<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantAuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CategoryController;

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

Broadcast::channel('orderCreated.{restaurantId}.{userId}', function ($user, $restaurantId, $userId) {
    return (int) Auth::guard('restaurant')->user()->id === (int) $userId;
}, ['guards' => ['restaurant']]);

Broadcast::channel('orderConfirmed.{userId}', function ($user, $userId) {
    return (int) Auth::guard('web')->user()->id === (int) $userId;
}, ['guards' => ['web']]);

/** Public routes */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('register-restaurant', [RestaurantAuthController::class, 'register']);
Route::post('restaurant/login', [RestaurantAuthController::class, 'login']);

Route::prefix('restaurants')->group(function () {
    Route::get('/', [RestaurantController::class, 'get']);
    Route::post('/get-menu', [RestaurantController::class, 'getRestaurantMenu']);
});

/** Protected routes for regular users */
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', [AuthController::class, 'getUser']);

    Route::prefix('cart')->group(function () {
        Route::post('/add', [CartController::class, 'add']);
        Route::get('/get', [CartController::class, 'get']);
    });

    Route::prefix('order')->group(function () {
        Route::post('/add', [OrderController::class, 'add']);
        Route::get('/get', [OrderController::class, 'get']);
    });

    Route::post('logout', [AuthController::class, 'logout']);
});

/** Protected routes for restaurant users (CMS) */
Route::group(['middleware' => ['auth:restaurant']], function () {
    Route::prefix('restaurant-cms')->group(function () {
        Route::post('/logout', [RestaurantAuthController::class, 'logout']);
        Route::post('/get', [RestaurantController::class, 'getById']);
        Route::post('/update', [RestaurantController::class, 'update']);

        Route::prefix('menu')->group(function () {
            Route::get('/get', [MenuController::class, 'get']);
            Route::get('/get-all', [MenuController::class, 'getAllById']);
            Route::post('/create', [MenuController::class, 'create']);
            Route::post('/save', [MenuController::class, 'save']);
        });

        Route::prefix('order')->group(function () {
            Route::get('/restaurant-orders', [OrderController::class, 'getAllByRestaurantId']);
            Route::post('/confirm', [OrderController::class, 'confirmOrder']);
        });

        Route::prefix('category')->group(function () {
            Route::get('/get', [CategoryController::class, 'get']);
            Route::get('/get-all', [CategoryController::class, 'getAll']);
            Route::post('/create', [CategoryController::class, 'create']);
        });
    });
});
