<?php

namespace App\GraphQL\Queries;

use App\Models\Post;

final class GetPostById
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return Post::find($args['id']);
    }
}
