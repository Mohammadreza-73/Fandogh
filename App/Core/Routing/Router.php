<?php

namespace App\Core\Routing;

use Exception;
use App\Core\Request;
use App\Core\Routing\Route;

class Router
{
    private Request $request;
    private array $routes;
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
    }

    /**
     * Find Request Route in Routes list
     *
     * @param  Request $request
     * @return array   $route|null
     */
    public function findRoute(Request $request): ?array
    {
        foreach ($this->routes as $route) {
            if ( in_array($request->method, $route['methods']) &&
                            $request->uri === $route['route'] )
            {
                return $route;
            }
        }
        
        return null;
    }

    public function run()
    {
        $this->invalidRequestMehtod($this->request);

        if ( null === $this->findRoute($this->request) )
            $this->dispatch404();

        $this->dispatch($this->currentRoute);
    }

    private function invalidRequestMehtod(Request $request)
    {
        foreach ($this->routes as $route) {
            if ( $request->uri === $route['route'] && 
                ! in_array($request->method, $route['methods']) )
            {
                $this->dispatch405();
            }
        }
    }

    private function dispatch405()
    {
        header("HTTP/1.1 405 Method Not Allowed");
        view('errors.405');
    }

    private function dispatch404()
    {
        header("HTTP/1.1 404 Not Found");
        view('errors.404');
    }

    private function dispatch(?array $route)
    {
        $action = $route['action'] ?? null;

        # action: null
        if ( is_null($action) || empty($action) )
            return;

        # action: closure
        if ( is_callable($action) ) {
            $action();
            // call_user_func($action);
        }
        
        # action: 'controller@method'
        if ( is_string($action) )
            $action = explode('@', $action);

        # action: ['controller', 'method']
        if ( is_array($action) ) {
            $className = self::BASE_CONTROLLER . $action[0];
            $method = $action[1];

            if (! class_exists($className) )
                throw new Exception("Class $className Not Exists!");
            
            $controller = new $className();

            if (! method_exists($className, $method) )
                throw new Exception("Method $method Not Exists in Class $className!");

            $controller->{$method}();
        }
    }
}