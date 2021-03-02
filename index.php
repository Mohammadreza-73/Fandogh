<?php
include "bootstrap/init.php";

use App\Utilities\Asset;

// echo Asset::get('css/style.css');
// echo "<br>";
// echo Asset::css('style.css');
// echo "<br>";
// echo Asset::js('script.js');

$uri = strtok($_SERVER['REQUEST_URI'], '?');

if ($uri == '/colors/red')
    include BASE_PATH . "/views/colors/red.php";

if ($uri == '/colors/blue')
    include BASE_PATH . "/views/colors/blue.php";