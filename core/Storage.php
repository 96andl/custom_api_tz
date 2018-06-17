<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/17/18
 * Time: 11:13 PM
 */

namespace Core;


class Storage
{
    public static function store($uploadDir, $file)
    {
        self::checkDirExist(self::storagePath() . '/' . $uploadDir);

        $extention = end(explode(".", $name = $file['name']));
        $file_path = $uploadDir . '/' . md5_file($file['tmp_name']) . '.' . $extention;

        if (move_uploaded_file($file['tmp_name'], self::storagePath() . $file_path)) {
            return $file_path;
        }
        return false;
    }

    public static function appPath()
    {
        return strstr(getcwd(), '/public', true);
    }

    public static function storagePath()
    {
        return strstr(getcwd(), '/public', true) . '/storage';
    }

    private static function checkDirExist($uploadDir)
    {
        if (!file_exists($uploadDir) && !is_dir($uploadDir)) {
            mkdir($uploadDir);
        }
    }
}