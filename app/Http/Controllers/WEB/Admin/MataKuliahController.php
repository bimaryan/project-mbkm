<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\MataKuliah;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Imports\MatkulImport;
use Maatwebsite\Excel\Facades\Excel;

class MataKuliahController extends Controller
{
    public function matakuliah()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $matakuliah = MataKuliah::paginate(5);
        return view('pageAdmin.matakuliah.index', ['matakuliah' => $matakuliah, 'notifikasiPeminjaman' => $notifikasiPeminjaman]);
    }

    public function storeMatakuliah(Request $request)
    {
        $request->validate([
            'kode_mata_kuliah'=> 'required|string',
            'mata_kuliah' => 'required|string',
        ], [
            'kode_mata_kuliah.required'=> 'Kode mata kuliah harus diisi',
            'mata_kuliah.required'=> 'Mata kuliah harus diisi',
        ]);

        $matakuliah = MataKuliah::create($request->all());

        $matakuliah->save();

        return redirect()->route('data-mata-kuliah')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function editMatakuliah(MataKuliah $matakuliah, Request $request)
    {
        $request->validate([
            'kode_mata_kuliah' => 'required',
            'mata_kuliah' => 'required',
        ]);
        

        // dd($request->all());
        $matakuliah->update([
            'kode_mata_kuliah'=> $request->kode_mata_kuliah,
            'mata_kuliah' => $request->mata_kuliah
        ]);

        return redirect()->route('data-mata-kuliah')->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    public function deleteMatakuliah(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('data-mata-kuliah')->with('success', 'Mata kuliah berhasil di hapus!');
    }

    public function importMatkul(Request $request) {
        Excel::import(new MatkulImport(), $request->file('file'));

        return redirect()->route('data-mata-kuliah')->with('success', 'Kelas berhasil di import!');
    }
}
