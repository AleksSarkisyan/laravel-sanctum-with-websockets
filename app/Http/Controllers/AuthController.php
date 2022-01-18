<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use App\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use App\Contracts\UserServiceContract;

class AuthController extends Controller
{

  use ResponseTrait;

  /**
   * Handle an authentication attempt.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function login(LoginUserRequest $request, UserServiceContract $userService)
  {
    return $userService->login($request);
  }

  /**
   * Handle an authentication attempt.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function register(LoginUserRequest $request, UserServiceContract $userService)
  {
    return $userService->register($request);
  }

  public function logout(Request $request, UserServiceContract $userService)
  {
    return $userService->logout($request);
  }

  public function getUser(Request $request)
  {
    return $request->user()->only(['name', 'email', 'id']);
  }
}
