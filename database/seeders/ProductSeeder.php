<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an instance of Faker
        $faker = Faker::create();

        // Seed 10 products (adjust the number as necessary)
        for ($i = 1; $i <= 100; $i++) {
            $product_name = $faker->unique()->words(3, true);
            $product_code = IdGenerator::generate(['table' => 'products', 'field' => 'code', 'length' => 10, 'prefix' => 'PC-' . date('ym')]);

            // Create a new instance of the Product model
            $product = new Product();

            // Assign values to the product's attributes
            $product->category_id = Category::inRandomOrder()->first()->id;
            $product->brand_id = Brand::inRandomOrder()->first()->id;
            $product->product_name = $product_name;
            $product->slug = Str::slug($product_name);
            $product->price = $faker->randomFloat(2, 10, 1000); 

           


            $discount_price = $product->price - 20;
            $random_number = $faker->randomElement([0, 1]);
            if ($random_number === 1) {
                $product->discount_price = $discount_price;
                $product->is_discount = 1;
            } else {
                $product->is_discount = 0;
                $product->discount_price = null;
            }




            $product->description = $faker->paragraph;
            $product->information = $faker->optional()->paragraph; // Optional information
            $product->short_description = $faker->sentence;
            $product->code = $product_code; // Generate a random unique product code
            $product->quantity = $faker->numberBetween(1, 100); // Random quantity
            $product->status = $faker->randomElement([0, 1]); // Randomly active or inactive
            $product->popularity = $faker->randomElement(['trandy', 'arrived']); // Random popularity status

            // Set the timestamps
            $product->created_at = Carbon::now();
            // $product->updated_at = now();

            // Save the product to the database
            $product->save();


            $colors = Color::all();
            $sizes = Size::all();
            $product->colors()->attach($colors->random(rand(1,3))->pluck('id')->toArray());
            $product->sizes()->attach($sizes->random(rand(1,3))->pluck('id')->toArray());


        }
    }
}
