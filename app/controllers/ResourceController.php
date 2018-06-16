<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/16/18
 * Time: 12:45 PM
 */

namespace App\controllers;


use Core\Request;

class ResourceController
{
    public function index()
    {
        header('Content-Type: application/json');
        $resources = file_get_contents('../stubs/resources.json');
        echo $resources;
    }


    public function store()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {
        $request = Request::make();

        if($request->hasInput('id'))
        {
            $resources = file_get_contents('../stubs/resources.json');
            dd($resources);
        }
        echo "HELLO MEN";
    }


}