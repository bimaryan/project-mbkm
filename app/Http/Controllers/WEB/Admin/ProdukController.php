<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Kondisi;
use App\Models\Persentase;
use App\Models\Satuan;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function barang(Request $request)
    {
        $query = Barang::query();

        if ($request->has('nama_barang') && $request->name != '') {
            $query->where('nama_barang', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->has('kondisi') && $request->kondisi != '') {
            $query->whereHas('stock', function ($q) use ($request) {
                if ($request->kondisi == 'habis') {
                    $q->where('stock', 0);
                } elseif ($request->kondisi == 'terpakai') {
                    $q->where('is_stock_reduced', true);
                } elseif ($request->kondisi == 'hilang') {
                    $q->where('is_stock_lost', true);
                } else {
                    $q->where('stock', '>', 0);
                }
            });
        }

        if ($request->has('stock') && $request->stock != '') {
            $query->whereHas('stock', function ($q) use ($request) {
                $q->where('stock', '>=', $request->stock);
            });
        }

        if ($request->has('satuan_id') && $request->satuan_id != '') {
            $query->where('satuan_id', $request->satuan_id);
        }

        $barangs = $query->paginate(5);

        $kategoris = Kategori::all();
        $kondisis = Kondisi::all();
        $satuans = Satuan::all();
        $stocks = Stock::all();

        return view('admin.barang.index', compact('barangs', 'kategoris', 'kondisis', 'satuans', 'stocks'));
    }

    public function storeBarang(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stock' => 'required|integer|min:1',
            'kategori_id' => 'required|exists:kategoris,id',
            'satuan_id' => 'required|exists:satuans,id',
        ], [
            'nama_barang.required'=> 'Nama barang harus diisi',
            'stock.required'=> 'Stok harus diisi',
            'stock.min'=> 'Stok minimal 1',
        ]);

        
        $filePath = $request->file('foto')->move('uploads/barang', time() . '_' . $request->file('foto')->getClientOriginalName());
        // dd($request->all());
        
        $barang = Barang::create([
            'nama_barang' => $request->nama_barang,
            'foto' => $filePath,
            'kategori_id' => $request->kategori_id,
            'satuan_id' => $request->satuan_id,
            'kondisi_id' => 4,
        ]);

        Persentase::create([
            'satuans_id' => $request->satuan_id,
        ]);

        Stock::create([
            'barang_id' => $barang->id,
            'stock' => $request->stock
        ]);

        return redirect()->route('data-barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function deleteBarang(Barang $barang)
    {
        if ($barang->foto && file_exists(public_path($barang->foto))) {
            unlink(public_path($barang->foto));
        }

        $barang->delete();

        return redirect()->route('data-barang')->with('success', 'Barang berhasil dihapus!');
    }

    public function editBarang(Request $request, Barang $barang,)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'satuan_id' => 'required|exists:satuans,id',
        ]);
        
        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($barang->foto && file_exists(public_path($barang->foto))) {
                unlink(public_path($barang->foto));
            }
            
            // Simpan gambar baru
            $filePath = $request->file('foto')->move('uploads/barang', time() . '_' . $request->file('foto')->getClientOriginalName());
            $barang->foto = $filePath;
        }
        // dd($barang->all());
        
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'satuan_id' => $request->satuan_id,
            'foto' => $request->hasFile('foto') ? $filePath : $barang->foto,
        ]);

        $barang->stock->update([
            'stock' => $request->stock,
        ]);

        return redirect()->route('data-barang')->with('success', 'Barang berhasil diperbarui!');
    }
}
