<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use App\Traits\HelperTrait;

class CreateOrderRequest extends FormRequest
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
      'restautant' => 'required|array',
      'products' => 'required|array',
      'totalCartQuantity' => 'required|int',
      'totalCartPrice' => 'required|int'
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
      'restautant.required' => $this->setRequiredErrorMessage('restautant'),
      'products.required'  => $this->setRequiredErrorMessage('products'),
      'totalCartQuantity.required'  => $this->setRequiredErrorMessage('totalCartQuantity'),
      'totalCartPrice.required'  => $this->setRequiredErrorMessage('totalCartPrice')
    ];
  }
}
