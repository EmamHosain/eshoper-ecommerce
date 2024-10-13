<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $faker = Faker::create();

        User::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'user@gmail.com',
            'password' => 'password',
            'photo' => $faker->imageUrl(200, 200, 'users', true),
        ]);


        $this->call([
            AdminSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ColorSeeder::class,
            ProductSizeSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            CategorySliderSeeder::class,
        ]);
    }
}
