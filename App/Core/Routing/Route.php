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
     * @param  string       $route
     * @param  closure      $action
     * @param  array        $middleware
     * @return void
     */
    public static function add($methods, string $route, $action = null, array $middleware = []): void
    {
        $methods = is_array($methods) ? $methods : [$methods];   // Standardize method
        self::$routes[] = [
            'methods'    => $methods,
            'route'      => $route,
            'action'     => $action,
            'middleware' => $middleware
        ];
    }

    /**
     * Add Route with GET Method
     *
     * @param  string   $route
     * @param  closure  $action
     * @param  array    $middleware
     * @return void
     */
    public static function get(string $route, $action = null, array $middleware = []): void
    {
        self::add('get', $route, $action, $middleware);
    }

    /**
     * Add Route with POST Method
     *
     * @param  string  $route
     * @param  closure $action
     * @param  array   $middleware
     * @return void
     */
    public static function post(string $route, $action = null, array $middleware = []): void
    {
        self::add('post', $route, $action, $middleware);
    }

    /**
     * Add Route with PUT Method
     *
     * @param  string  $route
     * @param  closure $action
     * @param  array   $middleware
     * @return void
     */
    public static function put(string $route, $action = null, array $middleware = []): void
    {
        self::add('put', $route, $action, $middleware);
    }

    /**
     * Add Route with PATCH Method
     *
     * @param  string  $route
     * @param  closure $action
     * @param  array   $middleware
     * @return void
     */
    public static function patch(string $route, $action = null, array $middleware = []): void
    {
        self::add('patch', $route, $action, $middleware);
    }

    /**
     * Add Route with DELETE Method
     *
     * @param  string  $route
     * @param  closure $action
     * @param  array   $middleware
     * @return void
     */
    public static function delete(string $route, $action = null, array $middleware = []): void
    {
        self::add('delete', $route, $action, $middleware);
    }

    /**
     * Add Route with OPTIONS Method
     *
     * @param  string  $route
     * @param  closure $action
     * @param  array   $middleware
     * @return void
     */
    public static function options(string $route, $action = null, array $middleware = []): void
    {
        self::add('options', $route, $action, $middleware);
    }

    /**
     * Add Route with all Methods
     *
     * @param string  $route
     * @param closure $action
     * @param  array  $middleware
     * @return void
     */
    public static function any(string $route, $action = null, array $middleware = []): void
    {
        self::add(['get', 'post', 'put', 'patch', 'options', 'delete'], $route, $action, $middleware);
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