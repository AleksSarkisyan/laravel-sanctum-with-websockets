<?php

namespace App\Http\Controllers;

use App\Contracts\ProductServiceContract;
use App\Requests\CreateProductRequest;
use Illuminate\Http\Request;


class ProductController extends Controller
{

  public function create(CreateProductRequest $request, ProductServiceContract $productService)
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

  public function update(CreateProductRequest $request, ProductServiceContract $productService)
  {
    return $productService->update($request);
  }
}
