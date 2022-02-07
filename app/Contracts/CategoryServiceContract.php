<?php

namespace App\Contracts;

use App\Requests\CreateCategoryRequest;

interface CategoryServiceContract
{
  public function getAll();
  public function create(CreateCategoryRequest $request);
}
