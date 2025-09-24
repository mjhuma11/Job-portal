<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\companies;
use App\Models\User;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample company
        companies::create([
            'user_id' => 1, // Assuming user ID 1 exists
            'name' => 'Tech Solutions Inc.',
            'logo' => '', // Set empty string instead of null
            'description' => 'A leading technology company specializing in web development and software solutions.',
            'industry' => 'Information Technology',
            'email' => 'contact@techsolutions.com',
            'website' => 'https://techsolutions.com',
            'phone' => '+1 (555) 123-4567',
            'founded_year' => 2010,
            'featured' => true,
            'verified' => true,
        ]);
    }
}