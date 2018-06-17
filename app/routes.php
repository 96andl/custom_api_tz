<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/14/18
 * Time: 12:27 PM
 */

$controllersPath = '\\App\\controllers\\';

$router->get('', "{$controllersPath}IndexController@home")->middleware('auth');
$router->get('product', "{$controllersPath}ProductsController@index");
$router->delete('product', "{$controllersPath}ProductsController@destroy");
$router->post('product', "{$controllersPath}ProductsController@store");
$router->put('product', "{$controllersPath}ProductsController@update");

$router->get('login', "{$controllersPath}LoginController@index");
$router->post('login', "{$controllersPath}LoginController@login");
$router->get('logout', "{$controllersPath}LoginController@logout");
$router->get('register', "{$controllersPath}RegisterController@index");
$router->post('register', "{$controllersPath}RegisterController@register");