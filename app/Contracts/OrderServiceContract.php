<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface OrderServiceContract
{
  public function get();
  public function add(Request $request);
}
