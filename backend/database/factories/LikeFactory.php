<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_liked' => $this->faker->boolean(),
            'likeable_id' => Topic::factory(),
            'likeable_type' => Topic::class,
            'user_id' => User::factory(),
        ];
    }
}
