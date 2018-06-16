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
    public static function send($data, $headers = null, $code = 200)
    {
        if (!is_null($headers)) {
            foreach ($headers as $header) {
                header($header);
            }
        }

        http_response_code($code);

        echo json_encode($data);
        exit();
    }
}