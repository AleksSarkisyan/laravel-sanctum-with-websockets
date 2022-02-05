<?php

namespace App\Services;

use App\Contracts\UserServiceContract;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceContract
{
  use ResponseTrait;

  public function register(LoginUserRequest $request)
  {
    $credentials = $request->validated();

    $hashedPassword = Hash::make($credentials['password']);

    User::firstOrCreate([
      'email' => $credentials['email'],
      'name' => $credentials['email'],
      'password' => $hashedPassword
    ]);

    return $this->responseGeneric(true, 'OK', 200);
  }

  public function login(LoginUserRequest $request)
  {
    $credentials = $request->validated();

    if (!Auth::guard('web')->attempt($credentials)) {
      return $this->responseError('Unauthorized', 403);
    }

    $request->session()->regenerate();

    return $this->responseGeneric(true, 'OK', 200);
  }

  public function logout()
  {
    return Auth::guard('web')->logout();
  }
}
