<?php

namespace App\Utilities;

class Url
{
    public static function current(): string
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public static function currentRoute(): string
    {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }

    /**
     * Parse current URL and return its components
     * 
     * component: retrieve just a specific URL component as a string
     * 
     * like: PHP_URL_SCHEME, PHP_URL_HOST, PHP_URL_PORT, PHP_URL_USER,
     *       PHP_URL_PASS, PHP_URL_PATH, PHP_URL_QUERY or PHP_URL_FRAGMENT
     * 
     * @param string $components
     * @return void
     */
    public static function segments(string $component = null)
    {
        if ( !isset($component) )
            return parse_url(self::current());

        return parse_url(self::current(), $component);
    }

    /**
     * Retrieve current URL Query Parameters
     *
     * @return void
     */
    public static function queryParameters()
    {
        return self::segments(PHP_URL_QUERY);
    }
}