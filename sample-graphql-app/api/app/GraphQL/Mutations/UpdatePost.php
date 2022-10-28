<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;

final class UpdatePost
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        logger($args);
        return Post::find($args['id'])->update($args);
    }
}
