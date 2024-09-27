<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Kondisi;
use App\Models\Room;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        $kategoris = Kategori::all();
        $kondisis = Kondisi::all();
        $satuans = Satuan::all();
        $rooms = Room::all();
        return view('admin.kelolabarang.index', ['barangs' => $barangs, 'kategoris' => $kategoris, 'kondisis' => $kondisis, 'satuans' => $satuans, 'rooms' => $rooms]);
    }

    public function storeBarang(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string|max:1000',
            'stock' => 'required|integer|min:1',
            'kategori_id' => 'required|exists:kategoris,id',
            'satuan_id' => 'required|exists:satuans,id',
            'room_id' => 'required|exists:rooms,id',
            // 'kondisi_id' => 'required|exists:kondisis,id',
        ]);

        $filePath = $request->file('gambar')->move('uploads/barang', time() . '_' . $request->file('gambar')->getClientOriginalName());

        Barang::create([
            'users_id' => Auth::id(),
            'name' => $request->name,
            'gambar' => $filePath,
            'deskripsi' => $request->deskripsi,
            'stock' => $request->stock,
            'kategori_id' => $request->kategori_id,
            'satuan_id' => $request->satuan_id,
            'room_id' => $request->room_id,
            'kondisi_id' => 1,
        ]);

        return redirect()->route('admin.barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function hapus(Barang $barang)
    {
        if ($barang->gambar && file_exists(public_path($barang->gambar))) {
            unlink(public_path($barang->gambar));
        }

        $barang->delete();

        return redirect()->route('admin.barang')->with('success', 'Barang berhasil dihapus!');
    }

    public function edit(Request $request, Barang $barang) {}
}
