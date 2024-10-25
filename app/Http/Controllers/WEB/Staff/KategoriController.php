<?php

namespace App\Http\Controllers\WEB\Staff;

use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Imports\KategoriImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class KategoriController extends Controller
{

    public function importKategori(Request $request)
    {
        $request->validate(
            [
                'file' => 'required|mimes:xlsx,xls,csv',
            ],
            [
                'file.mimes' => 'File harus berupa .xlsx, .xls, .csv',
            ]
        );

        Excel::import(new KategoriImport(), $request->file('file'));

        return redirect()->route('data-kategori')->with('success','Kategori berhasil di import');
    }

    public function kategori()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $kategori = Kategori::paginate(5);
        return view('pageStaff.kategori.index', ['kategori' => $kategori, 'notifikasiPeminjaman' => $notifikasiPeminjaman]);
    }



    public function storeKategori(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
        ]);

        Kategori::create([
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('data-kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function editKategori(Request $request, Kategori $kategori)
    {
        $request->validate([
            'kategori' => 'required|string',
        ]);

        $kategori->update([
            'kategori' => $request->kategori
        ]);

        return redirect()->route('data-kategori')->with('success', 'Kategori updated successfully.');
    }


    public function deleteKategori(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('data-kategori')->with('success', 'Kategori deleted successfully.');
    }
}
