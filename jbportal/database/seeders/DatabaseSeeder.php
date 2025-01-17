<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\JobType;  
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First seed the job types
        \App\Models\JobType::factory(5)->create();
        
        // Then seed some users if needed
        \App\Models\User::factory(10)->create();
        
        // Finally seed the jobs
        \App\Models\Job::factory(20)->create();
    }
}
