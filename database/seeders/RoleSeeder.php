<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'admin',
            'super admin',
            'manager',
            'editor',
            'creator',
            'destroyer'
        ];

        foreach ($names as $name) {
            Role::create([
                'name' => $name,
                'guard_name' => 'admin'
            ]);

        }
    }
}
