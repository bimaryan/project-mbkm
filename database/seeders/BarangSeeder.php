<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Persentase;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 10 barang
        for ($i = 1; $i <= 1000; $i++) {
            // Membuat barang baru
            $barang = Barang::create([
                'users_id' => 1,
                'name' => 'Barang Contoh ' . $i,
                'gambar' => 'uploads/barang/sample' . $i . '.jpg',
                'deskripsi' => 'Ini adalah deskripsi barang contoh ' . $i . '.',
                'kategori_id' => 1,
                'satuan_id' => 1,
                'room_id' => 1,
                'kondisi_id' => 4,
            ]);

            // Membuat persentase untuk barang
            Persentase::create([
                'satuans_id' => 1,
                'persentase' => rand(5, 20),
            ]);

            // Membuat stok untuk barang
            Stock::create([
                'barang_id' => $barang->id,
                'stock' => rand(50, 200),
            ]);
        }
    }
}
