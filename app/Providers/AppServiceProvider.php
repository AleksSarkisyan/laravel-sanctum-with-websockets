<?php

namespace App\Providers;

use App\Contracts\MenuServiceContract;
use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Services\RestaurantUserService;
use App\Contracts\RestaurantUserServiceContract;
use App\Contracts\UserServiceContract;
use App\Services\MenuService;

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

    $this->app->singleton(
      MenuServiceContract::class,
      MenuService::class
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
