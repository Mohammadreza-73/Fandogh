<?php

include "constants.php";
include BASE_PATH . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$request = new \App\Core\Request();

include BASE_PATH . "/routes/web.php";
