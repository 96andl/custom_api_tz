<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/14/18
 * Time: 12:55 PM
 */

namespace Core;

class Request
{
    public static function uri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function input($parameter)
    {
        return $_REQUEST[$parameter];
    }

    public function hasInput($parameter)
    {
        return isset($_REQUEST[$parameter]);
    }

    public function inputs()
    {
        return $_REQUEST;
    }
}