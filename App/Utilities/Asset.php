<?php

namespace App\Utilities;

class Asset
{
    public static function get(string $route): string
    {
        return $_ENV['BASE_URL'] . 'assets/' . $route;
    }

    public static function __callStatic(string $route, array $args): string
    {
        return $_ENV['BASE_URL'] . "assets/$route/";
    }
}