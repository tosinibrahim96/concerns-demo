<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  /**
   * create a new account
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    /*--------Concern 1(Request validation)------------------*/
    $validator = Validator::make($request->all(), [
      'email' => 'required|email|unique:users',
      'name' => 'required|string',
      'password' => 'required|min:6'
    ]);

    if ($validator->fails()) {
      /*--------Concern 3(Response formatting and return)-----------------*/
      return response()->json(
        [
          "status" => false,
          "message" => $validator->errors()
        ],
        400
      );
    }

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
