<?php

namespace App\Http\Controllers;

use App\Contracts\MenuServiceContract;
use Illuminate\Http\Request;
use App\Requests\CreateMenuRequest;
use App\Requests\UpdateMenuProductsRequest;
use App\Requests\UpdateMenuRequest;

class MenuController extends Controller
{

  public function create(CreateMenuRequest $request, MenuServiceContract $menuService)
  {
    return $menuService->create($request);
  }

  public function update(UpdateMenuRequest $request, MenuServiceContract $menuService)
  {
    return $menuService->update($request);
  }

  public function getAllById(Request $request, MenuServiceContract $menuService)
  {
    return $menuService->getAllById($request);
  }

  public function get(Request $request, MenuServiceContract $menuService)
  {
    return $menuService->get($request);
  }

  public function save(UpdateMenuProductsRequest $request, MenuServiceContract $menuService)
  {
    return $menuService->save($request);
  }
}
