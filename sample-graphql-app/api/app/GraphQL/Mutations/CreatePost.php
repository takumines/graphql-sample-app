<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;

final class CreatePost
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args): Post
    {
        $post = new Post();
        $post->fill($args['input'])->save();

        return $post;
    }
}
