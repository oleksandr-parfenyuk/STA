<?php

namespace App\Http\Controllers;

use App\User;

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
    
    public function signup()
    {
      //$world = new User;
      return response()->json([]);
    }

}
