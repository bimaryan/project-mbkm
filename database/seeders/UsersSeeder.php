<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'password' => bcrypt('password'),
            'nim' => 'admin',
            'role_id' => 1,
            'telepon' => '1234567891011'
        ]);
        User::create([
            'name' => 'staff',
            'password' => bcrypt('password'),
            'nim' => 'staff',
            'role_id' => 2,
            'telepon' => '1110987654321'
        ]);
        User::create([
            'name' => 'Bima Ryan Alfarizi',
            'password' => bcrypt('password'),
            'nim' => '2205036',
            'role_id' => 3,
            'telepon' => '085157433395'
        ]);
    }
}
