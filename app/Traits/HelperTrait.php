<?php

namespace App\Traits;

trait HelperTrait
{
  public function setRequiredErrorMessage(string $field): string
  {
    if (!$field) {
      return 'This field is required';
    }

    return 'The ' . $field . ' is required';
  }
}
