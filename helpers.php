<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/14/18
 * Time: 11:11 PM
 */


function view($name, $data = [])
{
    extract($data);
    require "app/views/$name.view.php";
}

function redirect($path) {
    header("Location: $path");
    exit();
}