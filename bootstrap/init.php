<?php

include "constants.php";
include BASE_PATH . ('/vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(base_path());
$dotenv->load();

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$request = new \App\Core\Request();

include base_path('routes/web.php');
