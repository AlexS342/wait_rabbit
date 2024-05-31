<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->firstName() . rand(11, 9999),
            'email' => fake()->unique()->safeEmail(),
            'review' => fake()->text(500),
            'ip' => fake()->ipv4(),
            'browser' => fake()->country(),
        ];
    }
}
