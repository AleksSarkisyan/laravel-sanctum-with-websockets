<?php

namespace App\Services;

use App\Contracts\MenuServiceContract;
use App\Traits\ResponseTrait;
use App\Requests\CreateMenuRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Category;
use App\Models\MenuProduct;

class MenuService implements MenuServiceContract
{
  use ResponseTrait;

  public $user = null;

  public function __construct()
  {
    $this->user = Auth::guard('restaurant')->user();
  }

  public function create(CreateMenuRequest $request)
  {
    try {
      $data = $request->all();
      $data['user_id'] = $this->user->id;
      $data['is_active'] = $data['isActive'];

      $result = Menu::create($data);

      return response()->json([
        'result' => $result
      ]);

      return $this->responseGeneric(true, 'OK', 200);
    } catch (\Exception $e) {
      return $this->responseError($e->getMessage(), 400);
    }
  }

  public function getAllById(Request $request)
  {
    try {
      $menus = Menu::where('user_id', $this->user->id)->orderBy('updated_at', 'desc')->get();

      return response()->json([
        'data' => $menus
      ]);
    } catch (\Exception $e) {
      return $this->responseError($e->getMessage(), 400);
    }
  }

  public function get(Request $request)
  {
    try {
      $menuId = $request->get('menuId');

      if (!$menuId) {
        return response()->json([
          'error' => 'Missing menu id'
        ]);
      }

      $menuConditions = [
        'id' => $menuId,
        'user_id' => $this->user->id
      ];

      $menu = Menu::where($menuConditions)->get();

      // $productConditions = ['products.' . 'user_id' => $this->user->id];
      // $userProducts = Product::with(['category'])->where($productConditions)->get();

      $categories = Category::all();

      foreach ($categories as $key => $category) {
        $userProducts[$category->name] = Product::with(['category'])
          ->where([
            'products.' . 'user_id' => $this->user->id,
            'products.' . 'category_id' => $category->id
          ])->get();

        if (count($userProducts[$category->name]) == 0) {
          unset($userProducts[$category->name]);
        }
      }

      $menuProductConditions = [
        'menu_id' => $menuId,
        'user_id' => $this->user->id
      ];

      $productItems = MenuProduct::where($menuProductConditions)->pluck('product_id')->toArray();

      return response()->json([
        'menu' => $menu[0],
        'products' => $userProducts,
        'productItems' => $productItems
      ]);
    } catch (\Exception $e) {
      return $this->responseError($e->getMessage(), 400);
    }
  }

  public function save(Request $request)
  {
    if (!$request->params['menuId']) {
      return response()->json([
        'error' => 'Missing menu id'
      ]);
    }

    if (!isset($request->params['productItems']) || empty($request->params['productItems'])) {
      return response()->json([
        'error' => 'Missing products'
      ]);
    }

    $deleteConditions = [
      'user_id' => $this->user->id,
      'menu_id' => $request->params['menuId']
    ];

    MenuProduct::where($deleteConditions)->delete();

    $dataInsert = [];

    foreach ($request->params['productItems'] as $productId) {
      $dataInsert[] = [
        'user_id' => $this->user->id,
        'menu_id' => $request->params['menuId'],
        'product_id' => $productId,
        'created_at' => new \dateTime,
        'updated_at' => new \dateTime,
      ];
    }

    MenuProduct::insert($dataInsert);

    return response()->json([
      'all' => $request->all(),
      'menuId' => $request->params['menuId'],
      'dataInsert' => $dataInsert
    ]);
  }

  public function update(Request $request)
  {
    try {
      $params = $request->get('params');

      $updateConditions = [
        'user_id' => $this->user->id,
        'id' => $params['id'],
      ];

      $data = [
        'name' => $params['name'],
        'description' => $params['description'],
      ];

      Menu::where($updateConditions)->update($data);

      return response()->json([
        'success' => true
      ]);
    } catch (\Exception $e) {
      return $this->responseError($e->getMessage(), 400);
    }
  }
}
