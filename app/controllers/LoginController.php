<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/17/18
 * Time: 6:46 PM
 */

namespace App\controllers;


use App\Models\Users;
use Core\Auth;
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
        $user = Users::findByEmail($request->input('email'));
        if (password_verify($request->input('password'), $user['password'])) {
            Auth::login($user);
        }

    }

    public function logout()
    {
        Auth::logout();
    }
}