<?php

namespace App\Http\Middleware;

use Closure;
use Validator;

class ValidationMiddleware
{
    private $_validationRules = [
      "user_signup" => [
        [
          "field_name" => "name",
          "field_rules" => "required"
        ],
        [
          "field_name" => "email",
          "field_rules" => "required|email"
        ]
      ],
    ];
  
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tt = "")
    {
      if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $params = $request->json();
        if (in_array($tt, array_keys($this->_validationRules))) {
          
          $validationParams = array();
          $validationRules = array();
          
          foreach ($this->_validationRules[$tt] as $validationObj) {
            $validationParams[$validationObj["field_name"]] = $params->get($validationObj["field_name"]);
            $validationRules[$validationObj["field_name"]] = $validationObj["field_rules"];
          }
          // validate array
          $validator = Validator::make(
            $validationParams,
            $validationRules
          );
          
          if ($validator->fails()) {
            return array("status" => "error", "message" => "You sent wrong params.");
          }
        }
        return $next($request);
      } else {
        return array("status" => "error", "message" => "Wrong type data of request.");
      }
    }
    
    
}
