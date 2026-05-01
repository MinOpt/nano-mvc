<?php
global $router;

$router->get('/', 'HomeController@index');
$router->get('/about', 'AboutController@index');
$router->post('/submit', 'FormController@store');
$router->get('/user/{id}', 'UserController@show');