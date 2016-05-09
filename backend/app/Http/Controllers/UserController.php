<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
    }
    
    public function signup(Request $request)
    {
      $params = $request->only('name', 'email', 'password');
      
      // TODO: create user
      // TODO: form data that we need in JWT
      $params['sub'] = 1; // user id
      unset($params["email"]);
      unset($params["password"]);
      try {
        $payload = JWTFactory::make($params);
        $token = JWTAuth::encode($payload)->get();
      } catch (JWTException $e) {
        return response()->json(['error' => 'could_not_create_token'], 500);
      }
      
      return response()->json(compact('token'));
    }
    
    public function refresh_token(Request $request)
    {
      if (!$token = JWTAuth::getToken()) {
        return response()->json(["status" => "error", "message" => "Token not provided"], 400);
      }
      
      try {
        $token = JWTAuth::parseToken()->refresh();
      } catch (TokenBlacklistedException $e) {
        return response()->json(['error' => 'Token was blacklisted'], 403);
      } catch (JWTException $e) {
        return response()->json(['error' => 'Could not create token'], 500);
      }
      
      return response()->json(compact('token'));
    }

}
