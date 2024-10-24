<?php

namespace App\Http\Controllers\WEB\Staff;

use App\Http\Controllers\Controller;
use App\Imports\SatuanImport;
use App\Models\Peminjaman;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SatuanController extends Controller
{
    public function importSatuan(Request $request) {
        $request->validate([
           'file' => 'required|mimes:xlsx,xls,csv',
        ], [
            'file'=> 'File harus berupa .xlsx, .xls, .csv',
        ]);

        Excel::import(new SatuanImport(), $request->file('file'));

        return redirect()->route('data-satuan')->with('success', 'Mahasiswa berhasil di import!');
    }

    public function satuan()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $satuan = Satuan::paginate(5);
        return view('pageStaff.satuan.index', ['satuan' => $satuan], ['notifikasiPeminjaman' => $notifikasiPeminjaman]);
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
