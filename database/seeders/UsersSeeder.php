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
            'nama_lengkap' => 'admin',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'telepon' => '1234567891011',
            'keterangan' => 'ADMIN'
        ]);
        User::create([
            'name' => 'dosen',
            'nama_lengkap' => 'dosen',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'telepon' => '1110987654321',
            'keterangan' => 'DOSEN'
        ]);
        User::create([
            'name' => '2205036',
            'nama_lengkap' => 'Bima Ryan Alfarizi',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'telepon' => '085157433395',
            'keterangan' => 'MAHASISWA'
        ]);
    }
}
