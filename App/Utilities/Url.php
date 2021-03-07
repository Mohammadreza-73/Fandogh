<?php

namespace App\Utilities;

class Url
{
    public static function current()
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public static function currentRoute()
    {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }

    public static function queryParameters(string $url)
    {
        // TODO: Impelement
    }

    public static function segments(string $url)
    {
        // TODO: Impelement
    }
}