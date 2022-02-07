<?php

namespace App\Contracts;

use App\Requests\CreateMenuRequest;
use App\Requests\UpdateMenuProductsRequest;
use App\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;

interface MenuServiceContract
{
  public function create(CreateMenuRequest $request);
  public function getAllById(Request $request);
  public function get(Request $request);
  public function save(UpdateMenuProductsRequest $request);
  public function update(UpdateMenuRequest $request);
}
