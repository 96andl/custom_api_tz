<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/16/18
 * Time: 6:12 PM
 */

namespace Core;


class Session
{
    public static function flash($name = '', $message = '')
    {
        if (!empty($name)) {
            $_SESSION[$name] = $message;
            return;
        }

        throw new \Exception("Session parameter key can't be empty");
    }

    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        if (!empty($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return null;
    }

    public static function getFlash($name)
    {
        if (!empty($_SESSION[$name])) {
            $data = $_SESSION[$name];
            unset($_SESSION[$name]);
            return $data;
        }

        return null;
    }

    public static function delete($name)
    {
        if (isset($_SESSION[$name]))
            unset($_SESSION[$name]);
    }
}