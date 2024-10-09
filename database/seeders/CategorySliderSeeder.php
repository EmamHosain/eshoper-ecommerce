<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategorySlider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
class CategorySliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = Category::get();
        foreach ($categories as $category) {

            for ($i = 0; $i < rand(1, 4); $i++) {
                CategorySlider::create([
                    'heading_one' => $faker->sentence(5, true),
                    'heading_two' => $faker->sentence(5, true),
                    'button_text' => 'shop now',
                    'category_id' => $category->id,
                    'slider_image' => $faker->imageUrl(1200, 600, 'products'),
                    'status' => $faker->randomElement([0, 1]),
                ]);
            }
        }

    }
}
