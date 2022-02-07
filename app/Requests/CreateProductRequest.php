<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use App\Traits\HelperTrait;

class CreateProductRequest extends FormRequest
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
      'name' => 'required|string',
      'description' => 'required|string',
      'category' => 'required|array',
      'price' => 'required|int',
      'promoPrice' => 'required|int',
      'weight' => 'required|string',
      'isActive' => 'required|boolean'
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
      'name.required' => $this->setRequiredErrorMessage('name'),
      'description.required'  => $this->setRequiredErrorMessage('description')
    ];
  }
}
