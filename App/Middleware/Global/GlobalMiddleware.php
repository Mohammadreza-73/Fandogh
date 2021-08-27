<?php

namespace App\Middleware\Global;

use Exception;
use App\Middleware\BlockIE;
use App\Middleware\BlockFirefox;
use App\Middleware\Contract\MiddlewareInterface;

class GlobalMiddleware implements MiddlewareInterface
{
    /**
     * Global Middlewares
     *
     * @var array
     */
    protected $middlewares = [
        BlockIE::class,
        // BlockFirefox::class,
    ];

    /**
     * Execute Middlewares
     *
     * @throws Exception Class and method existance 
     * @return void
     */
    public function handle(): void
    {
        foreach ($this->middlewares as $middleware) {
            if (! class_exists($middleware) )
                throw new Exception("Middleware [$middleware] Not Exists");

            $className = new $middleware;
        
            if (! method_exists($className, 'handle') )
                throw new Exception('Middleware should implements `GlobalMiddleware` interface');

            $className->handle();
        }
    }
}