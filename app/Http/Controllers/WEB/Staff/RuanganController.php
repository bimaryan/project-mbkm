<?php

namespace App\Http\Controllers\WEB\Staff;

use Illuminate\Http\Request;
use App\Imports\RuanganImport;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Maatwebsite\Excel\Facades\Excel;

class RuanganController extends Controller
{
    public function ruangan()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $ruangan = Ruangan::paginate(5);
        return view("pageStaff.ruangan.index", ["ruangan" => $ruangan, 'notifikasiPeminjaman' => $notifikasiPeminjaman]);
    }

    public function storeRuangan(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|string'
        ]);

        Ruangan::create([
            'nama_ruangan' => $request->nama_ruangan
        ]);

        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan!');
    }

    public function editRuangan(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'nama_ruangan' => 'required|string'
        ]);

        $ruangan->update([
            'nama_ruangan' => $request->nama_ruangan
        ]);

        return redirect()->back()->with('success', 'Ruangan berhasil diperbarui!');
    }

    public function deleteRuangan(Ruangan $ruangan)
    {
        $ruangan->delete();

        return redirect()->back()->with('success', 'Ruangan berhasil dihapus!');
    }

    public function importRuangan(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ], [
            'file.mimes' => 'File harus berupa .xlsx, .xls, .csv',
        ]);

        Excel::import(new RuanganImport(), $request->file('file'));
        return redirect()->route('data-ruangan')->with('success', 'Ruangan berhasil diimport!');
    }
}
