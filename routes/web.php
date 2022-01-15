<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantAuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

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

/** Public routes for regular users */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::prefix('restaurants')->group(function () {
    Route::get('/', [RestaurantController::class, 'get']);
    Route::post('/get-menu', [RestaurantController::class, 'getRestaurantMenu']);
});

Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'add']);
    Route::get('/get', [CartController::class, 'get']);
});

Route::prefix('order')->group(function () {
    Route::post('/add', [OrderController::class, 'add']);
    Route::get('/get', [OrderController::class, 'get']);
});

/** Public routes for restaurant users */
Route::post('register-restaurant', [RestaurantAuthController::class, 'register']);
Route::post('/restaurant/login', [RestaurantAuthController::class, 'login']);

/** Protected routes for restaurant users */
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
    });
});

Route::get('/', function () {
    return view('welcome');
});
