<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/17/18
 * Time: 6:46 PM
 */

namespace Core;


use App\Models\Users;

class Auth
{
    public static function check()
    {
        if (!isset($_COOKIE['auth'])) {
            return false;
        }

        $auth_hash = $_COOKIE['auth'];

        if (Users::findByHash($auth_hash) === false) {
            return false;
        }
        return true;
    }

    public static function login($user, $redirect_uri = '/')
    {
        Session::set($user['password'], $user['id']);
        setcookie('auth', $user['password'], time() + 60 * 60 * 24 * 30);
        redirect($redirect_uri);
    }

    public static function logout($redirect_uri = '/')
    {
        Session::delete(Auth::user()['password']);
        if (isset($_COOKIE['auth'])) {
            setcookie("auth", "", time() - 3600);
        }

        redirect($redirect_uri);
    }

    public static function user()
    {
        $auth_hash = $_COOKIE['auth'];

        return $user = Users::findByHash($auth_hash);
    }
}