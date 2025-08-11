<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   User::factory()->create([
        'name' => 'Test User',
        'username' => 'testuser',
        'email' => 'test@example'
    ]);
        $categories = [
            'Technolgy',
            'Health',
            'Science',
            'Politics',
            'Entertainment',
        ];

        foreach ($categories as $category) {
            Category::create(['name'=> $category]);
        }

        
    }
}
