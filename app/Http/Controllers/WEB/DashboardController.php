<?php

namespace App\Http\Controllers\WEB;

use App\Models\Barang;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeminjaman = Peminjaman::count();
        $totalMahasiswa = Mahasiswa::count();
        $totalAlat = Barang::where('kategori_id', 1)->count();
        $totalBahan = Barang::where('kategori_id', 2)->count();

        // dd($totalAlat, $totalBahan);

        $peminjamanTerakhir30Hari = Peminjaman::whereRaw('CAST(tgl_pinjam AS DATE) >= ?', [now()->subDays(30)->toDateString()])->count();

        $persentasePeminjaman = ($totalPeminjaman > 0) ? ($peminjamanTerakhir30Hari / $totalPeminjaman) * 100 : 0;

        $totalDikembalikan = Peminjaman::where('status', 'Dikembalikan')->count();

        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact('totalPeminjaman', 'totalMahasiswa', 'totalAlat', 'totalBahan', 'persentasePeminjaman', 'totalDikembalikan', 'peminjamanTerakhir30Hari', 'notifikasiPeminjaman'));
    }
}
