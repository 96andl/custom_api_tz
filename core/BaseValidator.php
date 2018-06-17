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

    public function alpha($inputs, $inputName)
    {
        if (!ctype_alpha($inputs[$inputName])) {
            $this->errors[] = "$inputName must be alphabetic";
        }
    }


    public function alpha_num($inputs, $inputName)
    {
        if (!ctype_alnum($inputs[$inputName])) {
            $this->errors[] = "$inputName must be alpha-numeric";
        }
    }

    public function number($inputs, $inputName)
    {
        if (!ctype_digit($inputs[$inputName])) {
            $this->errors[] = "$inputName must be number";
        }
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