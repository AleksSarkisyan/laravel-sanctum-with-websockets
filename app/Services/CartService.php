<?php

namespace App\Services;

use App\Contracts\CartServiceContract;
use App\Traits\ResponseTrait;

class CartService implements CartServiceContract
{
  use ResponseTrait;

  public function get()
  {
    return response()->json([
      'cart' => 'test cart'
    ]);
  }

  public function add($request)
  {
  }
}
