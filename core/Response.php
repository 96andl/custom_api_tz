<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/16/18
 * Time: 3:23 PM
 */

namespace Core;


class Response
{
    public static function send($data, $headers, $code = 200)
    {
        foreach ($headers as $header) {
            header($header);
        }

        http_response_code($code);

        echo $data;
    }
}