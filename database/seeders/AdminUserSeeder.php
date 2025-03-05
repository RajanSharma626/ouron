<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->updateOrInsert(
            ['id' => 1], // Ensure admin always has ID = 1
            [
                'name' => 'Admin',
                'email' => 'admin@example.com', // Change as needed
                'password' => Hash::make('admin123'), // Set a strong password
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
