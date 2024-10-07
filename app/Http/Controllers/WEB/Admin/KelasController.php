<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function kelas() {
        
        $kelas = Kelas::all();
        return view('admin.pengguna.kelas.index', ['kelas' => $kelas]);
        
    }

    public function storeKelas(Request $request) {
        $request->validate([
            'kelas' => 'required|string',
        ]);

        Kelas::create([
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('data-kelas')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function deleteKelas(Kelas $kelas, Request $request) {
        $kelas->delete();
        return redirect()->route('data-kelas')->with('success','Kelas berhasil di hapus!');
    }
}
