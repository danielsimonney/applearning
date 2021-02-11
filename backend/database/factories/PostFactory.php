<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
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
            for ($nbImage = 0; $nbImage < 2; $nbImage++) {
                $height = mt_rand(2, 8) * 100;
                $width = mt_rand(2, 8) * 100;
                $url = "https://picsum.photos/{$width}/{$height}";
                $post
                    ->addMediaFromUrl($url)
                    ->toMediaCollection('postsimages');
            }
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
