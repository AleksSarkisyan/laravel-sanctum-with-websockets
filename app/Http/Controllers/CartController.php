<?php

namespace App\Http\Controllers;

use App\Contracts\CartServiceContract;
use App\Events\ItemAdded;
use App\Events\OrderCreated;
use Illuminate\Http\Request;


class CartController extends Controller
{

  public function get(CartServiceContract $cartService)
  {
    broadcast(new ItemAdded);
    event(new ItemAdded());

    event(new OrderCreated());

    broadcast(new OrderCreated());
    return $cartService->get();
  }

  public function add(Request $request, CartServiceContract $cartService)
  {
    return $cartService->add($request);
  }
}
