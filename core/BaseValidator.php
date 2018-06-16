<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/16/18
 * Time: 5:55 PM
 */

namespace Core;


class BaseValidator
{
    protected $message = 'Validation error';
    protected $errors = [];

    public function required($inputs, $inputName)
    {
        if (trim($inputs[$inputName]) === '') {
            $this->errors[] = "$inputName is required";
        }
        return true;
    }

    public function returnErrors()
    {
        $data = [
            'message' => $this->message,
            'errors' => $this->errors
        ];

        if (isset($_SERVER['CONTENT_TYPE']) and strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
            Response::send($data, null, 422);
        }

        Session::flash('errors', $data, 'success');

        redirect('/');

    }
}