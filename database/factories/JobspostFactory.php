<?php

namespace Database\Factories;

use App\Models\companies;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class JobspostFactory extends Factory
{
    public function definition(): array
    {
        // Get a random company or create one if none exists
        $company = companies::inRandomOrder()->first() ?? companies::factory()->create();
        
        // Get a random user with employer role or create one
        $employer = User::whereHas('role', function($query) {
            $query->where('name', 'employer');
        })->inRandomOrder()->first() ?? User::factory()->employer()->create();
        
        $jobTypes = ['Full-time', 'Part-time', 'Contract', 'Freelance', 'Internship', 'Temporary'];
        $experienceLevels = ['Entry Level', 'Mid Level', 'Senior Level', 'Lead', 'Manager'];
        $categories = [
            'Technology', 'Healthcare', 'Finance', 'Education', 'Marketing', 
            'Sales', 'Design', 'Customer Service', 'Human Resources', 'Engineering'
        ];
        
        $skills = [
            'PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React', 'Node.js',
            'Python', 'Django', 'Java', 'Spring', 'SQL', 'MySQL', 'PostgreSQL',
            'MongoDB', 'Docker', 'AWS', 'Git', 'REST API', 'GraphQL', 'TypeScript'
        ];
        
        $requiredSkills = $this->faker->randomElements($skills, $this->faker->numberBetween(3, 8));
        $responsibilities = array_map(fn() => $this->faker->sentence(8), range(1, $this->faker->numberBetween(5, 10)));
        $benefits = array_map(fn() => $this->faker->sentence(6), range(1, $this->faker->numberBetween(3, 7)));
        
        return [
            'company_id' => $company->id,
            'job_title' => $this->faker->jobTitle,
            'category' => $this->faker->randomElement($categories),
            'salary' => '$' . $this->faker->numberBetween(50, 200) . 'k - $' . $this->faker->numberBetween(200, 500) . 'k',
            'requirements' => implode('\n', array_map(fn($skill) => "- $skill", $requiredSkills)),
            'experience' => $this->faker->randomElement($experienceLevels) . ' (' . $this->faker->numberBetween(1, 10) . '+ years)',
            'responsibilities' => implode('\n', array_map(fn($item) => "• $item", $responsibilities)),
            'benefits' => implode('\n', array_map(fn($benefit) => "✓ $benefit", $benefits)),
            'application_deadline' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
            'job_type' => $this->faker->randomElement($jobTypes),
            'status' => $this->faker->randomElement(['active', 'inactive', 'draft', 'closed']),
            'description' => $this->faker->paragraphs($this->faker->numberBetween(3, 8), true),
            'location' => $this->faker->city . ', ' . $this->faker->country,
            'created_by' => $employer->id,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
    
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
    
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
            'application_deadline' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
        ]);
    }
}
