<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => 'password',
        ]);
        $this->call([
            AdminSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ColorSeeder::class,
            ProductSizeSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            CategorySliderSeeder::class
        ]);
    }
}
