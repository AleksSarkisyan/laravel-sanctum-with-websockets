<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface CartServiceContract
{
  public function get();
  public function add(Request $request);
}
