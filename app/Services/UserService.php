<?php

namespace App\Services;

use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Requests\LoginUserRequest;
use App\Requests\RestaurantRegistrationRequest;
use App\Models\User;
use App\Models\RestaurantUser;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserService
{
  use ResponseTrait;

  public function authenticate(LoginUserRequest $request)
  {
    $credentials = $request->validated();

    if (!Auth::guard('web')->attempt($credentials)) {
      return $this->responseError('Unauthorized', 403);
    }

    $request->session()->regenerate();

    return $this->responseGeneric(true, 'OK', 200);
  }

  public function register(LoginUserRequest $request)
  {
    try {
      $credentials = $request->validated();

      $hashedPassword = Hash::make($credentials['password']);

      User::firstOrCreate([
        'email' => $credentials['email'],
        'name' => $credentials['email'],
        'password' => $hashedPassword
      ]);

      return $this->responseGeneric(true, 'OK', 200);
    } catch (\Exception $e) {
      return $this->responseError($e->getMessage(), 400);
    }
  }

  public function logout($request)
  {
    return Auth::guard('web')->logout();
  }


  /** Restaurant Auth Functions */

  public function restaurantRegistration(RestaurantRegistrationRequest $request)
  {
    try {
      $credentials = $request->validated();
      $credentials['password'] = Hash::make($credentials['password']);

      /** Restaurant name should be unique. Check it first before creating anything */
      $restaurantExist = Restaurant::where('name', '=',  $credentials['restaurantName'])->exists();

      if ($restaurantExist) {
        return $this->responseError('This restaurant already exists.', 400);
      }

      // return response()->json([
      //   'restaurantExist' => $restaurantExist
      // ]);

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

  public function restaurantLogin(LoginUserRequest $request)
  {
    $credentials = $request->validated();

    if (!Auth::guard('restaurant')->attempt($credentials)) {
      return $this->responseError('Unauthorized', 403);
    }

    $request->session()->regenerate();

    // $user = $request->user()->only(['name', 'email', 'city']);

    $user =  Auth::guard('restaurant')->user();

    // return response()->json([
    //   'test' => Auth::guard('restaurant')->user()->restaurants,
    //   'user' => $user,
    //   //'restaurants' => $user->with('restaurants')->get(),
    // ]);

    $user['restaurants'] = Auth::guard('restaurant')->user()->restaurants;

    return response()->json([
      'data' => $user
    ]);
    return $this->responseSuccess($user, 200);
  }

  public function restaurantLogout(Request $request)
  {
    return Auth::guard('restaurant')->logout();
  }
}
