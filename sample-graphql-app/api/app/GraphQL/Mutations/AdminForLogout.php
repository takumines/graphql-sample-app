<?php

namespace App\GraphQL\Mutations;

use App\Models\Admin;

final class AdminForLogout
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        $guard = auth()->guard('admin_sanctum');
        /** @var Admin $user */
        $admin = $guard->user();
        $guard->logout();

        return $admin;
    }
}
