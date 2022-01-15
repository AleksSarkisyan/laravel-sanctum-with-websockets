<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\RestaurantServiceContract;

class RestaurantController extends Controller
{

  public function get(RestaurantServiceContract $restaurantService)
  {
    return $restaurantService->get();
  }

  public function update(Request $request, RestaurantServiceContract $restaurantService)
  {
    return $restaurantService->update($request);
  }

  public function getbyId(Request $request, RestaurantServiceContract $restaurantService)
  {
    return $restaurantService->getbyId($request);
  }

  public function getRestaurantMenu(Request $request, RestaurantServiceContract $restaurantService)
  {
    return $restaurantService->getRestaurantMenu($request);
  }
}
