<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface OrderServiceContract
{
  public function get();
  public function getOrderProducts($orderId);
  public function getAllByRestaurantId($restaurantId);
  public function add(Request $request);
}
