<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\TestFacade;

class TestController extends Controller
{

  public function test()
  {
    $number = TestFacade::add(-250);
    var_dump($number);
    die($number);
  }
}
