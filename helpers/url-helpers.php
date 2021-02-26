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