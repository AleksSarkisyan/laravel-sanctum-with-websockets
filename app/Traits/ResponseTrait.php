<?php

namespace App\Traits;

trait ResponseTrait
{
  public function responseSuccess(array $data, int $code): object
  {
    return response()->json([
      'data' => $data,
      'code' => $code
    ], $code);
  }

  public function responseError(string $message, int $code): object
  {
    return response()->json([
      'error' => $message,
      'code' => $code
    ], $code);
  }

  public function responseGeneric(bool $success, string $message, int $code): object
  {
    return response()->json([
      'success' => $success,
      'message' => $message,
      'code' => $code
    ], $code);
  }
}
