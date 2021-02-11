<?php

namespace Database\Factories;

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
            $height = 400;
            $width = 400;

            // TODO: make the height and width dynamic between (200, 800) with a step of 100
            $url = "https://picsum.photos/{$width}/{$height}";
            $topic
                ->addMediaFromUrl($url)
                ->toMediaCollection('auctions');
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
