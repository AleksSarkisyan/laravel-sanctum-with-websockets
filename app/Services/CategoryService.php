<?php

namespace App\Services;

use App\Contracts\CategoryServiceContract;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

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
      'categories' => Category::orderBy('created_at', 'desc')->get()
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
