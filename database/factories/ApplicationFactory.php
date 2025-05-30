<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'job_id' => Job::factory(),
            'name'=> Application::factory(),
            'email'=> Application::factory(),
            'phone'=> Application::factory(),
            'cover_letter' => fake()->paragraphs(2, true),
            'status' => fake()->randomElement(['pending', 'reviewed', 'accepted', 'rejected']),
        ];
    }
}
