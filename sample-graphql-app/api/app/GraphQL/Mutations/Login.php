<?php

namespace App\GraphQL\Mutations;

use Nuwave\Lighthouse\Exceptions\AuthenticationException;

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
        logger($token);
        if (!$token) {
            throw new AuthenticationException('Unauthorized', ['api']);
        }

        return [
            'token' => $token
        ];
    }
}
