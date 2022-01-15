<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface RestaurantServiceContract
{
  public function get();
  public function update(Request $request);
  public function getbyId(Request $request);
  public function getRestaurantMenu(Request $request);
}
