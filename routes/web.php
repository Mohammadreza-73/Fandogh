<?php

use App\Core\Routing\Route;
use App\Middleware\BlockFirefox;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/post/{slug}/comment/{cid}', 'PostController@single');

Route::get('/todo/list', 'TodoController@list', [BlockFirefox::class]);
