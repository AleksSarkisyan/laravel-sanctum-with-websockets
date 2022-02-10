<?php

namespace App\Contracts;

use App\Requests\CreateOrderRequest;
use Illuminate\Http\Request;

interface OrderServiceContract
{
  public function get();
  public function getOrderProducts($orderId);
  public function getAllByRestaurantId(Request $request);
  public function add(Request $request);
  public function confirmOrder(Request $request);
}
