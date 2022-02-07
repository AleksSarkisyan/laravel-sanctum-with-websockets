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
use App\Requests\UpdateMenuProductsRequest;
use App\Requests\UpdateMenuRequest;

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
    $data = $request->all();
    $data['user_id'] = $this->user->id;
    $data['is_active'] = $data['isActive'];

    $result = Menu::create($data);

    return response()->json([
      'result' => $result
    ]);

    return $this->responseGeneric(true, 'OK', 200);
  }

  public function getAllById(Request $request)
  {

    $menus = Menu::where('user_id', $this->user->id)->orderBy('updated_at', 'desc')->get();

    return response()->json([
      'data' => $menus
    ]);
  }

  public function get(Request $request)
  {
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
  }

  public function save(UpdateMenuProductsRequest $request)
  {
    $params = $request->validated()['params'];

    $deleteConditions = [
      'user_id' => $this->user->id,
      'menu_id' => $params['menuId']
    ];

    MenuProduct::where($deleteConditions)->delete();

    $dataInsert = [];

    foreach ($params['productItems'] as $productId) {
      $dataInsert[] = [
        'user_id' => $this->user->id,
        'menu_id' => $params['menuId'],
        'product_id' => $productId,
        'created_at' => new \dateTime,
        'updated_at' => new \dateTime,
      ];
    }

    MenuProduct::insert($dataInsert);

    return response()->json([
      'menuId' => $params['menuId'],
      'dataInsert' => $dataInsert
    ]);
  }

  public function update(UpdateMenuRequest $request)
  {
    $params = $request->validated();

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
  }
}
