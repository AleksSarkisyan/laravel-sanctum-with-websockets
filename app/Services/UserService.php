<?php

namespace App\Services;

use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
  use ResponseTrait;

  public function authenticate(LoginUserRequest $request)
  {
    $credentials = $request->validated();

    if (!Auth::attempt($credentials)) {
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
}
