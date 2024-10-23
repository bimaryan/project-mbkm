<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Imports\MahasiswaImport;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Imports\KelasImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MultipleSheetsImport;

class MahasiswaController extends Controller
{
    public function mahasiswa()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $mahasiswa = Mahasiswa::paginate(5);
        $kelas = Kelas::all();
        return view('admin.pengguna.mahasiswa.index', ['mahasiswa' => $mahasiswa, 'notifikasiPeminjaman' => $notifikasiPeminjaman], ['kelas' => $kelas]);
    }

    public function storeMahasiswa(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|string',
            // 'kelas_id' => 'required|string',
        ]);


        $validatedData['password'] = Hash::make('@Poli' . $validatedData['nim']);

        DB::transaction(function () use ($request) {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->nama = $request->nama;
            $mahasiswa->nim = $request->nim;
            // $mahasiswa->kelas_id = $request->kelas_id;
            $mahasiswa->password = Hash::make($request->password);
            $mahasiswa->save();
        });

        return redirect()->route('data-mahasiswa')->with('success', 'Pendaftaran sudah berhasil.');
    }

    public function editMahasiswa(Request $request, Mahasiswa $mahasiswa)
    {
        $kelas = Kelas::all();

        $request->validate([
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'nama' => 'required|string',
            'nim' => 'required|string',
            // 'kelas_id' => 'required|exists:kelas,id',
        ]);

        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto && file_exists(public_path($mahasiswa->foto))) {
                unlink(public_path($mahasiswa->foto));
            }

            $filepath = $request->file('foto')->move('foto_mahasiswa', time() . '_' . $request->file('foto')->getClientOriginalName());

            $mahasiswa->foto = $filepath;
        }

        $mahasiswa->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            // 'kelas_id' => $request->kelas_id,
        ]);


        return redirect()->route('data-mahasiswa', ['kelas' => $kelas])->with('success', 'Pengguna berhasil di diperbarui!');
    }

    public function deleteMahasiswa(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('data-mahasiswa')->with('success', 'Mahasiswa berhasil di hapus!');
    }

    public function kelas()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $kelas = Kelas::paginate(5);
        return view('admin.kelas.index', ['kelas' => $kelas], ['notifikasiPeminjaman' => $notifikasiPeminjaman]);
    }

    public function storeKelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string',
        ], [
            'nama_kelas.required' => 'Kelas harus di isi',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->route('data-kelas')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function editkelas(Kelas $kelas, Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->route('data-kelas')->with('success', 'Kelas berhasil diperbarui!');
    }

    public function deleteKelas(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('data-kelas')->with('success', 'Kelas berhasil di hapus!');
    }

    public function importKelas(Request $request)
    {

        Excel::import(new KelasImport(), $request->file('file'));

        return redirect()->route('data-kelas')->with('success', 'Kelas berhasil di import!');
    }

    public function importMahasiswa(Request $request)
    {
        Excel::import(new MahasiswaImport(), $request->file('file'));

        return redirect()->route('data-mahasiswa')->with('success', 'Mahasiswa berhasil di import!');
    }
}
