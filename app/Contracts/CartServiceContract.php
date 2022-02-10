<?php

namespace App\Contracts;

use App\Requests\AddToCartRequest;
use Illuminate\Http\Request;

interface CartServiceContract
{
  public function get();
  public function add(AddToCartRequest $request);
  public function clear();
}
