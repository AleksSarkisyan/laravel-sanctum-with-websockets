<?php

use App\Models\RestaurantUser;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// Broadcast::channel('private-testPrivate.{id}', function ($user, $id) {
//     // return (int) $user->id === (int) $id;
//     return true;
// });

// Broadcast::routes(['middleware' => ['auth:sanctum', 'auth:restaurant']]);

// Route::group(['middleware' => ['auth:restaurant']], function () {
// Broadcast::channel('testPrivate.{userId}', function ($user) {
//     // return response()->json([
//     //     'user' => $user
//     // ]);
//     return true;
// });
// });
