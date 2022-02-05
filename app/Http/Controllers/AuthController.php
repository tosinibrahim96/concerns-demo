<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  /**
   * create a new account
   * @param App\Http\Requests\CreateNewUserRequest $request
   * @return \Illuminate\Http\Response
   */
  public function register(CreateNewUserRequest $request)
  {
    /*--------Concern 2 (Business logic execution)------------------*/
    $password = Hash::make($request->password);
    $user = User::create([
      'name' => $request->name,
      'password' => $password,
      'email' => $request->email
    ]);

    /*--------Concern 3(Response formatting and return)------------------*/
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
