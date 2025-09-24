<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'icon' => 'fas fa-laptop-code',
                'description' => 'Software development, IT, and tech-related positions',
                'image' => 'assets/images/categories/technology.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'icon' => 'fas fa-bullhorn',
                'description' => 'Digital marketing, advertising, and promotion roles',
                'image' => 'assets/images/categories/marketing.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'icon' => 'fas fa-paint-brush',
                'description' => 'UI/UX, graphic design, and creative positions',
                'image' => 'assets/images/categories/design.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Sales',
                'slug' => 'sales',
                'icon' => 'fas fa-chart-line',
                'description' => 'Sales representatives, account managers, and business development',
                'image' => 'assets/images/categories/sales.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Finance',
                'slug' => 'finance',
                'icon' => 'fas fa-dollar-sign',
                'description' => 'Accounting, financial analysis, and banking positions',
                'image' => 'assets/images/categories/finance.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Healthcare',
                'slug' => 'healthcare',
                'icon' => 'fas fa-heartbeat',
                'description' => 'Medical, nursing, and healthcare administration roles',
                'image' => 'assets/images/categories/healthcare.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'icon' => 'fas fa-graduation-cap',
                'description' => 'Teaching, training, and educational administration',
                'image' => 'assets/images/categories/education.jpg',
                'status' => '1',
            ],
            [
                'name' => 'Engineering',
                'slug' => 'engineering',
                'icon' => 'fas fa-cogs',
                'description' => 'Mechanical, civil, electrical, and other engineering roles',
                'image' => 'assets/images/categories/engineering.jpg',
                'status' => '1',
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
