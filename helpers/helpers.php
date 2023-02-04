<?php

use App\Exceptions\FileNotFoundException;

if (! function_exists('base_path')) {
    /**
     * Base path of project
     * 
     * @param  string  $path
     * @return string the name of the directory
     */
    function base_path(string $path = ''): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . $path;
    }
}

if (! function_exists('app_path')) {
    /**
     * App directroy path
     *
     * @param  string  $path
     * @return string the name of the directory
     */
    function app_path(string $path = ''): string
    {
        return base_path('app') . DIRECTORY_SEPARATOR . $path;
    }
}

if (! function_exists('storage_path')) {
    /**
     * Storage path of project
     * 
     * @param  string  $path
     * @return string the name of the directory
     */
    function storage_path(string $path = ''): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . "storage/{$path}";
    }
}

if (! function_exists('public_path')) {
    /**
     * Public path of project
     * 
     * @param  string  $path
     * @return string the name of the directory
     */
    function public_path(string $path = ''): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . "public/{$path}";
    }
}

if (! function_exists('config_path')) {
    /**
     * Config path of project
     * 
     * @param  string  $path
     * @return string the name of the directory
     */
    function config_path(string $path = ''): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . "configs/{$path}";
    }
}

if (! function_exists('config')) {
    /**
     * Get config file
     * 
     * @param  string  $file_name
     * @throws  FileNotFoundException
     * @return array Read intire file into a string
     */
    function config(string $file_name): array
    {
        $file = config_path($file_name) . '.php';

        if (! file_exists($file)) {
            throw new FileNotFoundException("Config file [$file] not found.");
        }

        return require $file;
    }
}

if (! function_exists('app_url')) {
    /**
     * Generate Custom URL
     *
     * @param  string  $route
     * @return string
     */
    function app_url(string $route = ''): string
    {
        return env('BASE_URL') . "/$route";
    }
}

if (! function_exists('assets')) {
    /**
     * Retrieve asset URL
     *
     * @param  string  $path
     * @return string
     */
    function assets(string $path): string
    {
        return app_url('assets/' . $path);
    }
}

if (! function_exists('is_url')) {
    /**
     * Check url value
     * 
     * @param  string  $value
     * @return bool
     */
    function is_url(string $value): bool
    {
        return $_SERVER['REQUEST_URI'] === $value;
    }
}

if (! function_exists('is_method')) {
    /**
     * Check request method
     *
     * @param  string  $method
     * @return boolean
     */
    function is_method(string $method): bool
    {
        $method = strtoupper($method);

        return $_SERVER['REQUEST_METHOD'] === $method;
    }
}

if (! function_exists('random_element')) {
    /**
     * Retrieve random index of array
     *
     * @param  array  $array
     * @return string
     */
    function random_element(array $array): string
    {
        shuffle($array);

        return array_pop($array);
    }
}

if (! function_exists('view')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $path
     * @param  array   $data  Accessible variables in view
     * @return void
     */
    function view(string $path, array $data = []): void
    {
        extract($data);
        $path = str_replace('.', '/', $path);
        $file = base_path("/views/{$path}.php");

        if (! file_exists($file) ) {
            throw new FileNotFoundException(
                "Failed to open stream, No such file or directory for view [$path]"
            );
        }

        require $file;
        die();
    }
}

if (! function_exists('abort')) {
    /**
     * Abort request
     * 
     * @param  int  $code http status code
     * @return string view
     */
    function abort(int $code = 404): string
    {
        http_response_code($code);

        require base_path("views/errors/{$code}.php");
        die();
    }
}

if (! function_exists('abort_unless')) {
    /**
     * Abort unless the condition is true
     *
     * @param boolean  $boolean
     * @param integer  $code
     * @return void
     */
    function abort_unless(bool $boolean, int $code = 404)
    {
        if (! $boolean) {
            abort($code);
        }
    }
}

if (! function_exists('abort_if')) {
    /**
     * Abort with confition
     *
     * @param boolean  $boolean
     * @param integer  $code
     * @return void
     */
    function abort_if (bool $boolean, int $code = 404)
    {
        if ($boolean) {
            abort($code);
        }
    }
}

if (! function_exists('bcrypt')) {
    /**
     * Creates a password hash
     *
     * @param  string  $value
     * @param  array  $options
     * @return string|false|null hashed password or false on failure or null on invalid algo
     */
    function bcrypt(string $value, array $options = [])
    {
        return password_hash($value, PASSWORD_BCRYPT, $options);
    }
}

if (! function_exists('redirect')) {
    /**
     * Redirect to url
     * 
     * @param  string  $to
     * @return void
     */
    function redirect(string $to)
    {
        header('Location: ' . $to);
        die();
    }
}

if (! function_exists('dd')) {
    /**
     * Die and Dump
     *
     * @param  mixed  $value
     * @return void
     */
    function dd($value)
    {
        dump($value);
        die();
    }
}

if (! function_exists('str_contains')) {
    /**
     * Check substring for string existance.
     *
     * @param  string  $str
     * @param  string  $needle
     * @param  integer  $case_sensitive
     * @return boolean
     */
    function str_contains(string $str, string $needle, $case_sensitive = 0): bool
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
