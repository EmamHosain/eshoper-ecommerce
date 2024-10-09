<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
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

        // Get all products
        $products = Product::get();

        // Loop through each product and seed product images
        foreach ($products as $product) {
            // Create between 1 to 3 images for each product
            for ($i = 0; $i < rand(1, 7); $i++) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->product_image = $faker->imageUrl(640, 480, 'products',true);
                $productImage->save();
            }
        }
    }
}
