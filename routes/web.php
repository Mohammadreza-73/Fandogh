<?php

use App\Core\Routing\Route;
use App\Middleware\BlockFirefox;

Route::get('/', function () {
    echo 'Welcome Page';
});

Route::add(['get'], '/null');

Route::get('/', ['HomeController', 'index']);

Route::get('/home', 'HomeController@order');

Route::get('/archive', 'ArchiveController@index');

Route::get('/archive/products', 'ArchiveController@products');

Route::get('/archive/articles', 'ArchiveController@articles');

Route::get('/todo/list', 'TodoController@list', [BlockFirefox::class]);

Route::any('/test', function () {
    echo 'test route';
});