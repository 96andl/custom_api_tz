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
}