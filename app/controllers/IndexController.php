<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/14/18
 * Time: 11:20 PM
 */

namespace App\Controllers;

class IndexController
{
    public function home()
    {
        return view('home');
    }
}