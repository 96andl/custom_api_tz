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
        return $this->params()[$parameter];
    }

    public function hasInput($parameter)
    {
        return isset($this->params()[$parameter]);
    }

    public function inputs()
    {
        return $this->params();
    }

    private function params()
    {
        if (isset($_SERVER['CONTENT_TYPE']) and strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {

            if (in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST'])) {
                return $_REQUEST;
            } else if (in_array($_SERVER['REQUEST_METHOD'], ['PUT', 'PATCH', 'DELETE'])) {
                return json_decode(file_get_contents("php://input"), true);
            }
        }

        if (in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST'])) {
            return $_REQUEST;
        } else if (in_array($_SERVER['REQUEST_METHOD'], ['PUT', 'PATCH', 'DELETE'])) {
            parse_str(file_get_contents("php://input"), $params);
            return $params;
        }
        throw new \Exception("Unknown http METHOD");
    }
}