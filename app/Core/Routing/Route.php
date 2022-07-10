<?php

namespace App\Core\Routing;

class Route
{
    /**
     * @var array Routes list
     */
    private static array $routes = [];

    /**
     * Add Routes
     *
     * @param  array|string $methods
     * @param  string       $uri
     * @param  closure      $action
     * @param  array        $middleware
     * @return void
     */
    public static function add($methods, string $uri, $action = null, array $middleware = []): void
    {
        $methods = is_array($methods) ? $methods : [$methods];   // Standardize method
        self::$routes[] = [
            'methods'    => $methods,
            'uri'        => $uri,
            'action'     => $action,
            'middleware' => $middleware
        ];
    }

    /**
     * Add Route with GET Method
     *
     * @param  string   $uri
     * @param  closure  $action
     * @param  array    $middleware
     * @return void
     */
    public static function get(string $uri, $action = null, array $middleware = []): void
    {
        self::add('get', $uri, $action, $middleware);
    }

    /**
     * Add Route with POST Method
     *
     * @param  string  $uri
     * @param  closure $action
     * @param  array   $middleware
     * @return void
     */
    public static function post(string $uri, $action = null, array $middleware = []): void
    {
        self::add('post', $uri, $action, $middleware);
    }

    /**
     * Add Route with PUT Method
     *
     * @param  string  $uri
     * @param  closure $action
     * @param  array   $middleware
     * @return void
     */
    public static function put(string $uri, $action = null, array $middleware = []): void
    {
        self::add('put', $uri, $action, $middleware);
    }

    /**
     * Add Route with PATCH Method
     *
     * @param  string  $uri
     * @param  closure $action
     * @param  array   $middleware
     * @return void
     */
    public static function patch(string $uri, $action = null, array $middleware = []): void
    {
        self::add('patch', $uri, $action, $middleware);
    }

    /**
     * Add Route with DELETE Method
     *
     * @param  string  $uri
     * @param  closure $action
     * @param  array   $middleware
     * @return void
     */
    public static function delete(string $uri, $action = null, array $middleware = []): void
    {
        self::add('delete', $uri, $action, $middleware);
    }

    /**
     * Add Route with OPTIONS Method
     *
     * @param  string  $uri
     * @param  closure $action
     * @param  array   $middleware
     * @return void
     */
    public static function options(string $uri, $action = null, array $middleware = []): void
    {
        self::add('options', $uri, $action, $middleware);
    }

    /**
     * Add Route with all Methods
     *
     * @param  string  $uri
     * @param  closure $action
     * @param  array  $middleware
     * @return void
     */
    public static function any(string $uri, $action = null, array $middleware = []): void
    {
        self::add(['get', 'post', 'put', 'patch', 'options', 'delete'], $uri, $action, $middleware);
    }
    
    /**
     * Get Array Routes
     *
     * @return array
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }
}
