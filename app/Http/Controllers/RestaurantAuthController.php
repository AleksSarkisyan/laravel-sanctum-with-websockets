<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use App\Requests\LoginUserRequest;
use App\Requests\RestaurantRegistrationRequest;
use App\Contracts\RestaurantUserServiceContract;
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
  public function register(RestaurantRegistrationRequest $request, RestaurantUserServiceContract $restaurantUserService)
  {
    return $restaurantUserService->register($request);
  }

  public function login(LoginUserRequest $request, RestaurantUserServiceContract $restaurantUserService)
  {
    return $restaurantUserService->login($request);
  }

  public function logout(Request $request, RestaurantUserServiceContract $restaurantUserService)
  {
    return $restaurantUserService->logout($request);
  }
}
