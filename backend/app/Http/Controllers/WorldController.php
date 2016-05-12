<?php

namespace App\Http\Controllers;

use App\World;

class WorldController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
    }
    
    public function index()
    {
      $world = new World;
      // $users = $userM->where('d', '1')->get()->toJson();
      return response()->json(['name' => 'Abigail', 'state' => 'CA']);
    }

}
