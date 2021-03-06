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
use Core\Storage;
use Core\Validator;

class ProductsController
{
    public function index()
    {
        header('Content-Type: application/json');
        $products = file_get_contents('../stubs/products.json');
        echo $products;
    }


    public function store()
    {
        $request = new Request();

        $inputs = $request->inputs();

        Validator::validate($inputs, [
            'category' => 'required',
            'brand_name' => 'required',
            'product_name' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|number',
        ]);


        if (!is_null($request->file('image')))
            $file_path = Storage::store('/images', $request->file('image'));

        $data = $request->inputs();

        $data['image'] = isset($file_path) ? $file_path : null;

        if (Products::save($data)) {
            return redirect('/');
        }

        Response::send([], null, 500);
    }

    public function show()
    {

    }

    public function update()
    {
        $request = new Request();

        $inputs = $request->inputs();


        Validator::validate($inputs, [
            'product_id' => 'required',
            'category' => 'required',
            'brand_name' => 'required',
            'product_name' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|number',
        ]);

        if (!is_null($request->file('image')))
            $file_path = Storage::store('/images', $request->file('image'));

        $data = $request->inputs();

        $data['image'] = isset($file_path) ? $file_path : null;

        if ($product = Products::update($inputs['product_id'], $data)) {
            Response::send($product, null, 201);
        }

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