<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface CategoryServiceContract
{
  public function getAll();
  public function create(Request $request);
}
