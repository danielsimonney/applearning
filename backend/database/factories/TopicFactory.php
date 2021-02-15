<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Topic::class;

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Topic $topic) {
            for ($nbImage = 0; $nbImage < mt_rand(0, 4); ++$nbImage) {
                $height = mt_rand(2, 8) * 100;
                $width = mt_rand(2, 8) * 100;
                $url = "https://picsum.photos/{$width}/{$height}";
                $topic
                    ->addMediaFromUrl($url)
                    ->toMediaCollection('topicsimages');
            }
            $users = User::all();
            $collectionPosts = Post::factory()
                ->count(random_int(...config('seeder.seed_topic_posts_count')))
                ->for($users->random())
                ->for($topic)
                ->has(
                    Comment::factory()
                        ->count(random_int(...config('seeder.seed_post_comments_count')))
                        ->for($users->random())
                )
                ->hasLikes(
                    random_int(...config('seeder.seed_post_likes_count')),
                    function (array $attributes, Post $post) {
                        $users = User::all();
                        return [
                            'likeable_id' => $post->id,
                            'likeable_type' => get_class($post),
                            'user_id' => $users->pluck('id')->random()
                        ];
                    }
                )->create();

            $idPosts = [];

            $randpost = $collectionPosts->random();
            $randpost->topicRelated()->save($randpost->topic);
            var_dump(get_class($this));
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'body' => $this->faker->sentence(75),
            'user_id' => User::factory(),
        ];
    }
}
