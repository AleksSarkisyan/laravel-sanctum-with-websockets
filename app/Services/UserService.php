<?php

namespace App\Services;

use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Requests\LoginUserRequest;

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
}
