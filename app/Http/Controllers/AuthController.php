<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use App\Requests\LoginUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

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

  /**
   * Handle an authentication attempt.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function register(LoginUserRequest $request, UserService $userService)
  {
    return $userService->register($request);
  }

  public function getUser(Request $request)
  {
    return $request->user()->only(['name', 'email']);
  }
}
