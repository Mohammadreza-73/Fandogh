<?php

namespace App\Middleware\Global;

use Exception;
use App\Middleware\BlockIE;
use App\Middleware\BlockFirefox;
use App\Exceptions\ClassNotFoundException;
use App\Exceptions\MethodNotFoundException;
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
                throw new ClassNotFoundException("Middleware [$middleware] Not Exists");

            $globalMiddleware = new $middleware();
        
            if (! method_exists($globalMiddleware, 'handle') )
                throw new MethodNotFoundException('Middleware should implements `GlobalMiddleware` interface');

            $globalMiddleware->handle();
        }
    }
}