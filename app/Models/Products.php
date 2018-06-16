<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/14/18
 * Time: 11:57 PM
 */

namespace App\Models;


class Products
{
    const RESOURCE_STUB_PATH = '../stubs/resources.json';

    public static function save($data)
    {
        $existedProducts = json_decode(file_get_contents(Products::RESOURCE_STUB_PATH), true);
        $product = [
            "id" => $existedProducts[count($existedProducts) - 1]['id'] + 1,
            "product_id" => 3,
            'category' => $data['category'],
            'brand_name' => $data['brand_name'],
            'product_name' => $data['product_name'],
            "name" => $data['name'],
            "description" => $data['description'],
            'price' => $data['price'],
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Lionel_Messi_2017.jpg/250px-Lionel_Messi_2017.jpg'
        ];
        array_push($existedProducts, $product);
        file_put_contents(Products::RESOURCE_STUB_PATH, json_encode($existedProducts));
        return true;
    }

    public static function delete($product_id)
    {
        $products = json_decode(file_get_contents(Products::RESOURCE_STUB_PATH), true);
        foreach ($products as $key => $product) {
            if ($product['id'] == $product_id) {
                unset($products[$key]);
                file_put_contents(Products::RESOURCE_STUB_PATH, json_encode($products));
                return true;
            }
        }
    }
}