<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
//use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
  public function login(Request $request)
  {

    $dataAttempt = array(
      'email'=>$request->email,
      'password'=>$request->password,
      'status' => 1
    );


    if(Auth::attempt($dataAttempt)){
      $token = "Bearer " . Auth::user()->createToken($request->email)->plainTextToken;
      return response()->json([
        "token" => $token
      ]);
    }
    return response()->json([
      "Your login, password are wrong OR status is inactive"
    ]);
  }

  public function register(Request $request)
  {

    $validator = Validator::make($request->all(), [
      "name"=>["required"],
      "email"=>["required","email", "unique:users"],
      "password"=>["required", "confirmed"]
    ]);


    if ($validator->fails()){
      return response()->json([
        'error'=>$validator->errors()
      ]);
    } else {
      User::create([
        "email"=>$request->email,
        "password"=>bcrypt($request->password),
        "name"=>$request->first_name,
        "status"=>$request->status,
      ]);

      if(Auth::attempt(['email'=>$request->email,"password"=>$request->password])){
        $token = "Bearer " . Auth::user()->createToken("Bearer")->plainTextToken;
        return response()->json([
          "token" => $token
        ]);
      }
    }

  }
}
