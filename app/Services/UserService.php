<?php

namespace App\Services;

use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Requests\LoginUserRequest;
use App\Models\User;

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

      $credentials['password'] = md5($credentials['password']);



      $user = User::firstOrCreate([
        'email' => $credentials['email'],
        'name' => $credentials['email'],
        'password' => $credentials['password']
      ]);

      // return response()->json([
      //   'user' => $user
      // ]);

      //$request->session()->regenerate();

      return $this->responseGeneric(true, 'OK', 200);
    } catch (\Exception $e) {
      return $this->responseError($e->getMessage(), 400);
    }
  }
}
