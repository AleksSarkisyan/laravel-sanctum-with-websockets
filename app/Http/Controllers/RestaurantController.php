<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{

  public function __construct()
  {
    $this->user = Auth::guard('web')->user();
  }

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

  public function getRestaurantMenu(Request $request)
  {
    /** Could instead do some joins to get the categories... */
    $allCategories = Category::all()->pluck('id', 'name')->toArray();
    $params = $request->get('params');

    foreach ($allCategories as $name => $categoryId) {
      $categoriesWithProducts[$name] = DB::table('menus')
        ->select(
          'restaurants.id as restaurant_id',
          'restaurants.menu_id as menu_id',
          'menus.name as menu_name',
          'menus_products.menu_id',
          'menus_products.product_id',
          'products.*'
        )
        ->join('restaurants', 'restaurants.menu_id', '=', 'menus.id')
        ->join('menus_products', 'menus_products.menu_id', '=', 'menus.id')
        ->join('products', 'products.id', '=', 'menus_products.product_id')
        ->join('categories', 'categories.id', '=', 'products.category_id');

      if (isset($params['id']) && !empty($params['id'])) {
        $categoriesWithProducts[$name] = $categoriesWithProducts[$name]->where(['restaurants.id' => $params['id']]);
      } else {
        $categoriesWithProducts[$name] = $categoriesWithProducts[$name]->where(['restaurants.name' => $params['name']]);
      }

      $categoriesWithProducts[$name] = $categoriesWithProducts[$name]->where('categories.id', $categoryId)->get();

      if (count($categoriesWithProducts[$name]) == 0) {
        unset($categoriesWithProducts[$name]);
      }
    }

    $firstCategory = array_key_first($categoriesWithProducts);

    return response()->json([
      'menu' => $categoriesWithProducts,
      'firstCategory' => $firstCategory
    ]);
  }
}
