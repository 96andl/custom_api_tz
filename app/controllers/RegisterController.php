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
use Core\Validator;

class RegisterController
{
    public function index()
    {
        return view('register');
    }

    public function register()
    {
        $inputs = (new Request())->inputs();

//        Validator::validate($inputs, [
//            ''
//        ]);


        $user = Users::save($inputs);

        Auth::login($user);
    }
}