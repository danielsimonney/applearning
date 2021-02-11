<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'collection_name' => "default",
            'name' => $this->faker->name(),
            'file_name' => $this->faker->name() . "jpg",
            "mimetype" => "image/jpeg",
            "disk" => "media",
            "conversions_disk" => "media",
            "size" => $this->faker->numberBetween(70000, 1000000),
        ];
    }
}
