<?php

if (! function_exists('siteUrl')) {
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

if (! function_exists('assetsUrl')) {
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

if (! function_exists('randomElement')) {
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

if (! function_exists('view')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string $path
     * @param  array  $data  Accessible variables in view
     * @return void
     */
    function view(string $path, array $data = []): void
    {
        extract($data);
        $path = str_replace('.', '/', $path);
        // $fileName = __DIR__ . "/views/{$path}.php";

        // if (! file_exists($fileName) ) {
        //     throw new \App\Exceptions\FileNotFoundException(
        //         "Failed to open stream, No such file or directory for view [$path]"
        //     );
        // }

        include BASE_PATH . "/views/{$path}.php";
        die();
    }
}

if (! function_exists('dd')) {
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


if (! function_exists('strContains')) {
    /**
     * Check substring for string existance.
     *
     * @param string $str
     * @param string $needle
     * @param integer $case_sensitive
     * @return boolean
     */
    function strContains(string $str, string $needle, $case_sensitive = 0): bool
    {
        ($case_sensitive)
            ? $pos = strpos($str, $needle)
            : $pos = stripos($str, $needle);

        return ($pos !== false) ? true : false;
    }
}

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}
