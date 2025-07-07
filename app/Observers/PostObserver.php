<?php

namespace App\Observers;
use App\Models\Post;

class PostObserver
{
    public function updating(Post $post) {

        if ($post->publicado && !$post->publicado_en) {
            $post->publicado_en = now();
        }

    }
}
