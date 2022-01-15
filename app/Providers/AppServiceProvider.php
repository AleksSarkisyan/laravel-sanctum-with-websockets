<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Services\RestaurantUserService;
use App\Contracts\RestaurantUserServiceContract;
use App\Contracts\UserServiceContract;
use App\Services\MenuService;
use App\Contracts\MenuServiceContract;
use App\Services\OrderService;
use App\Contracts\OrderServiceContract;
use App\Services\CartService;
use App\Contracts\CartServiceContract;
use App\Services\RestaurantService;
use App\Contracts\RestaurantServiceContract;

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

    $this->app->singleton(
      OrderServiceContract::class,
      OrderService::class
    );

    $this->app->singleton(
      CartServiceContract::class,
      CartService::class
    );

    $this->app->singleton(
      RestaurantServiceContract::class,
      RestaurantService::class
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
