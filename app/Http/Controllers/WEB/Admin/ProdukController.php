<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Kondisi;
use App\Models\Persentase;
use App\Models\Room;
use App\Models\Satuan;
use App\Models\Stock;
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
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'deskripsi' => 'nullable|string|max:1000',
        //     'stock' => 'required|integer|min:1',
        //     'kategori_id' => 'required|exists:kategoris,id',
        //     'satuan_id' => 'required|exists:satuans,id',
        //     'room_id' => 'required|exists:rooms,id',
        // ]);

        // dd($request->all());

        $filePath = $request->file('gambar')->move('uploads/barang', time() . '_' . $request->file('gambar')->getClientOriginalName());

        $barang = Barang::create([
            'users_id' => Auth::id(),
            'name' => $request->name,
            'gambar' => $filePath,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'satuan_id' => $request->satuan_id,
            'room_id' => $request->room_id,
            'kondisi_id' => 4,
        ]);

        Persentase::create([
            'satuans_id' => $request->satuan_id,
            'persentase' => $request->persentase
        ]);

        Stock::create([
            'barang_id' => $barang->id,
            'stock' => $request->stock
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

    public function edit(Request $request, Barang $barang)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string|max:1000',
            'stock' => 'required|integer|min:1',
            'kategori_id' => 'required|exists:kategoris,id',
            'satuan_id' => 'required|exists:satuans,id',
            'room_id' => 'required|exists:rooms,id',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar && file_exists(public_path($barang->gambar))) {
                unlink(public_path($barang->gambar));
            }

            // Simpan gambar baru
            $filePath = $request->file('gambar')->move('uploads/barang', time() . '_' . $request->file('gambar')->getClientOriginalName());
            $barang->gambar = $filePath;
        }

        $barang->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'stock' => $request->stock,
            'kategori_id' => $request->kategori_id,
            'satuan_id' => $request->satuan_id,
            'room_id' => $request->room_id,
        ]);

        return redirect()->route('admin.barang')->with('success', 'Barang berhasil diperbarui!');
    }
}
