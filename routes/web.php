<?php

use App\Core\Routing\Route;

Route::add(['get', 'post'] ,'/auth', function() {
    echo 'Hello';
});

Route::add(['get'] ,'/null');

Route::add(['post'] ,'/enroll', function() {
    echo 'Hello';
});

Route::get('/greeting', function() {
    echo 'Hello';
});

Route::post('/saveForm', function() {
    echo 'Form submit';
});

// Route::put('/put-uri', ['UrlController', 'index']);
// Route::patch('/patch-uri', ['UrlController@index']);