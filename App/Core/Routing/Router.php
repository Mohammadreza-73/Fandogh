<?php

namespace App\Core\Routing;

use Exception;
use App\Core\Request;
use App\Core\Routing\Route;
use App\Middleware\Global\GlobalMiddleware;

class Router
{
    /**
     * Http Request
     *
     * @var Request
     */
    private Request $request;

    /**
     * Defined Routes
     *
     * @var array
     */
    private array $routes;

    /**
     * Matches Route
     *
     * @var array|null
     */
    private $currentRoute;

    private const BASE_CONTROLLER = 'App\Controllers\\';

    /**
     * Initiaize Properties
     * 
     * @return void
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->routes = Route::getRoutes();
        $this->currentRoute = $this->findRoute($this->request);

        /** Middlewares */
         $this->middleware();
         $this->globalMiddleware();
    }

    /**
     * Find Request Route in Routes list
     *
     * @param  Request $request
     * @return array   $route|null
     */
    public function findRoute(Request $request)
    {
        foreach ($this->routes as $route) {
            if (! in_array($request->method, $route['methods']) )
                return null;

            if ( $this->isUriMatched($route) )
                return $route;
        }
        
        return null;
    }

    /**
     * Execute Router
     *
     * @return void
     */
    public function run(): void
    {
        $this->invalidRequestMehtod($this->request);

        if ( null === $this->findRoute($this->request) )
            $this->dispatch404();

        $this->dispatch($this->currentRoute);
    }

    private function isUriMatched(array $route)
    {
        $pattern = '/^' . str_replace(['/', '{', '}'], ['\/', '(?<', '>[-%\w]+)'], $route['route']) . '$/';

        return preg_match($pattern, $this->request->uri) ? true : false ;
    }

    /**
     * Determines Global Middlewares
     *
     * @return void
     */
    private function globalMiddleware(): void
    {
        $globals = new GlobalMiddleware();
        $globals->handle();
    }

    /**
     * Determines Middlewares
     *
     * @throws Exception Route Existance
     * @throws Exception Class and method existance
     * @return void
     */
    private function middleware(): void
    {
        $middlewares = $this->currentRoute['middleware'];
        foreach ($middlewares as $middleware) {
            if (! class_exists($middleware) )
                throw new Exception("Middleware [$middleware] Not Exists");

            $className = new $middleware;

            if (! method_exists($className, 'handle') )
                throw new Exception("Middleware should implements `MiddlewareInterface`");

            $className->handle();
        }
    }

    /**
     * Determine Request Method
     *
     * @param Request $request
     * @return void
     */
    private function invalidRequestMehtod(Request $request): void
    {
        foreach ($this->routes as $route) {
            if ( $request->uri === $route['route'] && 
                ! in_array($request->method, $route['methods']) )
            {
                $this->dispatch405();
            }
        }
    }

    /**
     * Dispatch 405 view
     *
     * @return void
     */
    private function dispatch405(): void
    {
        header("HTTP/1.1 405 Method Not Allowed");
        view('errors.405');
    }

    /**
     * Dispatch 404 view
     *
     * @return void
     */
    private function dispatch404(): void
    {
        header("HTTP/1.1 404 Not Found");
        view('errors.404');
    }

    /**
     * Dispatch Request
     *
     * @param array|null $route
     * @return void
     */
    private function dispatch(?array $route): void
    {
        $action = $route['action'] ?? null;

        /**  action: null */
        if ( is_null($action) || empty($action) )
            return;

        /** action: closure */
        if ( is_callable($action) ) {
            $action();
            // call_user_func($action);
        }
        
        /** action: 'controller@method' */
        if ( is_string($action) )
            $action = explode('@', $action);

        /** action: ['controller', 'method'] */
        if ( is_array($action) ) {
            $className = self::BASE_CONTROLLER . $action[0];
            $method = $action[1];

            if (! class_exists($className) )
                throw new Exception("Class [$className] Not Exists!");
            
            $controller = new $className();

            if (! method_exists($className, $method) )
                throw new Exception("Method [$method] Not Exists in Class $className!");

            $controller->{$method}();
        }
    }
}