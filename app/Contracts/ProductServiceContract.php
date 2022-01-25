<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ProductServiceContract
{
  public function get(Request $request);
  public function getAllById(Request $request);
  public function create(Request $request);
  public function update(Request $request);
}
