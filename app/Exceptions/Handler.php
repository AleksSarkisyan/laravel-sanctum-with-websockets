<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;
use Illuminate\Database\QueryException;

class Handler extends ExceptionHandler
{
  /**
   * A list of the exception types that are not reported.
   *
   * @var string[]
   */
  protected $dontReport = [
    //
  ];

  /**
   * A list of the inputs that are never flashed for validation exceptions.
   *
   * @var string[]
   */
  protected $dontFlash = [
    'current_password',
    'password',
    'password_confirmation',
  ];

  /**
   * Register the exception handling callbacks for the application.
   *
   * @return void
   */
  public function register()
  {

    if (!config('app.debug')) {
      $this->renderable(function (QueryException $e) {
        return response()->json([
          'error' => 'DB failure.',
          'code' => 500
        ], 500);
      });

      $this->renderable(function (Exception $e) {
        return response()->json([
          'error' => 'Something went wrong.',
          'code' => 500
        ], 500);
      });
    }


    $this->reportable(function (Throwable $e) {
      //
    });
  }
}
