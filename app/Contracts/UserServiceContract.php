<?php

namespace App\Contracts;

use App\Requests\LoginUserRequest;

interface UserServiceContract
{
  public function register(LoginUserRequest $request);
  public function login(LoginUserRequest $request);
  public function logout();
}
