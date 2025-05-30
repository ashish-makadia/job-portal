<?php
namespace Database\Seeders;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $jobs = Job::all();

        if ($users->isEmpty() || $jobs->isEmpty()) {
            return;
        }

        // Create 20 random applications
        for ($i = 0; $i < 10; $i++) {
            $user = $users->random();
            $job = $jobs->random();

            // Check if application already exists
            $exists = Application::where('user_id', $user->id)
                ->where('job_id', $job->id)
                ->exists();

            if (!$exists) {
                Application::create([
                    'user_id' => $user->id,
                    'job_id' => $job->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone ?? fake()->phoneNumber(),
                    'cover_letter' => fake()->paragraphs(2, true),
                    'status' => fake()->randomElement(['pending', 'reviewed', 'accepted', 'rejected']),
                ]);
            }
        }
    }
}