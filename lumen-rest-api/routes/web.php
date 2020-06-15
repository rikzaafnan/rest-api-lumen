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

$router->get('/', function () use ($router) {
    return "run sukses";
    // return $router->app->version();
});

$router->post('/products', 'ProductController@store' );
$router->get('/products', 'ProductController@index' );
$router->get('/products/{productId}', 'ProductController@show' );
$router->put('/products/{productId}', 'ProductController@update' );
$router->delete('/products/{productId}', 'ProductController@destroy' );

// register user
$router->post('api/v1/registers','UserController@register');

// login user
$router->post('api/v1/login', 'UserController@login');
