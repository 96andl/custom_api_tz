<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/14/18
 * Time: 11:09 PM
 */

use Core\Request;
use Core\Router;

require '../vendor/autoload.php';

if( !session_id() )
{
    session_start();
}

Router::load('../app/routes.php')->direct(Request::uri(), Request::method());
