<?php

namespace App\Http\Controllers\WEB\Peminjaman;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $users = Auth::user();

        $notifikasiKeranjang = Keranjang::with(['mahasiswa', 'dosen', 'barang'])
            ->where('users_id', $users->id)
            ->latest()
            ->take(5)
            ->get();

        $keranjang = Keranjang::with('barang')
            ->where('users_id', $users->id)
            ->latest()
            ->get();

        return view('peminjaman.keranjang.index', compact('keranjang', 'notifikasiKeranjang'));
    }

    public function store(Request $request, Barang $barang)
    {
        // Ambil ID mahasiswa yang sedang login
        $users = Auth::user()->id;

        // Ambil semua barang di keranjang untuk mahasiswa ini
        $totalBarang = Keranjang::where('users_id', $users)->count();

        // Cek apakah total barang di keranjang sudah mencapai batas maksimum
        if ($totalBarang >= 10) {
            return redirect()->route('viewbarang', ['nama_barang' => $barang->nama_barang])
                ->with('error', 'Anda hanya dapat menambahkan maksimal 10 barang ke keranjang.');
        }

        // Cek apakah barang sudah ada di keranjang
        $keranjang = Keranjang::where('users_id', $users)
            ->where('barang_id', $barang->id)
            ->first();

        if ($keranjang) {
            // Jika barang sudah ada di keranjang, tambahkan jumlahnya
            $newStock = $keranjang->stock_pinjam + $request->input('stock_pinjam');

            // Pastikan total stock_pinjam tidak melebihi batas maksimum
            if ($newStock > 10) {
                return redirect()->route('viewbarang', ['nama_barang' => $barang->nama_barang])
                    ->with('error', 'Jumlah total barang tidak boleh melebihi 10.');
            }

            $keranjang->stock_pinjam = $newStock;
            $keranjang->save();
        } else {
            // Jika barang belum ada di keranjang, tambahkan entri baru
            $stockPinjam = $request->input('stock_pinjam');

            // Pastikan stock_pinjam tidak melebihi batas maksimum
            if ($stockPinjam > 10) {
                return redirect()->route('viewbarang', ['nama_barang' => $barang->nama_barang])
                    ->with('error', 'Jumlah barang yang ditambahkan tidak boleh lebih dari 10.');
            }

            Keranjang::create([
                'users_id' => $users,
                'barang_id' => $barang->id,
                'stock_pinjam' => $stockPinjam,
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('katalog')
            ->with('success', 'Barang berhasil ditambahkan ke keranjang.');
    }

    public function destroy(Keranjang $keranjang)
    {
        // Pastikan mahasiswa hanya dapat menghapus barang miliknya
        if ($keranjang->users_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan');
        }

        $keranjang->delete();

        return redirect()->route('keranjang')
            ->with('success', 'Barang berhasil dihapus dari keranjang.');
    }
}
