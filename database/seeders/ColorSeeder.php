<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'red',
            'green',
            'blue',
            'yellow',
            'orange',
            'purple',
            'pink',
            'brown',
            'black',
            'white'
        ];

        foreach ($colors as $color) {
            Color::create([
                'color_name' => $color
            ]);
        }
    }
}
