<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\DokumenSpo;
use App\Models\Peminjaman;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DokumenSpoController extends Controller
{
    public function dokumenSPO()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $query = Admin::query();
        $users = $query->paginate(5);
        $role = Role::all();

        $dokumen = DokumenSpo::paginate(5);
        return view('pageAdmin.dokumenspo.index', ['dokumen' => $dokumen], ['user' => $users, 'notifikasiPeminjaman' => $notifikasiPeminjaman], ['role' => $role]);
    }

    public function storeSPO(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        // Simpan file dan buat nama unik
        $originalName = $request->file('file')->getClientOriginalName();
        $fileName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
        $file_path = $request->file('file')->storeAs('dokumen-spo', $fileName, 'public');

        // Pastikan path file berhasil disimpan
        if (!$file_path) {
            return redirect()->back()->with('error', 'Gagal menyimpan file!');
        }

        DokumenSpo::create([
            'nama_dokumen' => $request->nama_dokumen,
            'file' => $file_path,
        ]);

        return redirect()->route('data-spo')->with('success', 'Dokumen SPO berhasil ditambahkan');
    }


    public function downloadSPO(DokumenSpo $dokumen)
    {
        // Debug: Cek nilai atribut file
        Log::info('Atribut file:', ['file' => $dokumen->file]);

        // Periksa apakah file memiliki path yang valid
    if (empty($dokumen->file)) {
        return redirect()->back()->with('error', 'Path file tidak valid!');
    }

    // Debug: Cek keberadaan file di storage
    if (!Storage::disk('public')->exists($dokumen->file)) {
        Log::error('File tidak ditemukan di storage!', ['file' => $dokumen->file]);
        return redirect()->back()->with('error', 'File tidak ditemukan!');
    }

    // Unduh file
    try {
        $filePath = Storage::disk('public')->path($dokumen->file);
        Log::info('Mengunduh file:', ['path' => $filePath]);
        return response()->download($filePath);
    } catch (\Exception $e) {
        Log::error('Gagal mengunduh file:', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunduh file.');
    }
    }


    public function deleteSPO(DokumenSpo $dokumen)
    {
        $dokumen->delete();
        return redirect()->route('data-spo')->with('success', 'Dokumen SPO berhasil dihapus!');
    }
}
