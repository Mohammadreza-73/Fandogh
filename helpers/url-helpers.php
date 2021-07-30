<?php

function siteUrl(string $route)
{
    return $_ENV['BASE_URL'] . $route;
}

function assetsUrl(string $route)
{
    return siteUrl('/assets' . $route);
}

function randomElement(array $array)
{
    shuffle($array);
    return array_pop($array);
}

function view(string $path, array $data = []): void
{
    extract($data);
    $path = str_replace('.', '/', $path);
    include BASE_PATH . "/views/{$path}.php";
    die();
}