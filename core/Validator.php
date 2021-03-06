<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/16/18
 * Time: 5:54 PM
 */

namespace Core;


class Validator extends BaseValidator
{
    public static function validate($inputs, $rules)
    {
        $validator = new Validator;
        foreach ($rules as $inputName => $rule) {
            $methods = explode("|", $rule);
            foreach ($methods as $method)
                $validator->$method($inputs, $inputName);
        }

        if (!empty($validator->errors))
            $validator->returnErrors();
    }
}