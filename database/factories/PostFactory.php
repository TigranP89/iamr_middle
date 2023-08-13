<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(rand(3, 8), true);
        $url = '/img/no_image/no_image.png';

        return [
          'title' => $title,
          'slug' => Str::slug($title),
          'category_id' => $this->faker->numberBetween(1, 10),//?
          'image' =>$url,
          'description' => $this->faker->text(rand(40, 100)),
          'status' => $this->faker->boolean,
          'order_id' => $this->faker->randomElement([1, 2, 3]),
        ];
    }
}
