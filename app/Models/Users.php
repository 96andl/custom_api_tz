<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/17/18
 * Time: 7:04 PM
 */

namespace App\Models;


use Core\Response;

class Users
{
    const USERS_STUB_PATH = '../stubs/users.json';

    public function find()
    {

    }

    public static function findByEmail($email)
    {

        $users = json_decode(file_get_contents(self::USERS_STUB_PATH), true);

        foreach ($users as $key => $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }

        Response::send([
            'message' => 'User with this email not exist',
        ], null, 404);
    }

    public static function findByHash($hash)
    {

        $users = json_decode(file_get_contents(self::USERS_STUB_PATH), true);
        foreach ($users as $key => $user) {
            if ($user['password'] === $hash) {
                return $user;
            }
        }

        return false;

    }
}