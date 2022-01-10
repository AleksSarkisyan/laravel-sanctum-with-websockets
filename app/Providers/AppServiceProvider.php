<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Services\RestaurantUserService;
use App\Contracts\RestaurantUserServiceContract;
use App\Contracts\UserServiceContract;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton(
      UserServiceContract::class,
      UserService::class
    );

    $this->app->singleton(
      RestaurantUserServiceContract::class,
      RestaurantUserService::class
    );
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
