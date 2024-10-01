<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        $satuan = Satuan::all();
        return view('admin.kelolasatuan.index', compact('satuan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'satuan' => 'required|string'
        ]);

        Satuan::create([
            'satuan' => $request->satuan
        ]);

        return redirect()->route('admin.satuan')->with('success', 'Satuan berhasil ditambahkan!');
    }

    public function hapus(Request $request, Satuan $satuan)
    {
        $satuan->delete();

        return redirect()->route('admin.satuan')->with('success', 'Satuan berhasil dihapus!');
    }

    public function edit(Request $request, Satuan $satuan)
    {
        $request->validate([
            'satuan' => 'required|string'
        ]);

        $satuan->update([
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('admin.satuan')->with('success', 'Satuan berhasil diperbarui!');
    }
}
