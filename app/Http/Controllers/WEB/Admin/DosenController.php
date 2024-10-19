<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function dosen()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $dosen = Dosen::paginate(5);

        return view('admin.pengguna.dosen.index', compact('dosen', 'notifikasiPeminjaman'));
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required',
            'nip' => 'required',
        ], [
            'nama_dosen.required' => 'Nama harus di isi',
            'nip.required' => 'NIP harus di isi',
        ]);

        DB::transaction(function () use ($request) {
            $mahasiswa = new Dosen();
            $mahasiswa->nama_dosen = $request->nama_dosen;
            $mahasiswa->nip = $request->nip;
            $mahasiswa->save();
        });

        return redirect()->route('data-dosen')->with('success', 'Pendaftaran sudah berhasil.');
    }

    public function editDosen(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama_dosen' => 'required',
            'nip' => 'required',
        ]);

        $dosen->update([
            'nama_dosen' => $request->nama_dosen,
            'nip' => $request->nip,
        ]);


        return redirect()->route('data-dosen')->with('success', 'Pengguna berhasil di diperbarui!');
    }

    public function deleteDosen(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('data-dosen')->with('success', 'Mahasiswa berhasil di hapus!');
    }
}
