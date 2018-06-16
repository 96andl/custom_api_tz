<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/16/18
 * Time: 12:45 PM
 */

namespace App\controllers;


use App\Models\Products;
use Core\Request;
use Core\Response;

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
        $request = new Request();
        if (Products::save($request->inputs())) {
            return redirect('/');
        }

        Response::send([], null, 500);
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {
        $request = new Request();

        if ($request->hasInput('id')) {
            $product_id = $request->input('id');
            if (Products::delete($product_id)) {
                Response::send([], null, 200);
            }
            Response::send(['message' => 'Id not found'], null, 404);
        }

        Response::send(['message' => 'product id is not provided'], null, 500);

    }


}