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
        $kategoriAlat = DB::table('kategoris')->where('kategori', 'Alat')->value('id');
        $kategoriBahan = DB::table('kategoris')->where('kategori', 'Bahan')->value('id');

        for ($i = 1; $i <= 1000; $i++) {
            $kategori_id = ($i % 2 == 0) ? $kategoriBahan : $kategoriAlat;

            $barang = Barang::create([
                'users_id' => 1,
                'name' => 'Barang Contoh ' . $i,
                'gambar' => 'uploads/barang/sample' . $i . '.jpg',
                'deskripsi' => 'Ini adalah deskripsi barang contoh ' . $i . '.',
                'kategori_id' => $kategori_id,
                'satuan_id' => 1,
                'room_id' => 1,
                'kondisi_id' => 4,
            ]);

            Persentase::create([
                'satuans_id' => 1,
                'persentase' => rand(5, 20),
            ]);

            Stock::create([
                'barang_id' => $barang->id,
                'stock' => rand(50, 200),
            ]);
        }
    }
}
