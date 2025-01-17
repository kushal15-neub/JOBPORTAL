<?php

namespace Database\Factories;

use App\Models\JobType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JobTypeFactory extends Factory
{
    protected $model = JobType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Full Time',
                'Part Time',
                'Contract',
                'Freelance',
                'Internship'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
