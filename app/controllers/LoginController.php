<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/17/18
 * Time: 6:46 PM
 */

namespace App\controllers;


use App\Models\Users;
use Core\Request;
use Core\Session;

class LoginController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $request = new Request();
        $user = Users::findByEmail('elody.metz@bogan.com');
        if (password_verify($request->input('password'), $user['password'])) {
            Session::set($user['password'], $user['id']);
            setcookie('auth', $user['password'], time() + 60 * 60 * 24 * 30);
            redirect('/');
        }

    }
}