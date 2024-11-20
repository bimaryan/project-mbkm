<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Dosen;
use App\Models\Peminjaman;
use App\Imports\DosenImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

use function Laravel\Prompts\password;

class DosenController extends Controller
{

    public function importDosen(Request $request) {
        $request->validate([
            "file"=> "required|mimes:xlsx,xls,csv",
        ]);

        Excel::import(new DosenImport, $request->file('file'));
        return redirect()->back()->with('success','Dosen berhasil di import');
    }


    public function dosen()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $dosen = Dosen::paginate(5);

        return view('pageAdmin.pengguna.dosen.index', compact('dosen', 'notifikasiPeminjaman'));
    }

    public function storeDosen(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'username' => 'required',

        ], [
            'nama.required' => 'Nama harus di isi',
            'nip.required' => 'NIP harus di isi',
            'username.required' => 'Username harus di isi',
        ]);

        $validatedData['password'] = Hash::make('polindra');

        Dosen::create($validatedData);

        return redirect()->route('data-dosen')->with('success', 'Pendaftaran sudah berhasil.');
    }

    public function editDosen(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'username' => 'required',
        ]);

        $dosen->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'username' => $request->username,
        ]);


        return redirect()->route('data-dosen')->with('success', 'Pengguna berhasil di diperbarui!');
    }

    public function deleteDosen(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('data-dosen')->with('success', 'Mahasiswa berhasil di hapus!');
    }
}
