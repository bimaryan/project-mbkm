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

        $satuanUnit = DB::table('satuans')->where('satuan', 'Unit')->value('id');
        $satuanPcs = DB::table('satuans')->where('satuan', 'Pcs')->value('id');
        $satuanLembar = DB::table('satuans')->where('satuan', 'Lembar')->value('id');
        $satuanLiter = DB::table('satuans')->where('satuan', 'Liter')->value('id');
        $satuan = [$satuanUnit, $satuanPcs, $satuanLembar, $satuanLiter];

        for ($i = 1; $i <= 100; $i++) {
            $kategori_id = ($i % 2 == 0) ? $kategoriBahan : $kategoriAlat;

            $satuan_id = $satuan[array_rand($satuan)];

            $barang = Barang::create([
                'nama_barang' => 'Barang Contoh ' . $i,
                'foto' => 'https://placehold.co/600x400.jpg',
                'kategori_id' => $kategori_id,
                'satuan_id' => $satuan_id,
                'kondisi_id' => 4,
            ]);


            Stock::create([
                'barang_id' => $barang->id,
                'stock' => rand(50, 200),
            ]);
        }
    }
}
