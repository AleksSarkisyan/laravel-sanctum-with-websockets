<?php

namespace App\Contracts;

use App\Requests\RestaurantRegistrationRequest;
use App\Requests\LoginUserRequest;
use Illuminate\Http\Request;

interface RestaurantUserServiceContract
{
  public function register(RestaurantRegistrationRequest $request);
  public function login(LoginUserRequest $request);
  public function logout(Request $request);
}
