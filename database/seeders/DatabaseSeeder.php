<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Models\User;
use App\Models\WhyChooseUs;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(WhyChooseUsTitleSeeder::class);
        Slider::factory(3)->create();
        WhyChooseUs::factory(3)->create();
        $this->call(CategorySeeder::class);
    }
}
