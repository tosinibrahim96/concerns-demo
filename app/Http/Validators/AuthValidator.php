<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;


class AuthValidator
{
  protected $errors = [];

  /**
   * validate user registeration data
   *
   * @param  array $requestData
   * @return \App\Http\Validators\AuthValidator
   */
  public function validate(array $requestData)
  {
    $validator = Validator::make($requestData, [
      'email' => 'required|email|unique:users',
      'name' => 'required|string',
      'password' => 'required|min:6'
    ]);

    $this->errors = $validator->errors();

    return $this;
  }


  /**
   * get the errors that occured during 
   * validation
   *
   * @return array
   */
  public function getErrors()
  {
    return $this->errors;
  }
}
