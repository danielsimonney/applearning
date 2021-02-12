<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // 1) Create env variables to contain the number of Model that you want to seed in the .env
        // SEED_USERS_COUNT = 10
        // SEED_POSTS_COUNT = 10
        // ...

        // 2) Then you need to create a configuration file in config/name_of_the_file.php

        // 3) And then you need to create separately those items using the factory

        // 4) Finally to need to chain all the factories to create all the items


        $topicsCount = config('seeder.seed_topics_count');
        $usersCount = config('seeder.seed_users_count');
        $tagsCount = config('seeder.seed_tags_count');
        $postsCount = random_int(...config('seeder.seed_topics_posts_count'));
        $commentsCount = random_int(...config('seeder.seed_comments_count'));
        $topicTagsCount = random_int(...config('seeder.seed_topic_tags_count'));
        $topicLikesCount = random_int(...config('seeder.seed_topics_likes_count'));
        $postLikesCount = random_int(...config('seeder.seed_posts_likes_count'));

        User::factory()->count($usersCount)->create();
        Topic::factory()->count($topicsCount)->create();
        Post::factory()->count($postsCount)->create();
        Comment::factory()->count($commentsCount)->create();
        Like::factory()->count($postLikesCount)->create();
        Like::factory()->count($topicLikesCount)->create();
        Tag::factory()->count($tagsCount)->create();
    }
}
