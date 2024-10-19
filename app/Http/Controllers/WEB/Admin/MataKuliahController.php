<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('admin.matakuliah.index', ['matakuliah' => $matakuliah, 'notifikasiPeminjaman' => $notifikasiPeminjaman]);
    }

    public function storeMatakuliah(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            $totalMataKuliah = MataKuliah::count() + 1;

            $kodeMataKuliah = str_pad($totalMataKuliah, 3, '0', STR_PAD_LEFT);


            $matakuliah = new MataKuliah();
            $matakuliah->kode_mata_kuliah = $kodeMataKuliah;
            $matakuliah->mata_kuliah = $request->mata_kuliah;
            $matakuliah->save();
        });

        return redirect()->route('data-mata-kuliah')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function editMatakuliah(MataKuliah $mataKuliah, Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|string',
        ]);

        $mataKuliah->update([
            'mata_kuliah' => $request->mata_kuliah,
        ]);

        return redirect()->route('data-mata-kuliah')->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    public function deleteMatakuliah(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('data-mata-kuliah')->with('success', 'Mata kuliah berhasil di hapus!');
    }
}
