<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class JobSeekersFactory extends Factory
{
    public function definition(): array
    {
        // Create a user if not exists with job seeker role
        $user = User::factory()->jobSeeker()->create();
        
        $skills = [
            'PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React', 'Node.js',
            'Python', 'Django', 'Java', 'Spring', 'SQL', 'MySQL', 'PostgreSQL',
            'MongoDB', 'Docker', 'AWS', 'Git', 'REST API', 'GraphQL', 'TypeScript'
        ];
        
        $randomSkills = $this->faker->randomElements($skills, $this->faker->numberBetween(3, 8));
        
        return [
            'user_id' => $user->id,
            'resume_file' => 'resumes/' . $this->faker->uuid() . '.pdf',
            'bio' => $this->faker->paragraph($this->faker->numberBetween(2, 5)),
            'current_position' => $this->faker->jobTitle,
            'experience_years' => $this->faker->numberBetween(0, 20),
            'expected_salary_min' => $this->faker->numberBetween(30000, 80000),
            'expected_salary_max' => $this->faker->numberBetween(80000, 200000),
            'availability_status' => $this->faker->randomElement(['available', 'not_available', 'open_to_offers']),
            'location_preference' => $this->faker->city . ', ' . $this->faker->country,
            'remote_preference' => $this->faker->boolean(70), // 70% chance of true
            'linkedin_url' => 'https://linkedin.com/in/' . $this->faker->userName,
            'portfolio_url' => 'https://' . $this->faker->domainName,
            'github_url' => 'https://github.com/' . $this->faker->userName,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'date_of_birth' => $this->faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
            'profile_image' => 'profile_images/' . $this->faker->image(public_path('storage/profile_images'), 200, 200, 'people', false),
            'twitter_url' => 'https://twitter.com/' . $this->faker->userName,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
