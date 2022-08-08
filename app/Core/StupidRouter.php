<?php

namespace App\Core;

use App\Utilities\Url;

class StupidRouter
{
    private $routes;

    public function __construct()
    {
        $this->routes = [
            '/'  => '/views/home/index.php',
            '/colors/red'  => '/views/colors/red.php',
            '/colors/blue' => '/views/colors/blue.php'
        ];
    }

    public function run()
    {
        $current_route = Url::currentRoute();

        foreach ($this->routes as $route => $views) {
            if ($current_route == $route) {
                $this->includeView(BASE_PATH . $views);
            }
        }

        $this->setHeader('Not Found', 404);
        $this->includeView(BASE_PATH . '/views/errors/404.php');
    }

    private function includeView(string $view_path)
    {
        include "$view_path";
        die();
    }

    private function setHeader(string $msg, int $code)
    {
        header("HTTP/1.1 {$code} {$msg}");
    }
}
