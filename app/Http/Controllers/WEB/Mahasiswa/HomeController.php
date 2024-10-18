<?php

namespace App\Http\Controllers\WEB\Mahasiswa;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Peminjaman;
use App\Models\Room;
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

        return view('mahasiswa.home.index', [
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

        return view('mahasiswa.katalog.index', [
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
        $matkul = MataKuliah::all();
        $stock = Stock::where('barang_id', $view->id)->first();
        $room = Room::all();

        if (!$view) {
            return redirect('/')->with('error', 'Data barang tidak ditemukan.');
        }

        return view('mahasiswa.detailbarang.index', [
            'view' => $view,
            'kelas' => $kelas,
            'stock' => $stock,
            'matkul' => $matkul,
            'room' => $room
        ]);
    }

    public function peminjaman(Request $request, Barang $barang, Stock $stock, MataKuliah $matkul)
    {
        $mahasiswaId = Auth::user()->id;

        $currentStock = $stock->stock;
        $jumlahPinjam = $request->input('jumlah_pinjam');

        if ($currentStock < $jumlahPinjam) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi untuk peminjaman.');
        }

        Peminjaman::create([

            'mahasiswa_id' => $mahasiswaId,
            'barang_id' => $barang->id,
            'stock_id' => $stock->id,
            'rooms_id' => $request->input('rooms_id'),
            'matkul_id' => $request->input('matkul_id'),
            'stock_pinjam' => $request->input('jumlah_pinjam'),
            'QR' => rand(10000, 99999),
            'tgl_pinjam' => $request->input('tgl_pinjam'),
            'waktu_pinjam' => $request->input('waktu_pinjam'),
            'waktu_kembali' => $request->input('waktu_kembali'),
            'keterangan' => $request->input('keterangan'),
            'spo_id' => $request->input('spo_id'),
            'aprovals' => 'Belum',
            'status' => 'Menunggu Persetujuan'
        ]);

        $stock->update([
            'stock' => $currentStock - $jumlahPinjam,
        ]);

        return redirect()->route('mahasiswa.informasi')->with('success', 'Peminjaman berhasil dibuat dan menunggu persetujuan.');
    }

    public function informasi()
    {
        $peminjaman = Peminjaman::with('mahasiswa', 'barang', 'stock')->paginate('5');

        foreach ($peminjaman as $data) {
            $data->QR = QrCode::size(150)->generate($data->id);
            $data->waktu_pinjam_unix = \Carbon\Carbon::parse($data->waktu_pinjam)->timestamp;
            $data->waktu_kembali_unix = \Carbon\Carbon::parse($data->waktu_kembali)->timestamp;
        }

        return view('mahasiswa.informasi.index', compact('peminjaman'));
    }

    public function viewProfile(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.profile.profile', ['mahasiswa' => $mahasiswa]);
    }

    public function editProfile(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'required.nama' => ':Nama harus diisi',
            'required.email' => ':attribute harus diisi',
            'required.telepon' => ':attribute harus diisi',
            'required.jenis_kelamin' => ':attribute harus diisi',
        ]);

        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto && File::exists(public_path($mahasiswa->foto))) {
                File::delete(public_path($mahasiswa->foto));
            }

            $foto = $request->file('foto')->move('foto_mahasiswa', time() . '_' . $request->file('foto')->getClientOriginalName());
        } else {
            $foto = $mahasiswa->foto;
        }

        $mahasiswa->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $foto
        ]);

        return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui.');
    }

    public function viewUbahKataSandi(Request $request, Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.profile.ubahsandi', ['mahasiswa' => $mahasiswa]);
    }

    public function ubahKataSandi(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'password' => 'required|string',
            'konfirmasi_password' => 'required|string',
        ]);

        // dd($request->all());

        // Update password pengguna
        $mahasiswa->password = Hash::make($request->password);
        $mahasiswa->save();

        return redirect()->route('profile')->with('success', 'Kata sandi berhasil diperbarui.');
    }
}
