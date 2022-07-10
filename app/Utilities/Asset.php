<?php

namespace App\Utilities;

class Asset
{
    public static function get(string $route): string
    {
        return $_ENV['BASE_URL'] . 'assets/' . $route;
    }

    public static function __callStatic(string $file_name, array $route): string
    {
        return $_ENV['BASE_URL'] . "assets/$file_name/" . implode('', $route);
    }
}
