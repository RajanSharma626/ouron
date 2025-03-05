<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'slug' => Str::slug('Technology'),
                'description' => 'All about the latest tech trends.',
                'image' => 'categories/technology.jpg',
                'status' => 1,
                'meta_title' => 'Technology News & Updates',
                'meta_description' => 'Latest technology news and updates.',
                'meta_keywords' => 'tech, gadgets, software',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health & Wellness',
                'slug' => Str::slug('Health & Wellness'),
                'description' => 'Tips and advice on staying healthy.',
                'image' => 'categories/health.jpg',
                'status' => 1,
                'meta_title' => 'Health & Wellness Tips',
                'meta_description' => 'Best health and wellness practices.',
                'meta_keywords' => 'health, wellness, fitness',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business',
                'slug' => Str::slug('Business'),
                'description' => 'Business strategies and insights.',
                'image' => 'categories/business.jpg',
                'status' => 1,
                'meta_title' => 'Business Insights & Strategies',
                'meta_description' => 'Latest business trends and strategies.',
                'meta_keywords' => 'business, entrepreneurship, startups',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
