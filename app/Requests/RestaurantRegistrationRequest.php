<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use App\Traits\HelperTrait;

class RestaurantRegistrationRequest extends FormRequest
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
      'email' => 'required|string|email',
      'password' => 'required|string',
      'name' => 'required|string',
      'restaurantName' => 'required|string',
      'city' => 'required|string'
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
      'email.required' => $this->setRequiredErrorMessage('email'),
      'password.required' => $this->setRequiredErrorMessage('password'),
      'userName.required' => $this->setRequiredErrorMessage('userName'),
      'restaurantName.required' => $this->setRequiredErrorMessage('restaurantName'),
      'city.required' => $this->setRequiredErrorMessage('city'),
    ];
  }
}
