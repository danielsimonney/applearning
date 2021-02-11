<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\Topic;
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
            "mime_type" => "image/jpeg",
            "disk" => "media",
            "conversions_disk" => "media",
            "size" => $this->faker->numberBetween(70000, 1000000),
            'model_type' => Topic::class,
            'model_id' => Topic::factory(),
            'manipulations' => [],
            'custom_properties' => [],
            'responsive_images' => []

        ];
    }
}
