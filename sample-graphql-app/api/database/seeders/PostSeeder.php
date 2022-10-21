<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        foreach (User::all() as $user) {
            Post::factory()->create([
                'author_id' => $user->id
            ]);
        }
    }
}
