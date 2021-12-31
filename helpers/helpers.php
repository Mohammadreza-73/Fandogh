<?php

if (! function_exists('siteUrl') )
{
    /**
     * Generate Custom URL
     *
     * @param  string $route
     * @return string
     */
    function siteUrl(string $route): string
    {
        return $_ENV['BASE_URL'] . $route;
    }
}

if (! function_exists('assetsUrl') )
{
    /**
     * Retrieve asset URL
     *
     * @param  string $route
     * @return string
     */
    function assetsUrl(string $route): string
    {
        return siteUrl('/assets' . $route);
    }
}

if (! function_exists('randomElement') )
{
    /**
     * Retrieve random index of array
     *
     * @param  array $array
     * @return string
     */
    function randomElement(array $array): string
    {
        shuffle($array);
        return array_pop($array);
    }
}

if (! function_exists('view') )
{
    /**
     * Get the evaluated view contents for the given view.
     * 
     * @param  string $path
     * @param  array  $data  Accessible variables in view
     * @return void
     */
    function view(string $path, array $data = []): void
    {
        if (! file_exists($path) )
            throw new \App\Exceptions\FileNotFoundException(
                "Failed to open stream, No such file or directory for view [$path]"
            );

        extract($data);
        $path = str_replace('.', '/', $path);
        include BASE_PATH . "/views/{$path}.php";
        die();
    }
}

if (! function_exists('dd') )
{
    /**
     * Die and Dump
     *
     * @param  mixed $value
     * @return void
     */
    function dd($value)
    {
        var_dump($value);
        die();
    }
}
