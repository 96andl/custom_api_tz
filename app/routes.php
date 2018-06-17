<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/14/18
 * Time: 12:27 PM
 */

$router->get('', '\\App\\controllers\\IndexController@home')->middleware('auth');
$router->get('resource', '\\App\\controllers\\ResourceController@index');
$router->delete('resource', '\\App\\controllers\\ResourceController@destroy');
$router->post('resource', '\\App\\controllers\\ResourceController@store');
$router->put('resource', '\\App\\controllers\\ResourceController@update');