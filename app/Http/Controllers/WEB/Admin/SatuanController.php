<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function satuan()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $satuan = Satuan::paginate(5);
        return view('admin.satuan.index', ['satuan' => $satuan], ['notifikasiPeminjaman' => $notifikasiPeminjaman]);
    }

    public function storeSatuan(Request $request)
    {
        $request->validate([
            'satuan' => 'required|string'
        ]);

        Satuan::create([
            'satuan' => $request->satuan
        ]);

        return redirect()->route('data-satuan')->with('success', 'Satuan berhasil ditambahkan!');
    }

    public function deleteSatuan(Request $request, Satuan $satuan)
    {
        $satuan->delete();

        return redirect()->route('data-satuan')->with('success', 'Satuan berhasil dihapus!');
    }

    public function editSatuan(Request $request, Satuan $satuan)
    {
        $request->validate([
            'satuan' => 'required|string'
        ]);

        $satuan->update([
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('data-satuan')->with('success', 'Satuan berhasil diperbarui!');
    }
}
