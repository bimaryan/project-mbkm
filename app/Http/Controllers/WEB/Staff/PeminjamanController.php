<?php

namespace App\Http\Controllers\WEB\Staff;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $peminjamans = Peminjaman::all();
        return view('pageStaff.peminjaman.index', compact('peminjamans', 'notifikasiPeminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $peminjaman->aprovals = $request->input('aprovals');
        $peminjaman->status = 'Dipinjam';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Status approval peminjaman berhasil diperbarui.');
    }
}
