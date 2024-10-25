<?php

namespace App\Http\Controllers\WEB\Staff;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Stock;
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

        $peminjamans = Peminjaman::paginate(5);
        return view('pageStaff.peminjaman.index', compact('peminjamans', 'notifikasiPeminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $peminjaman = Peminjaman::with('stock')->findOrFail($peminjaman->id);

        $currentStock = $peminjaman->stock->stock;

        $approval = $request->input('aprovals');
        $jumlahPinjam = $peminjaman->stock_pinjam;

        if ($approval === 'Ya') {
            $newStock = $currentStock - $jumlahPinjam;

            if ($newStock >= 0) {
                $peminjaman->stock->update([
                    'stock' => $newStock,
                ]);

                $peminjaman->status = 'Dipinjam';
            } else {
                return redirect()->back()->with('error', 'Stok tidak mencukupi.');
            }
        }

        $peminjaman->aprovals = $approval;
        $peminjaman->save();

        return redirect()->back()->with('success', 'Status approval peminjaman berhasil diperbarui.');
    }

    public function kembali(Request $request, Peminjaman $peminjaman)
    {
        $jumlahStockDipinjam = $peminjaman->stock_pinjam;

        $status_pengembalian = $request->input('status_pengembalian');

        if ($status_pengembalian === 'Diserahkan') {
            $stock = Stock::find($peminjaman->stock_id);

            if ($stock) {
                $stock->update([
                    'stock' => $stock->stock + $jumlahStockDipinjam,
                ]);
            } else {
                return redirect()->back()->with('error', 'Stock tidak ditemukan!');
            }
        }

        $peminjaman->update([
            'status_pengembalian' => $status_pengembalian,
            'status' => 'Dikembalikan',
        ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil diperbarui!');
    }
}
