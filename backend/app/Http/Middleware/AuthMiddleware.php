<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use JWTAuth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (!$token = JWTAuth::getToken()) {
        return response()->json(["status" => "error", "message" => "Token not provided"], 400);
      }

      try {
        $auth_token = JWTAuth::getPayload();
        $user_id = JWTAuth::setIdentifier($auth_token->get('sub'));
      } catch (TokenExpiredException $e) {
        return response()->json(["status" => "error", "message" => "Token expired"], 401);
      } catch (JWTException $e) {
        return response()->json(["status" => "error", "message" => "Token invalid"], 401);
      }

      return $next($request);
    }
}
