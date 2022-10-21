<?php

namespace App\GraphQL\Mutations;

use App\Models\Comment;

final class CreateComment
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args): Comment
    {
        $comment = new Comment();
        $comment->fill($args['input'])->save();

        return $comment;
    }
}
