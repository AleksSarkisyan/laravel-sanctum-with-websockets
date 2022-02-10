<?php

namespace App\Services;

use App\Contracts\CartServiceContract;
use App\Models\Product;
use App\Requests\AddToCartRequest;
use Illuminate\Support\Facades\Session;

class CartService implements CartServiceContract
{
  public function get()
  {
  }

  public function add(AddToCartRequest $request)
  {
    $params = $request->validated();
    $productId = $params['product_id'];
    $restaurantId = $params['restaurant_id'];

    $product = Product::where('id', $productId)->first();
    $productPrice = (int) $product['price'];
    $productItem = 'cart.products.' . $productId;
    $totalCartQuantity = $totalCartPrice = null;

    if (Session::has($productItem)) {
      $quantity = Session::get($productItem . '.quantity');

      Session::put($productItem, [
        'id' => $productId,
        'name' => $product['name'],
        'quantity' => $quantity + 1,
        'price' => $productPrice,
        'summedPrice' => ($quantity + 1) * $productPrice
      ]);
    } else {
      Session::put($productItem, [
        'id' => $productId,
        'name' => $product['name'],
        'quantity' => 1,
        'price' => $productPrice,
        'summedPrice' => $productPrice
      ]);
    }

    $productItems = Session::get('cart.products');

    foreach ($productItems as $value) {
      $totalCartQuantity += $value['quantity'];
      $totalCartPrice += $value['summedPrice'];
    }

    Session::put('cart.additional', [
      'restaurantId' => $restaurantId,
      'totalCartQuantity' => $totalCartQuantity,
      'totalCartPrice' => $totalCartPrice
    ]);

    return response()->json([
      'success' => true,
      'cart' => Session::get('cart'),
    ]);
  }

  public function clear()
  {
    Session::forget('cart');
  }
}
