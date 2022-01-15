<?php

namespace App\Services;

use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Requests\LoginUserRequest;
use App\Requests\RestaurantRegistrationRequest;
use App\Models\RestaurantUser;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Contracts\RestaurantUserServiceContract;

class RestaurantUserService implements RestaurantUserServiceContract
{
  use ResponseTrait;

  public function register(RestaurantRegistrationRequest $request)
  {
    try {
      $credentials = $request->validated();
      $credentials['password'] = Hash::make($credentials['password']);

      /** Restaurant name should be unique. Check it first before creating anything */
      $restaurantExist = Restaurant::where('name', '=',  $credentials['restaurantName'])->exists();

      if ($restaurantExist) {
        return $this->responseError('This restaurant already exists.', 400);
      }

      $restaurantCreateData = [
        'name' => $credentials['restaurantName']
      ];

      unset($credentials['restaurantName']);

      /** User could own more than one restaurant - don't attempt inserting new user, just create the restaurant */
      $restaurantUser = RestaurantUser::where('email', '=',  $credentials['email'])->get();

      if (!isset($restaurantUser[0])) {
        $restaurantUser[0] = RestaurantUser::create($credentials);
      }

      $restaurantCreateData['user_id'] = $restaurantUser[0]->id;
      $restaurantCreateData['city'] = $restaurantUser[0]->city;

      Restaurant::firstOrCreate($restaurantCreateData);

      return $this->responseGeneric(true, 'You have successfully your restaurant', 200);
    } catch (\Exception $e) {
      return $this->responseError($e->getMessage(), 400);
    }
  }

  public function login(LoginUserRequest $request)
  {
    $credentials = $request->validated();

    if (!Auth::guard('restaurant')->attempt($credentials)) {
      return $this->responseError('Unauthorized', 403);
    }

    $request->session()->regenerate();

    $user = Auth::guard('restaurant')->user();

    $user['restaurants'] = Auth::guard('restaurant')->user()->restaurants;

    return response()->json([
      'data' => $user
    ]);
  }

  public function logout(Request $request)
  {
    return Auth::guard('restaurant')->logout();
  }
}
