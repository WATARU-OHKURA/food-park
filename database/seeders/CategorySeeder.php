<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Sushi', 'slug' => Str::slug('Sushi'), 'status' => 1, 'show_at_home' => 1],
            ['name' => 'Sashimi', 'slug' => Str::slug('Sashimi'), 'status' => 1, 'show_at_home' => 1],
            ['name' => 'Tempura', 'slug' => Str::slug('Tempura'), 'status' => 1, 'show_at_home' => 1],
            ['name' => 'Grilled Dishes', 'slug' => Str::slug('Grilled Dishes'), 'status' => 1, 'show_at_home' => 1],
            ['name' => 'Donburi', 'slug' => Str::slug('Donburi'), 'status' => 1, 'show_at_home' => 1],
            ['name' => 'Noodles', 'slug' => Str::slug('Noodles'), 'status' => 1, 'show_at_home' => 1],
            ['name' => 'Hot Pot', 'slug' => Str::slug('Hot Pot'), 'status' => 1, 'show_at_home' => 1],
            ['name' => 'Teishoku', 'slug' => Str::slug('Teishoku'), 'status' => 1, 'show_at_home' => 1],
            ['name' => 'Appetizers', 'slug' => Str::slug('Appetizers'), 'status' => 1, 'show_at_home' => 1],
            ['name' => 'Desserts', 'slug' => Str::slug('Desserts'), 'status' => 1, 'show_at_home' => 1],
        ]);
    }
}
