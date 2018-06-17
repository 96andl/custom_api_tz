<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/14/18
 * Time: 12:27 PM
 */

$controllersPath = '\\App\\controllers\\';

$router->get('', "{$controllersPath}IndexController@home")->middleware('auth');
$router->get('resource', "{$controllersPath}ResourceController@index");
$router->delete('resource', "{$controllersPath}ResourceController@destroy");
$router->post('resource', "{$controllersPath}ResourceController@store");
$router->put('resource', "{$controllersPath}ResourceController@update");
$router->get('login', "{$controllersPath}LoginController@index");
$router->post('login', "{$controllersPath}LoginController@login");