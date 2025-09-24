<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\companies;
use App\Models\job_seekers;

class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the roles
        $adminRole = Role::where('name', 'admin')->first();
        $employerRole = Role::where('name', 'employer')->first();
        $jobSeekerRole = Role::where('name', 'jobseeker')->first();
        
        // Create specific admin user if not exists
        if ($adminRole) {
            $adminUser = User::where('email', 'admin@example.com')->first();
            if (!$adminUser) {
                $adminUser = User::create([
                    'name' => 'Admin User',
                    'email' => 'admin@example.com',
                    'password' => bcrypt('admin123'),
                    'role_id' => $adminRole->id,
                ]);
            } else {
                $adminUser->role_id = $adminRole->id;
                $adminUser->save();
            }
        }
        
        // Create specific employer user if not exists
        if ($employerRole) {
            $employerUser = User::where('email', 'employer@example.com')->first();
            if (!$employerUser) {
                $employerUser = User::create([
                    'name' => 'Employer User',
                    'email' => 'employer@example.com',
                    'password' => bcrypt('employer123'),
                    'role_id' => $employerRole->id,
                ]);
                
                // Create a company for this employer
                companies::create([
                    'user_id' => $employerUser->id,
                    'name' => 'Test Company',
                    'email' => 'company@example.com',
                    'description' => 'A test company for employer dashboard access',
                    'logo' => null, // Set logo as null since it's nullable
                ]);
            } else {
                $employerUser->role_id = $employerRole->id;
                $employerUser->save();
            }
        }
        
        // Assign roles to existing users
        $users = User::all();
        
        foreach ($users as $user) {
            // Skip admin and employer users we just created
            if (in_array($user->email, ['admin@example.com', 'employer@example.com'])) {
                continue;
            }
            
            // Check if user already has a role
            if ($user->role_id) {
                continue;
            }
            
            // Check if user is associated with a company (employer)
            $company = companies::where('user_id', $user->id)->first();
            if ($company) {
                $user->role_id = $employerRole->id;
                $user->save();
                continue;
            }
            
            // Check if user is a job seeker
            $jobSeeker = job_seekers::where('user_id', $user->id)->first();
            if ($jobSeeker) {
                $user->role_id = $jobSeekerRole->id;
                $user->save();
                continue;
            }
            
            // Default to job seeker role for all other users
            $user->role_id = $jobSeekerRole->id;
            $user->save();
            
            // Create job seeker profile if it doesn't exist
            if (!job_seekers::where('user_id', $user->id)->exists()) {
                job_seekers::create([
                    'user_id' => $user->id,
                    'bio' => null,
                    'current_position' => null,
                    'experience_years' => 0,
                    'availability_status' => 'immediately',
                    'location_preference' => null,
                    'remote_preference' => false,
                ]);
            }
        }
    }
}