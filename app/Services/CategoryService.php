<?php

namespace App\Services;

use App\Contracts\CategoryServiceContract;
use App\Events\OrderConfirmed;
use App\Events\OrderCreated;
use App\Events\TestPrivate;
use App\Events\TestPrivateRestaurant;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Category;
use App\Models\RestaurantUser;
use Illuminate\Support\Facades\DB;

class CategoryService implements CategoryServiceContract
{
  use ResponseTrait;

  public $user = null;

  public function __construct()
  {
    $this->user = Auth::guard('restaurant')->user();
  }

  public function getAll()
  {
    return response()->json([
      Category::orderBy('created_at', 'desc')->get()
    ]);
  }

  public function create(Request $request)
  {
    $data = $request->all();

    /** create slug */
    $result = Category::create($data);

    return response()->json([
      $result
    ]);
  }
}
