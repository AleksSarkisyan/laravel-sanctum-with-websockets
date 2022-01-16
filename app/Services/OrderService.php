<?php

namespace App\Services;

use App\Contracts\OrderServiceContract;
use App\Events\OrderCreated;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderService implements OrderServiceContract
{
  use ResponseTrait;

  public $user = null;

  public function __construct()
  {
    $this->user = Auth::guard('restaurant')->user();
  }

  public function get()
  {
    return response()->json([
      'success' => true
    ]);
  }

  /** All this should be retrieved from the Session, instead of trusting the FE */
  public function add(Request $request)
  {
    $params = $request->get('params');
    $user = Auth::guard('web')->user();

    $restaurant = $params['restautant'];

    if (!isset($restaurant['id']) || empty($restaurant['id'])) {
      $restaurantId = Restaurant::where('name', $params['restautant']['name'])->pluck('id')[0];
    } else {
      $restaurantId = $params['restautant']['id'];
    }

    $orderParams = [
      'user_id' => $user->id,
      'restaurant_id' => $restaurantId,
      'total_quantity' => $params['totalCartQuantity'],
      'total_price' => $params['totalCartPrice']
    ];

    $orderResult = Order::create($orderParams);

    $orderProductParams = [];

    foreach ($params['productItems'] as $value) {
      array_push($orderProductParams, [
        'order_id' => $orderResult['id'],
        'product_id' => $value['id'],
        'quantity' => $value['quantity'],
        'price' => $value['singlePrice'] * $value['quantity'],
        'created_at' => new \dateTime,
        'updated_at' => new \dateTime,
      ]);
    }

    OrderProduct::insert($orderProductParams);

    // $orders = Order::all();
    event(new OrderCreated());

    broadcast(new OrderCreated());

    return response()->json([
      'success' => true
    ]);
  }
}
