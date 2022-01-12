<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{

  public function get(Request $request)
  {
    return response()->json([
      'restaurants' => Restaurant::all(['id', 'name', 'city', 'menu_id'])
        ->whereNotNull('menu_id')
        ->toArray()
    ]);
  }

  public function update(Request $request)
  {
    $params = $request->get('params');

    $conditions = ['id' => $params['restaurantId']];
    $updates = ['menu_id' => $params['menuId']];

    $result = Restaurant::where($conditions)->update($updates);

    return response()->json([
      'success' => $result == 1 ? true : false
    ]);
  }

  public function getbyId(Request $request)
  {
    $params = $request->get('params');
    $restaurant = Restaurant::where('id', $params['restaurantId'])->get();

    return response()->json([
      'restaurant' => $restaurant[0]
    ]);
  }
}
