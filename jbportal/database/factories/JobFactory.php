<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph(4),
            'requirements' => $this->faker->paragraph(3),
            'job_type_id' => \App\Models\JobType::inRandomOrder()->first()->id,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'salary' => $this->faker->numberBetween(30000, 150000),
            'location' => $this->faker->city,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}