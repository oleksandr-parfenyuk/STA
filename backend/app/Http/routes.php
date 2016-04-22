<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
  return $app->version();
});

$app->group(['middleware' => 'jwt.auth', 'namespace' => 'App\Http\Controllers'], function($app) {
  $app->get('/world/lists', ['middleware' => 'validation:world_lists'], 'WorldController@index');
});
