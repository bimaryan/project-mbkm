<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MataKuliahController extends Controller
{
    public function matakuliah() {
        $matakuliah = MataKuliah::paginate(5);
        return view('admin.matakuliah.index', ['matakuliah' => $matakuliah]);
    }

    public function storeMatakuliah(Request $request) {
        $request->validate([
            'kode_mata_kuliah' => 'required|string',
            'mata_kuliah' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            $matakuliah = new MataKuliah();
            $matakuliah->kode_mata_kuliah = $request->kode_mata_kuliah;
            $matakuliah->mata_kuliah = $request->mata_kuliah;
            $matakuliah->save();
        });

        return redirect()->route('data-mata-kuliah')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function deleteMatakuliah(MataKuliah $matakuliah) {
        $matakuliah->delete();
        return redirect()->route('data-mata-kuliah')->with('success', 'Mata kuliah berhasil di hapus!');
    }
}
