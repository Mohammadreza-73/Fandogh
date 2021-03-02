<?php
include "constants.php";
include BASE_PATH . "/vendor/autoload.php";

/** Load dotenv library */
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

include BASE_PATH . "/helpers/url-helpers.php";