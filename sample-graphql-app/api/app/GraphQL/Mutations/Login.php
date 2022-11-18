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
    public function __invoke($_, array $args)
    {
        $token = auth('api')->attempt($args);
        if (!$token) {
            throw new AuthenticationException('Unauthorized', 'api');
        }

        return [
            'token' => $token
        ];
    }
}
