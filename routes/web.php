<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantAuthController;
use App\Http\Controllers\MenuController;

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

/** Public routes for restaurant users */
Route::post('register-restaurant', [RestaurantAuthController::class, 'register']);
Route::post('/restaurant/login', [RestaurantAuthController::class, 'login']);

Route::prefix('restaurants')->group(function () {
    Route::get('/', [RestaurantController::class, 'get']);
});

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
