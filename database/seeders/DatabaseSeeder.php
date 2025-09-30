<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\companies;
use App\Models\Role;
use App\Models\jobs;
use App\Models\job_seekers;
use App\Models\job_applications;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks to avoid constraint issues
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Clear existing data
        DB::table('job_applications')->truncate();
        DB::table('job_seekers')->truncate();
        DB::table('jobs_post')->truncate();
        DB::table('companies')->truncate();
        DB::table('users')->truncate();
        
        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Seed roles first
        $this->call(RoleSeeder::class);
        
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', 'admin')->first()->id,
            'email_verified_at' => now(),
        ]);

        // Create 10 job seekers with profiles
        $jobSeekers = User::factory()
            ->count(10)
            ->jobSeeker()
            ->has(job_seekers::factory()
                ->state(function (array $attributes, User $user) {
                    return [
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'name' => $user->name,
                    ];
                }), 'jobSeekerProfile')
            ->create();

        // Create 5 employers with companies
        $employers = User::factory()
            ->count(5)
            ->employer()
            ->create();

        // Create companies for employers
        foreach ($employers as $employer) {
            $company = companies::factory()->create([
                'user_id' => $employer->id,
            ]);

            // Create 3-7 jobs for each company
            $jobs = jobs::factory()
                ->count(rand(3, 7))
                ->create([
                    'company_id' => $company->id,
                    'created_by' => $employer->id,
                ]);

            // For each job, create 1-5 applications from random job seekers
            foreach ($jobs as $job) {
                $applicants = $jobSeekers->random(rand(1, 5));
                
                foreach ($applicants as $applicant) {
                    job_applications::factory()->create([
                        'job_id' => $job->id,
                        'user_id' => $applicant->id,
                        'status' => $this->faker->randomElement(['pending', 'reviewed', 'shortlisted', 'rejected']),
                    ]);
                }
            }
        }

        // Create a test job seeker
        $testJobSeeker = User::factory()->create([
            'name' => 'Test Job Seeker',
            'email' => 'jobseeker@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', 'job_seeker')->first()->id,
        ]);

        job_seekers::factory()->create([
            'user_id' => $testJobSeeker->id,
            'email' => $testJobSeeker->email,
            'name' => $testJobSeeker->name,
            'current_position' => 'Senior Software Developer',
            'experience_years' => 5,
            'availability_status' => 'available',
            'location_preference' => 'Remote',
            'remote_preference' => true,
            'bio' => 'Experienced software developer with 5+ years of experience in web development. Proficient in PHP, Laravel, JavaScript, and modern web technologies.',
            'expected_salary_min' => 80000,
            'expected_salary_max' => 120000,
        ]);

        // Create a test employer
        $testEmployer = User::factory()->create([
            'name' => 'Test Employer',
            'email' => 'employer@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', 'employer')->first()->id,
        ]);

        $testCompany = companies::factory()->create([
            'user_id' => $testEmployer->id,
            'company_name' => 'Tech Solutions Inc.',
            'company_email' => 'info@techsolutions.com',
            'company_phone' => '+1 (555) 123-4567',
            'website' => 'https://techsolutions.com',
            'company_size' => '51-200',
            'industry' => 'Information Technology',
            'founded_year' => 2015,
        ]);

        // Create some featured jobs
        jobs::factory(3)->featured()->create([
            'company_id' => $testCompany->id,
            'created_by' => $testEmployer->id,
            'status' => 'active',
        ]);

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin Login: admin@example.com / password');
        $this->command->info('Job Seeker Login: jobseeker@example.com / password');
        $this->command->info('Employer Login: employer@example.com / password');
    }
}