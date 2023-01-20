<?php

namespace App\Http\Controllers;

class PostController
{
    public function single($slug, $cid)
    {
        echo 'slug: ' . $slug;
        echo '<br>';
        echo 'comment_id: ' . $cid;
    }
}
