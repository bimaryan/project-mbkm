<?php

namespace App\Http\Controllers\API\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $kategori = $request->input('kategori');
        $validCategories = ['Alat', 'Bahan'];

        if ($kategori && $kategori !== 'Semua') {
            if (in_array($kategori, $validCategories)) {
                $barangs = Barang::whereHas('kategori', function ($query) use ($kategori) {
                    $query->where('kategori', $kategori);
                })->take(6)->get();
            } else {
                $barangs = collect();
            }
        } else {
            $barangs = Barang::whereHas('kategori', function ($query) use ($validCategories) {
                $query->whereIn('kategori', $validCategories);
            })->take(6)->get();
        }

        $kategoris = Kategori::whereIn('kategori', $validCategories)->get();
        $barangKosong = $barangs->isEmpty();

        return response()->json([
            'barangs' => $barangs,
            'kategoris' => $kategoris,
            'barangKosong' => $barangKosong
        ]);
    }

    public function katalog(Request $request)
    {
        $kategori = $request->input('kategori');
        $validCategories = ['Alat', 'Bahan'];

        if ($kategori && $kategori !== 'Semua') {
            if (in_array($kategori, $validCategories)) {
                $barangs = Barang::whereHas('kategori', function ($query) use ($kategori) {
                    $query->where('kategori', $kategori);
                })->paginate(6)->appends(['kategori' => $kategori]);
            } else {
                $barangs = collect();
            }
        } else {
            $barangs = Barang::whereHas('kategori', function ($query) use ($validCategories) {
                $query->whereIn('kategori', $validCategories);
            })->paginate(6);
        }

        $kategoris = Kategori::whereIn('kategori', $validCategories)->get();
        $barangKosong = $barangs->isEmpty();

        return response()->json([
            'barangs' => $barangs,
            'kategoris' => $kategoris,
            'barangKosong' => $barangKosong,
            'kategoriTerpilih' => $kategori
        ]);
    }

    public function peminjaman(Request $request, Barang $barang, Stock $stock)
    {
        $mahasiswaId = Auth::user()->id;

        $peminjaman = Peminjaman::create([
            'mahasiswa_id' => $mahasiswaId,
            'barang_id' => $barang->id,
            'stock_id' => $stock->id,
            'ruangan_id' => $request->input('ruangan_id'),
            'matkul_id' => $request->input('matkul_id'),
            'dosen_id' => $request->input('dosen_id'),
            'stock_pinjam' => $request->input('jumlah_pinjam'),
            'QR' => rand(10000, 99999),
            'tgl_pinjam' => $request->input('tgl_pinjam'),
            'waktu_pinjam' => $request->input('waktu_pinjam'),
            'waktu_kembali' => $request->input('waktu_kembali'),
            'keterangan' => $request->input('keterangan'),
            'spo_id' => $request->input('spo_id'),
            'aprovals' => 'Belum',
            'status' => 'Menunggu Persetujuan'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil dibuat dan menunggu persetujuan.',
            'data' => $peminjaman
        ]);
    }
}
