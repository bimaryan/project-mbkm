<?php

namespace App\Http\Controllers\WEB\Mahasiswa;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Peminjaman;
use App\Models\Room;
use App\Models\Ruangan;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $kategori = $request->input('kategori');

        $validCategories = ['Alat', 'Bahan'];

        if ($kategori && $kategori !== 'Semua') {
            if (in_array($kategori, $validCategories)) {
                $barangs = Barang::whereHas('kategori', function ($query) use ($kategori) {
                    $query->where('kategori', $kategori);
                })->take(6)->get();
            } else {
                $barangs = collect();
            }
        } else {
            $barangs = Barang::whereHas('kategori', function ($query) use ($validCategories) {
                $query->whereIn('kategori', $validCategories);
            })->take(6)->get();
        }

        $kategoris = Kategori::whereIn('kategori', $validCategories)->get();

        $barangKosong = $barangs->isEmpty();

        return view('peminjaman.home.index', [
            'barangs' => $barangs,
            'kategoris' => $kategoris,
            'barangKosong' => $barangKosong
        ]);
    }

    public function katalog(Request $request)
    {
        $kategori = $request->input('kategori');

        $validCategories = ['Alat', 'Bahan'];

        if ($kategori && $kategori !== 'Semua') {
            if (in_array($kategori, $validCategories)) {
                $barangs = Barang::whereHas('kategori', function ($query) use ($kategori) {
                    $query->where('kategori', $kategori);
                })->paginate(6)->appends(['kategori' => $kategori]);
            } else {
                $barangs = collect();
            }
        } else {
            $barangs = Barang::whereHas('kategori', function ($query) use ($validCategories) {
                $query->whereIn('kategori', $validCategories);
            })->paginate(6);
        }

        $kategoris = Kategori::whereIn('kategori', $validCategories)->get();

        $barangKosong = $barangs->isEmpty();

        return view('peminjaman.katalog.index', [
            'barangs' => $barangs,
            'kategoris' => $kategoris,
            'barangKosong' => $barangKosong,
            'kategoriTerpilih' => $kategori
        ]);
    }

    public function viewbarang($nama_barang)
    {
        $view = Barang::where('nama_barang', $nama_barang)->first();
        $kelas = Kelas::all();
        $dosen = Dosen::all();
        $matkul = MataKuliah::all();
        $stock = Stock::where('barang_id', $view->id)->first();
        $ruangan = Ruangan::all();
        $room = Ruangan::all();

        if (!$view) {
            return redirect('/')->with('error', 'Data barang tidak ditemukan.');
        }

        return view('mahasiswa.detailbarang.index', [
            'view' => $view,
            'kelas' => $kelas,
            'stock' => $stock,
            'matkul' => $matkul,
            'ruangan' => $ruangan,
            'dosen' => $dosen
        ]);
    }

    public function peminjaman(Request $request, Barang $barang, Stock $stock, MataKuliah $matkul)
    {
        $mahasiswaId = Auth::user()->id;

        Peminjaman::create([
            'mahasiswa_id' => $mahasiswaId,
            'barang_id' => $barang->id,
            'stock_id' => $stock->id,
            'ruangan_id' => $request->input('ruangan_id'),
            'matkul_id' => $request->input('matkul_id'),
            'dosen_id' => $request->input('dosen_id'),
            'stock_pinjam' => $request->input('jumlah_pinjam'),
            'QR' => rand(10000, 99999),
            'tgl_pinjam' => $request->input('tgl_pinjam'),
            'waktu_pinjam' => $request->input('waktu_pinjam'),
            'waktu_kembali' => $request->input('waktu_kembali'),
            'keterangan' => $request->input('keterangan'),
            'aprovals' => 'Belum',
            'status' => 'Menunggu Persetujuan'
        ]);

        return redirect()->route('mahasiswa.informasi')->with('success', 'Peminjaman berhasil dibuat dan menunggu persetujuan.');
    }

    public function informasi()
    {
        $user = Auth::user();

        $peminjaman = Peminjaman::with(['mahasiswa', 'barang', 'stock', 'ruangan'])
            ->whereHas('mahasiswa', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->paginate(5);

        foreach ($peminjaman as $data) {
            $data->QR = QrCode::size(150)->generate($data->id);
            $data->waktu_pinjam_unix = \Carbon\Carbon::parse($data->waktu_pinjam)->timestamp;
            $data->waktu_kembali_unix = \Carbon\Carbon::parse($data->waktu_kembali)->timestamp;
        }

        return view('mahasiswa.informasi.index', compact('peminjaman'));
    }

    public function riwayat()
    {
        $user = Auth::user();

        $riwayat = Peminjaman::with(['mahasiswa', 'barang', 'stock', 'ruangan'])
            ->whereHas('mahasiswa', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->paginate(5);

        foreach ($riwayat as $data) {
            $data->QR = QrCode::size(150)->generate($data->id);
            $data->waktu_pinjam_unix = \Carbon\Carbon::parse($data->waktu_pinjam)->timestamp;
            $data->waktu_kembali_unix = \Carbon\Carbon::parse($data->waktu_kembali)->timestamp;
        }

        return view('mahasiswa.riwayat.index', compact('riwayat'));
    }

    
}
