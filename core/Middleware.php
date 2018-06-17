<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/17/18
 * Time: 6:14 PM
 */

namespace Core;


class Middleware
{
    public function auth()
    {
        redirect('/login');
    }
}