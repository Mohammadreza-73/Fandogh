<?php

use App\Core\Routing\Route;

Route::add(['get', 'post'], '/auth', function () {
    echo 'Hello';
});

Route::add(['get'], '/null');

Route::add(['post'], '/enroll', function () {
    echo 'Hello';
});

Route::get('/greeting', function () {
    echo 'Hello from greeting';
});

Route::post('/saveForm', function () {
    echo 'Form submit';
});

Route::get('/', ['HomeController', 'index']);

Route::get('/home', 'HomeController@order');

Route::get('/archive', 'ArchiveController@index');

Route::get('/archive/products', 'ArchiveController@products');

Route::get('/archive/articles', 'ArchiveController@articles');

Route::get('/todo/list', 'TodoController@list');

Route::any('/test', function() {
    echo 'test route';
});