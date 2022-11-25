<?php

namespace App\GraphQL\Mutations;

use App\Models\User;

final class Logout
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args): User
    {
        $guard = auth()->guard('user_sanctum');
        /** @var User $user */
        $user = $guard->user();
        $guard->logout();

        return $user;
    }
}
