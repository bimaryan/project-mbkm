<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create([
            'jurusan' => 'D3 Teknik Informatika'
        ]);
        Jurusan::create([
            'jurusan' => 'D4 Teknik Rekayasa Perangkat Lunak'
        ]);
        Jurusan::create([
            'jurusan' => 'D4 Teknik Pendingin dan Tata Udara'
        ]);
        Jurusan::create([
            'jurusan' => 'D3 Teknik  Mesin'
        ]);
        Jurusan::create([
            'jurusan' => 'D3 Keperawatan'
        ]);
    }
}
