<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{

  public function get(Request $request)
  {
    return response()->json([
      'restaurants' => Restaurant::all(['id', 'name', 'city'])->toArray()
    ]);
  }
}
