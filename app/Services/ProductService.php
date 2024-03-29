<?php

namespace App\Services;

use App\Contracts\ProductServiceContract;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Requests\CreateProductRequest;

class ProductService implements ProductServiceContract
{
  use ResponseTrait;

  public $user = null;

  public function __construct()
  {
    $this->user = Auth::guard('restaurant')->user();
  }

  public function create(CreateProductRequest $request)
  {
    $params = $request->all();
    $params['category_id'] = $params['category']['value'];
    $params['promo_price'] = $params['promoPrice'];
    $params['is_active'] = $params['isActive'];
    $params['user_id'] = $this->user->id;

    unset($params['category']);
    unset($params['promoPrice']);
    unset($params['isActive']);

    $result = Product::create($params);

    return response()->json([
      'data' => $request->all(),
      'result' => $result
    ]);
  }

  public function getAllById(Request $request)
  {
    $products = Product::with(['category' => function ($query) {
      $query->select('id', 'name');
    }])
      ->where('user_id', $this->user->id)
      ->orderBy('created_at', 'desc')
      ->get();

    return response()->json([
      'products' => $products
    ]);
  }

  public function get(Request $request)
  {
    $productName = $request['productName'];
    $productId = $request['productId'];

    $conditions = [
      'user_id' => $this->user->id,
      'id' => $productId,
      'name' => $productName
    ];

    $product = Product::with(['category' => function ($query) {
      $query->select('id', 'name');
    }])->where($conditions)->first();

    return response()->json([
      'product' => $product
    ]);
  }

  public function update(CreateProductRequest $request)
  {
    $params = $request->all();

    $updateConditions = [
      'user_id' => $this->user->id,
      'id' => $params['id'],
    ];

    $params['category_id'] = $params['category']['id'];
    $params['promo_price'] = $params['promoPrice'];
    $params['is_active'] = $params['isActive'];

    unset($params['id']);
    unset($params['category']);
    unset($params['promoPrice']);
    unset($params['isActive']);

    Product::where($updateConditions)->update($params);

    return response()->json([
      'success' => true
    ]);
  }
}
