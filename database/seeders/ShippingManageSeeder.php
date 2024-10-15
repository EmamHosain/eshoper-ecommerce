<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingManage;

class ShippingManageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data to be seeded
        $shippingMethods = [
            [
                'shipping_name' => 'Uttora',
                'amount' => 50.00,
                'status' => 1,
            ],
            [
                'shipping_name' => 'Mirpur',
                'amount' => 100.00,
                'status' => 1,
            ],
            [
                'shipping_name' => 'Dhanmondi',
                'amount' => 150.00,
                'status' => 1,
            ],
            [
                'shipping_name' => 'Banani',
                'amount' => 60,
                'status' => 1,
            ],
            [
                'shipping_name' => 'Gulshan',
                'amount' => 50,
                'status' => 1,
            ],
        ];

        // Loop through and create each shipping method
        foreach ($shippingMethods as $method) {
            ShippingManage::create($method);
        }
    }
}
