<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use Faker\Provider\Biased;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            // TODO: Add a random size of the height and weight of the image
            // But the size modulo 100 should be 0
            $url = 'https://picsum.photos/400/400';
            $post
                ->addMediaFromUrl($url)
                ->toMediaCollection('posts');
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
            'body' => $this->faker->sentence,
            'topic_id' => Topic::factory(),
            'user_id' => User::factory(),
        ];
    }

}
