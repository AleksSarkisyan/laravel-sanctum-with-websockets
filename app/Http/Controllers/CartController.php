<?php

namespace App\Http\Controllers;

use App\Contracts\CartServiceContract;
use App\Requests\AddToCartRequest;
use Illuminate\Http\Request;

class CartController extends Controller
{

  public function get(CartServiceContract $cartService)
  {
    return $cartService->get();
  }

  public function add(AddToCartRequest $request, CartServiceContract $cartService)
  {
    return $cartService->add($request);
  }

  public function clear(Request $request, CartServiceContract $cartService)
  {
    return $cartService->clear();
  }
}
