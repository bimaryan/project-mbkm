<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function mahasiswa()
    {
        $mahasiswa = Mahasiswa::paginate(5);
        $kelas = Kelas::all();
        return view('admin.pengguna.mahasiswa.index', ['mahasiswa' => $mahasiswa], ['kelas' => $kelas]);
    }

    public function storeMahasiswa(Request $request) {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'kelas_id' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:6',
        ]);

        DB::transaction(function () use ($request) {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->nama = $request->nama;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->kelas_id = $request->kelas_id;
            $mahasiswa->email = $request->email;
            $mahasiswa->password = Hash::make($request->password);
            $mahasiswa->save();
        });

        return redirect()->route('data-mahasiswa')->with('success', 'Pendaftaran sudah berhasil.');
    }

    public function editMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $kelas = Kelas::all();
        return view('admin.pengguna.mahasiswa.edit', ['mahasiswa' => $mahasiswa], ['kelas' => $kelas]);
    }

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

    public function deleteKelas(Kelas $kelas) {
        $kelas->delete();
        return redirect()->route('data-kelas')->with('success','Kelas berhasil di hapus!');
    }
}
