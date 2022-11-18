<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class UpdateUser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $now = Carbon::now()->format('Y-m-d');

        $user = auth()->user();

        /**
         * @var $file UploadedFile
         */
        $file = $args['file'];
        $extension = $file->getClientOriginalExtension();
        $customPath = $user->id . '_' . $now . '.' . $extension;
        $path =  Storage::putFileAs('avatars', $file, $customPath);
        $args['avatar_url'] = $path;

        $user->update($args);
        logger($user);

        return $user;
    }
}
