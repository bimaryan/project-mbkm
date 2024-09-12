<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function alatIndex()
    {
        $alats = Alat::all();
        return view('admin.kelolaproduk.alat.index', ['alats' => $alats]);
    }

    public function alatCreate()
    {
        return view('admin.kelolaproduk.alat.create');
    }

    public function storeAlat(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ini!');
        }

        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'stock' => 'required|integer|min:1',
            'status' => 'required|in:Tersedia,Dipinjam',
        ]);

        Alat::create([
            'users_id' => auth()->id(),
            'nama_alat' => $request->nama_alat,
            'deskripsi' => $request->deskripsi,
            'stock' => $request->stock,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Alat berhasil ditambahkan!');
    }
}
