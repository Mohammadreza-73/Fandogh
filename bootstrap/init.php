<?php

include "constants.php";
include BASE_PATH . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$request = new \App\Core\Request();

include BASE_PATH . "/routes/web.php";