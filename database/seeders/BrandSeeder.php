<?php

namespace Database\Seeders;

use App\Models\Brand;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $brandNames = [
            'Nike',
            'Adidas',
            'Apple',
            'Samsung',
            'Sony',
            'LG',
            'Microsoft',
            'Dell',
            'HP',
            'Lenovo',
            'Asus',
            'Intel',
            'Google',
            'Facebook',
            'Amazon',
            'Coca-Cola',
            'Pepsi',
            'Toyota',
            'Honda',
            'BMW',
        ];

        foreach ($brandNames as $brand) {
            Brand::create([
                'brand_name' => $brand,
                'slug'=> $brand,
                'status' => $faker->numberBetween(0, 1),
                'brand_logo' => null
            ]);
        }

    }
}
