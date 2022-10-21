<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::truncate();
        foreach (Post::all() as $post) {
            Comment::factory()->create([
                'post_id' => $post->id
            ]);
        }
    }
}
