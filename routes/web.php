<?php

use App\Http\Middleware\BlockIE;
use App\Core\Components\Routing\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/post/{slug}', 'PostController@index');

Route::get('/todo/list', 'TodoController@list', [BlockIE::class]);
