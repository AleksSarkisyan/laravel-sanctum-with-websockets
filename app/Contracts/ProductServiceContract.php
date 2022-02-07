<?php

namespace App\Contracts;

use App\Requests\CreateProductRequest;
use Illuminate\Http\Request;

interface ProductServiceContract
{
  public function get(Request $request);
  public function getAllById(Request $request);
  public function create(CreateProductRequest $request);
  public function update(CreateProductRequest $request);
}
