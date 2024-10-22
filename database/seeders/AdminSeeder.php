<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = Admin::create([
      'name' => 'admin',
      'email' => 'admin@gmail.com',
      'password' => 'password',
    ]);



    








  }
}
