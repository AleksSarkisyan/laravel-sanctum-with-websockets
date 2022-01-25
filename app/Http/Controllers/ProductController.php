<?php

namespace App\Http\Controllers;

use App\Contracts\ProductServiceContract;
use Illuminate\Http\Request;


class ProductController extends Controller
{

  public function create(Request $request, ProductServiceContract $productService)
  {
    return $productService->create($request);
  }

  public function getAllById(Request $request, ProductServiceContract $productService)
  {
    return $productService->getAllById($request);
  }

  public function get(Request $request, ProductServiceContract $productService)
  {
    return $productService->get($request);
  }

  public function update(Request $request, ProductServiceContract $productService)
  {
    return $productService->update($request);
  }
}
