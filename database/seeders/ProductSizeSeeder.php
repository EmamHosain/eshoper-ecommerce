<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productSizes = [
            'xs',
            's',
            'm',
            'l',
            'xl',
            '2Xl ',
        ];

        foreach ($productSizes as $size) {
            Size::create([
                'size_name' => $size
            ]);
        }
    }
}
