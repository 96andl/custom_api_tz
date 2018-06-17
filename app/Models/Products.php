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
    const RESOURCE_STUB_PATH = '../stubs/products.json';

    public static function save($data)
    {
        $existedProducts = (array)json_decode(file_get_contents(Products::RESOURCE_STUB_PATH), true);
        $product = self::changeProduct($existedProducts, $data);
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

    public static function update($product_id, $data)
    {
        $products = json_decode(file_get_contents(Products::RESOURCE_STUB_PATH), true);
        foreach ($products as $key => $product) {
            if ($product['id'] == $product_id) {
                $products[$key] = self::changeProduct($products, $data, $product_id);
                file_put_contents(Products::RESOURCE_STUB_PATH, json_encode($products));
                return $products[$key];
            }
        }
    }

    private static function changeProduct($existedProducts, $data, $product_id = null)
    {
        return
            [
                "id" => is_null($product_id) ? $existedProducts[count($existedProducts) - 1]['id'] + 1 : $product_id,
                "product_id" => isset($data['product_id']) ? $data['product_id'] : '',
                'category' => isset($data['category']) ? $data['category'] : '',
                'brand_name' => isset($data['brand_name']) ? $data['brand_name'] : '',
                'product_name' => isset($data['product_name']) ? $data['product_name'] : '',
                "name" => isset($data['name']) ? $data['name'] : '',
                "description" => isset($data['description']) ? $data['description'] : '',
                'price' => isset($data['price']) ? $data['price'] : '',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Lionel_Messi_2017.jpg/250px-Lionel_Messi_2017.jpg'
            ];
    }
}