<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(3, true),
            'company' => fake()->company(),
            'location' => fake()->city() . ', ' . fake()->stateAbbr(),
            'salary' => fake()->numberBetween(50000, 200000),
            'salary_type' => fake()->randomElement(['hour', 'month', 'year']),
            'user_id' => User::factory(),
        ];
    }
}
