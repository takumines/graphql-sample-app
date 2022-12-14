<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\AuthenticationException;
use App\Models\User;


final class Login
{
    /**
     * @param null $_
     * @param array{} $args
     * @throws AuthenticationException
     */
    public function __invoke($_, array $args): User
    {
        $credentials = [
            'email' => $args['email'],
            'password' => $args['password']
        ];
        if (!auth('user_sanctum')->attempt($credentials)) {
            throw new AuthenticationException('Unauthorized', 'api');
        }
        /** @var User $user */
        $user = auth('user_sanctum')->user();

        return $user;
    }
}
