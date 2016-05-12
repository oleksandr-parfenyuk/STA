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

$app->post('/user/signup', ['middleware' => 'validation:user_signup', 'uses' => 'UserController@signup']);
$app->get('/user/refresh_token', ['uses' => 'UserController@refresh_token']);

$app->group(['middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function($app) {
  $app->get('/world/lists', ['middleware' => 'validation:world_lists', 'uses' => 'WorldController@index']);
});
