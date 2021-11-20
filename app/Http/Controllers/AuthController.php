<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use App\Requests\LoginUserRequest;
use App\Services\UserService;

class AuthController extends Controller
{

  use ResponseTrait;

  /**
   * Handle an authentication attempt.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function authenticate(LoginUserRequest $request, UserService $userService)
  {
    return $userService->authenticate($request);
  }
}
