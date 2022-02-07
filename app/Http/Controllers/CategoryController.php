<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\CategoryServiceContract;
use App\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
  public function getAll(Request $request, CategoryServiceContract $categoryService)
  {
    return $categoryService->getAll($request);
  }

  public function create(CreateCategoryRequest $request, CategoryServiceContract $categoryService)
  {
    return $categoryService->create($request);
  }
}
