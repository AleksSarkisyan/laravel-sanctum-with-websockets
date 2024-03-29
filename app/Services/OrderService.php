<?php

namespace App\Services;

use App\Contracts\OrderServiceContract;
use App\Events\OrderConfirmed;
use App\Events\OrderCreated;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use App\Requests\CreateOrderRequest;
use Illuminate\Support\Facades\Session;

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

  public function getAllByRestaurantId(Request $request)
  {
    $orders = Order::with('user:id,name,email')
      ->where('restaurant_id', $request->get('restaurantId'))
      ->get();

    return response()->json([
      'orders' => $orders
    ]);
  }

  public function getOrderProducts($orderId)
  {
    $productIds = Order::find($orderId)
      ->orderProducts()
      ->pluck('product_id')
      ->toArray();

    $orderDetails = Order::where('id', $orderId)
      ->get(['id', 'total_quantity', 'total_price', 'created_at', 'status']);

    $orderDetails[0]->user = Auth::guard('web')->user();

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

  public function add(Request $request)
  {
    $params = Session::get('cart');
    $additional = $params['additional'];
    $products = $params['products'];
    $restaurantId = $additional['restaurantId'];

    $user = Auth::guard('web')->user();

    $orderParams = [
      'user_id' => $user->id,
      'restaurant_id' => $restaurantId,
      'total_quantity' => $additional['totalCartQuantity'],
      'total_price' => $additional['totalCartPrice'],
      'status' => 'created'
    ];

    $orderResult = Order::create($orderParams);

    $orderProductParams = [];

    foreach ($products as $value) {
      array_push($orderProductParams, [
        'order_id' => $orderResult['id'],
        'product_id' => $value['id'],
        'quantity' => $value['quantity'],
        'price' => $value['price'] * $value['quantity'],
        'created_at' => new \dateTime,
        'updated_at' => new \dateTime,
      ]);
    }

    OrderProduct::insert($orderProductParams);

    $orderProducts = $this->getOrderProducts($orderResult['id']);
    $restaurantUserId = Restaurant::where('id', $restaurantId)->pluck('user_id');

    event(new OrderCreated($orderProducts, $restaurantId, $restaurantUserId[0]));

    return response()->json([
      'success' => true,
      // 'restaurantUserId' => $restaurantUserId[0],
      // 'restaurantId' => $restaurantId
    ]);
  }

  public function confirmOrder(Request $request)
  {
    $params = $request->get('params');
    $orderId = $params['orderId'];
    $order = Order::where('id', $orderId)->get(['user_id', 'restaurant_id'])[0];
    Order::where('id', $orderId)->update(['status' => 'confirmed']);

    $restaurantName = Restaurant::where('id', $order['restaurant_id'])->pluck('name')[0];

    $orderDetails = [
      'userId' =>  $order['user_id'],
      'restaurantName' =>  $restaurantName,
    ];

    event(new OrderConfirmed($orderDetails));

    return response()->json([
      'success' => true
    ]);
  }
}
