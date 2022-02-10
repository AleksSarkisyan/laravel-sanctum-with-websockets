<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Contracts\OrderServiceContract;
use App\Requests\CreateOrderRequest;


class OrderController extends Controller
{

  public function get(OrderServiceContract $orderService)
  {
    return $orderService->get();
  }

  public function getAllByRestaurantId(Request $request, OrderServiceContract $orderService)
  {
    return $orderService->getAllByRestaurantId($request);
  }

  public function add(Request $request, OrderServiceContract $orderService)
  {
    return $orderService->add($request);
  }

  public function confirmOrder(Request $request, OrderServiceContract $orderService)
  {
    return $orderService->confirmOrder($request);
  }
}
