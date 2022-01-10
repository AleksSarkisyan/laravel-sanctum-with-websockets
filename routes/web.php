<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantAuthController;


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

Route::post('register', [AuthController::class, 'register']);
Route::post('register-restaurant', [RestaurantAuthController::class, 'registerRestaurant']);
Route::post('login', [AuthController::class, 'authenticate']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('test', [TestController::class, 'test']);


Route::prefix('restaurants')->group(function () {
    Route::get('/', [RestaurantController::class, 'get']);
});

Route::post('/admin/restaurant/login', [RestaurantAuthController::class, 'loginRestaurant']);

Route::group(['middleware' => ['auth:restaurant']], function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('restaurant')->group(function () {
            // Route::post('/login', [RestaurantAuthController::class, 'loginRestaurant']);
            Route::post('/logout', [RestaurantAuthController::class, 'logout']);
        });
    });
});

Route::get('/', function () {
    return view('welcome');
});
