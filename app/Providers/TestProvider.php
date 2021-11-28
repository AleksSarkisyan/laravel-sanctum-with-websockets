<?php

namespace App\Providers;

use App\Services\TestService;
use Illuminate\Support\ServiceProvider;

class TestProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->singleton('test-service', function () {
      $baseNumber = 123;

      return new TestService($baseNumber);
    });
  }
}
