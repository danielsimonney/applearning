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

        function halfBetween($identifier)
        {
            return (random_int(config('seeder.' . $identifier)[0], config('seeder.' . $identifier)[1]));
        }

        $nbTopics = config('seeder.seed_topics_count');
        $nbUsers = config('seeder.seed_users_count');
        $nbPosts = halfBetween('seed_topics_posts_count');
        $nbComments = halfBetween('seed_comments_count');
        $nbTags = halfBetween('seed_tags_count');
        $nbLikesTopics = halfBetween('seed_topics_likes_count');
        $nbLikesPosts = halfBetween('seed_posts_likes_count');

        User::factory()->count($nbUsers)->create();
        Topic::factory()->count($nbTopics)->create();
        Post::factory()->count($nbPosts)->create();
        Comment::factory()->count($nbComments)->create();
        Like::factory()->count($nbLikesPosts)->create();
        Like::factory()->count($nbLikesTopics)->create();
        Tag::factory()->count($nbTags)->create();
    }
}
