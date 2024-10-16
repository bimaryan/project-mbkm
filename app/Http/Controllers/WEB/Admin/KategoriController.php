<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function kategori()
    {
        $kategori = Kategori::paginate(5);
        return view('admin.kategori.index', ['kategori' => $kategori]);
    }

    

    public function storeKategori(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
        ]);

        Kategori::create([
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('data-kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function editKategori(Request $request, Kategori $kategori)
    {
        $request->validate([
            'kategori' => 'required|string',
        ]);

        $kategori->update([
            'kategori' => $request->kategori
        ]);

        return redirect()->route('data-kategori')->with('success', 'Kategori updated successfully.');
    }


    public function deleteKategori(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('data-kategori')->with('success', 'Kategori deleted successfully.');
    }
}
