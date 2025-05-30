<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $employers = User::where('role', 'employer')->get();
        
        if ($employers->isEmpty()) {
            $employers = User::limit(3)->get();
        }

        $jobs = [
            [
                'title' => 'Senior Laravel Developer',
                'description' => 'We are looking for an experienced Laravel developer to join our team.',
                'company' => 'Tech Solutions Inc.',
                'location' => 'New York, NY',
                'salary' => 120000,
                'salary_type' => 'year',
            ],
            [
                'title' => 'React Frontend Developer',
                'description' => 'Join our frontend team to build amazing user interfaces with React.',
                'company' => 'StartupXYZ',
                'location' => 'San Francisco, CA',
                'salary' => 110000,
                'salary_type' => 'year',
            ],
            [
                'title' => 'Full Stack Developer',
                'description' => 'Work on both frontend and backend development using modern technologies.',
                'company' => 'Digital Agency',
                'location' => 'Austin, TX',
                'salary' => 100000,
                'salary_type' => 'year',
            ],
            [
                'title' => 'DevOps Engineer',
                'description' => 'Manage our cloud infrastructure and deployment pipelines.',
                'company' => 'Cloud First Corp',
                'location' => 'Seattle, WA',
                'salary' => 130000,
                'salary_type' => 'year',
            ],
            [
                'title' => 'Junior PHP Developer',
                'description' => 'Entry-level position for a PHP developer to grow with our team.',
                'company' => 'Web Development Co',
                'location' => 'Chicago, IL',
                'salary' => 65000,
                'salary_type' => 'year',
            ],
        ];

        foreach ($jobs as $jobData) {
            Job::create(array_merge($jobData, [
                'user_id' => $employers->random()->id,
            ]));
        }

        Job::factory(10)->create();
    }
}