<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::all();
        return view('admin.kelolakategori.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.kelolakategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
        ]);

        Kategori::create([
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.kelolakategoriindex')->with('success', 'Kategori berhasil ditambahkan');
    }
}
