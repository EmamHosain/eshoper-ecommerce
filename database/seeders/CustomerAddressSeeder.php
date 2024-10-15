<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use App\Models\ShippingManage;
use App\Models\CustomerAddress;
use Illuminate\Database\Seeder;

class CustomerAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Loop to create 10 customer addresses
        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $faker->unique()->safeEmail(),
                'password' => 'password',
            ]);

            $customerAddress = new CustomerAddress();
            $customerAddress->first_name = $faker->firstName();
            $customerAddress->last_name = $faker->lastName();
            $customerAddress->email = $faker->unique()->safeEmail();
            $customerAddress->mobile = $faker->phoneNumber();
            $customerAddress->address = $faker->address();
            $customerAddress->city = $faker->city();
            $customerAddress->state = $faker->state();
            $customerAddress->zip = $faker->postcode();
            $customerAddress->shipping_manage_id = ShippingManage::inRandomOrder()->value('id') ?? null;
            $customerAddress->user_id = $user->id;
            $customerAddress->save();
        }
    }
}
