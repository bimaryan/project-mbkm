<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'kategori' => 'Alat',
        ]);
        Kategori::create([
            'kategori' => 'Bahan',
        ]);
        Kategori::create([
            'kategori' => 'File',
        ]);
    }
}
