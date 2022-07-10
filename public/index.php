<?php

require_once '../bootstrap/init.php';

use App\Core\Routing\Router;

$router = new Router();
$router->run();