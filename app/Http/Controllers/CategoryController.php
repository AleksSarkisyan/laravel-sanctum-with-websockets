<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\CategoryServiceContract;

class CategoryController extends Controller
{
  public function getAll(Request $request, CategoryServiceContract $categoryService)
  {
    return $categoryService->getAll($request);
  }

  public function create(Request $request, CategoryServiceContract $categoryService)
  {
    return $categoryService->create($request);
  }
}
