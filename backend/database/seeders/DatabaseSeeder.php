<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $user = User::factory()->create();
            $user2 = User::factory()->create();
            $tag = Tag::factory()->create();
            $topic = Topic::factory()->for($user)->hasAttached($tag)->create();
            $post = Post::factory()
                ->for($user2)
                ->for($topic)
                ->create();
            $comment = Comment::factory()->for($user)->for(
                $post,
                'commentable'
            )->create();
        }
    }
}
