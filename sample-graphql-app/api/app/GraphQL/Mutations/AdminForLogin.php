<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\AuthenticationException;
use App\Models\Admin;

final class AdminForLogin
{
    /**
     * @param null $_
     * @param array{} $args
     * @throws AuthenticationException
     */
    public function __invoke($_, array $args): Admin
    {
        $credentials = [
            'email' => $args['email'],
            'password' => $args['password']
        ];
        if (! auth('admin_sanctum')->attempt($credentials)) {
            throw new AuthenticationException('Unauthorized', 'api');
        }
        /** @var Admin $admin */
        $admin = auth('admin_sanctum')->user();

        return $admin;
    }
}
