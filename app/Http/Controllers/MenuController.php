<?php

namespace App\Http\Controllers;

use App\Contracts\MenuServiceContract;
use Illuminate\Http\Request;
use App\Requests\CreateMenuRequest;


class MenuController extends Controller
{

  public function create(CreateMenuRequest $request, MenuServiceContract $menuService)
  {
    return $menuService->create($request);
  }

  public function getAllById(Request $request, MenuServiceContract $menuService)
  {
    return $menuService->getAllById($request);
  }

  public function get(Request $request, MenuServiceContract $menuService)
  {
    return $menuService->get($request);
  }

  public function save(Request $request, MenuServiceContract $menuService)
  {
    return $menuService->save($request);
  }
}
