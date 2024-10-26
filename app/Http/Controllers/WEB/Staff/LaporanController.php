<?php

namespace App\Http\Controllers\WEB\Staff;

use App\Exports\LaporanExport;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $peminjamans = Peminjaman::with(['mahasiswa', 'barang'])
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('tgl_pinjam', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tgl_pinjam', $tahun);
            })
            ->paginate(5);

        return view('pageStaff.laporan.index', [
            'notifikasiPeminjaman' => $notifikasiPeminjaman,
            'peminjamans' => $peminjamans,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }

    public function exportLaporan()
    {
        return Excel::download(new LaporanExport, 'laporan_peminjaman.xlsx');
    }
}
