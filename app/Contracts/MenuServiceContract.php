<?php

namespace App\Contracts;

use App\Requests\CreateMenuRequest;
use Illuminate\Http\Request;

interface MenuServiceContract
{
  public function create(CreateMenuRequest $request);
  public function getAllById(Request $request);
  public function get(Request $request);
  public function save(Request $request);
}
