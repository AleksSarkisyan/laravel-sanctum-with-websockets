<?php

namespace App\Services;

use App\Contracts\OrderServiceContract;
use App\Events\OrderCreated;
use App\Events\TestPrivate;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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

  public function getAllByRestaurantId($restaurantId)
  {
  }

  public function getOrderProducts($orderId)
  {
    $productIds = Order::find($orderId)
      ->orderProducts()
      ->pluck('product_id')
      ->toArray();

    $orderDetails = Order::where('id', $orderId)
      ->get(['id', 'total_quantity', 'total_price']);

    $products = DB::table('orders')->select(
      'orders.id as order_id',
      'order_products.product_id',
      'order_products.quantity',
      'order_products.price',
      'products.name as product_name',
      'products.price',
      'products.category_id',
      'categories.name as category_name'
    )
      ->join('order_products', 'order_products.order_id', '=', 'orders.id')
      ->join('products', 'products.id', '=', 'order_products.product_id')
      ->join('categories', 'categories.id', '=', 'products.category_id')
      ->where('orders.id', $orderId)
      ->whereIn('order_products.product_id', $productIds)
      ->get();

    return response()->json([
      'products' => $products,
      'orderDetails' => $orderDetails[0]
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

    $orderProducts = $this->getOrderProducts($orderResult['id']);
    // event(new OrderCreated($orderProducts));

    event(new TestPrivate($orderProducts));

    //broadcast(new OrderCreated());

    // return $this->getOrderProducts($orderResult['id']);

    return response()->json([
      'success' => true
    ]);
  }
}
