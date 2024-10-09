<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categoryNames = [
            'Electronics',
            'Clothing',
            'Home & Kitchen',
            'Sports & Outdoors',
            'Health & Beauty',
            'Books',
            'Toys & Games',
            'Automotive',
            'Jewelry',
            'Furniture',
            'Office Supplies',
            'Pet Supplies',
            'Music',
            'Video Games',
            'Computers & Accessories',
            'Garden & Outdoor',
        ];

        foreach ($categoryNames as $category) {
            Category::create([
                'category_name' => $category,
                'slug' => Str::slug($category), // Generate a unique slug
                'status' => $faker->numberBetween(0, 1),
                'category_logo' => $faker->imageUrl(500,400,'products')
            ]);
        }
    }
}
