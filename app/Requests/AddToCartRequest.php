<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use App\Traits\HelperTrait;

class AddToCartRequest extends FormRequest
{
  use ResponseTrait;
  use HelperTrait;

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'product_id' => 'required|int',
      'restaurant_id' => 'required|int'
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'product_id.required' => $this->setRequiredErrorMessage('product_id'),
      'restaurant_id.required'  => $this->setRequiredErrorMessage('restaurant_id')
    ];
  }
}
