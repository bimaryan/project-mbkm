<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class matkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalMataKuliah = MataKuliah::count() + 1;

        $kodeMataKuliah = str_pad($totalMataKuliah, 3, '0', STR_PAD_LEFT);

        MataKuliah::create([
            'kode_mata_kuliah' => $kodeMataKuliah,
            'mata_kuliah' => 'Sistem Informasi'
        ]);
    }
}
