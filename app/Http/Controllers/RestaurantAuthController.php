<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use App\Requests\LoginUserRequest;
use App\Requests\RestaurantRegistrationRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class RestaurantAuthController extends Controller
{

  use ResponseTrait;

  /**
   * Handle an authentication attempt.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function registerRestaurant(RestaurantRegistrationRequest $request, UserService $userService)
  {
    return $userService->restaurantRegistration($request);
  }

  public function loginRestaurant(LoginUserRequest $request, UserService $userService)
  {
    return $userService->restaurantLogin($request);
  }

  public function logout(Request $request, UserService $userService)
  {
    return $userService->restaurantLogout($request);
  }
}
