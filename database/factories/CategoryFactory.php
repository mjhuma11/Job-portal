<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'icon' => fake()->imageUrl(),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(),
            'status' => fake()->randomElement(['0', '1']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
