<?php

include "constants.php";
include BASE_PATH . "/vendor/autoload.php";

/** Load dotenv library */
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

/** Request Object */
$request = new \App\Core\Request();

include BASE_PATH . "/helpers/helpers.php";
include BASE_PATH . "/routes/web.php";