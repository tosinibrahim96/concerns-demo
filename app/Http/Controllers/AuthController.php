<?php

namespace App\Http\Controllers;

use App\Http\Validators\AuthValidator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

  protected $authValidator;
  
  /**
   * __construct
   * 
   * @param \App\Http\Validators\AuthValidator $authValidator
   * @return void
   */
  public function __construct(AuthValidator $authValidator)
  {
    $this->authValidator = $authValidator;
    
  }


  /**
   * create a new account
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    $errors = $this->authValidator
      ->validate($request->all())
      ->getErrors();
    
    if (count($errors)) {
      return response()->json(["status" => false,"message" => $errors],
        400
      );
    }

    /*--------Concern 2------------------*/
    $password = Hash::make($request->password);
    $user = User::create([
      'name' => $request->name,
      'password' => $password,
      'email' => $request->email
    ]);

    /*--------Concern 3------------------*/
    return response()->json(
      [
        "status" => true,
        "message" => 'User account created',
        "data" => $user
      ],
      201
    );
  }
}
