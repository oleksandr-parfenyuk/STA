<?php

namespace App\Http\Middleware;

use Closure;
use Validator;

class ValidationMiddleware
{
    private $_validationRules = [];
  
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tt)
    {
        if (in_array($tt, $this->_validationRules)) {
          // validate array
          $validator = Validator::make(
            array(
              $this->_validationRules[$tt]["field_name"] => $request->input($this->_validationRules[$tt]["field_name"])
            ),
            array(
              $this->_validationRules[$tt]["field_name"] => $this->_validationRules[$tt]["field_rules"]
            )
          );
          
          if ($validator->fails()) {
            return array("status" => "error", "message" => "You sent wrong params.");
          }
        }
        return $next($request);
    }
    
    
}
