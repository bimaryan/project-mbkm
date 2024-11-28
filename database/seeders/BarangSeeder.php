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

        $descriptions = [
            'Produk ini dirancang dengan material berkualitas tinggi yang menjamin keawetan dan performa optimal. Cocok digunakan di berbagai situasi baik untuk keperluan pribadi maupun profesional.',
            'Solusi sempurna untuk memenuhi kebutuhan harian Anda. Produk ini memberikan kombinasi antara efisiensi dan kenyamanan dengan desain yang modern.',
            'Dibuat dengan bahan pilihan terbaik, produk ini menawarkan kinerja yang stabil, tahan lama, dan ramah lingkungan. Pilihan tepat untuk meningkatkan produktivitas.',
            'Produk inovatif dengan teknologi mutakhir yang dirancang untuk mempermudah aktivitas Anda. Hemat energi, praktis, dan ramah lingkungan.',
            'Menawarkan keseimbangan sempurna antara harga dan kualitas, produk ini hadir sebagai solusi terbaik untuk kebutuhan sehari-hari Anda.',
            'Produk unggulan dengan fitur tambahan yang dirancang untuk memberikan kenyamanan ekstra dalam penggunaan. Ideal untuk berbagai aktivitas.',
            'Desain ergonomis yang memberikan kenyamanan maksimum saat digunakan. Produk ini sangat direkomendasikan untuk penggunaan intensif.',
            'Hadir dengan kualitas premium, produk ini dirancang untuk kebutuhan profesional. Material tahan lama memastikan produk ini dapat diandalkan untuk waktu yang lama.',
            'Pilihan terbaik untuk aktivitas sehari-hari Anda. Produk ini tidak hanya fungsional tetapi juga memberikan nilai estetika tinggi.',
            'Produk yang dirancang dengan fokus pada efisiensi dan kualitas. Solusi terbaik bagi mereka yang membutuhkan keandalan dalam aktivitas sehari-hari.'
        ];

        for ($i = 1; $i <= 100; $i++) {
            $kategori_id = ($i % 2 == 0) ? $kategoriBahan : $kategoriAlat;

            $satuan_id = $satuan[array_rand($satuan)];
            $randomDescription = $descriptions[array_rand($descriptions)];

            $barang = Barang::create([
                'nama_barang' => 'Barang Contoh ' . $i,
                'foto' => 'https://placehold.co/600x400.jpg',
                'deskripsi' => $randomDescription,
                'kategori_id' => $kategori_id,
                'satuan_id' => $satuan_id,
                'kondisi_id' => 4,
            ]);


            Stock::create([
                'barang_id' => $barang->id,
                'stock' => rand(1, 200),
            ]);
        }
    }
}
