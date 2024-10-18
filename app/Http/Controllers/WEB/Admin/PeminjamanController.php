<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::all();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $peminjaman->aprovals = $request->input('aprovals');
        $peminjaman->status = 'Dipinjam';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Status approval peminjaman berhasil diperbarui.');
    }
}
