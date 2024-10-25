<?php

namespace App\Http\Controllers\WEB\Staff;

use App\Exports\LaporanExport;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $peminjamans = Peminjaman::paginate(5);

        return view('pageStaff.laporan.index', ['notifikasiPeminjaman' => $notifikasiPeminjaman, 'peminjamans' => $peminjamans]);
    }

    public function exportLaporan()
    {
        return Excel::download(new LaporanExport, 'laporan_peminjaman.xlsx');
    }
}
