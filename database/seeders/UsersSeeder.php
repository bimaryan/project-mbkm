<?php

namespace Database\Seeders;

use App\Models\User;
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

        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'dosen' . $i,
                'nama_lengkap' => 'Dosen ' . $i,
                'password' => bcrypt('password'),
                'role_id' => 2,
                'telepon' => '1110987654' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'keterangan' => 'DOSEN'
            ]);

            User::create([
                'name' => '22050' . str_pad($i, 3, '0', STR_PAD_LEFT), // ID mahasiswa unik
                'nama_lengkap' => 'Mahasiswa ' . $i,
                'password' => bcrypt('password'),
                'role_id' => 3,
                'telepon' => '085157433' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'keterangan' => 'MAHASISWA'
            ]);
        }
    }
}
