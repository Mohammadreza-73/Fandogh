<?php

namespace App\Http\Controllers;

class PostController
{
    public function index($slug)
    {
        echo 'slug: ' . $slug;
    }
}
