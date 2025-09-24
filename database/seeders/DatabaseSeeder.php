<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles first
        $this->call(RoleSeeder::class);
        
        // Assign roles to existing users
        $this->call(AssignRolesSeeder::class);
        
        // User::factory(10)->create();

        // Create test user with job seeker role
        $jobSeekerRole = \App\Models\Role::where('name', 'jobseeker')->first();
        
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => $jobSeekerRole ? $jobSeekerRole->id : null,
        ]);
        
        // Create job seeker profile for test user if role exists
        if ($jobSeekerRole && $testUser) {
            \App\Models\job_seekers::create([
                'user_id' => $testUser->id,
                'bio' => 'Test job seeker profile',
                'current_position' => 'Software Developer',
                'experience_years' => 2,
                'availability_status' => 'immediately',
                'location_preference' => 'Remote',
                'remote_preference' => true,
            ]);
        }
    }
}