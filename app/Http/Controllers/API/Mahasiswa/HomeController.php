<?php

namespace App\Http\Controllers\API\Mahasiswa;

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
use Illuminate\Http\JsonResponse;

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

        $response = [
            'barangs' => $barangs->map(function ($barang) {
                return [
                    'nama_barang' => $barang->nama_barang,
                    'stok' => $barang->stock->stock,
                    'kategori' => $barang->kategori->kategori,
                    'foto' => $barang->foto,
                ];
            }),
            'kategoris' => $validCategories,
            'barangKosong' => $barangs->isEmpty(),
        ];

        return response()->json($response);
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

        return response()->json([
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

        return response()->json([
            'view' => $view,
            'kelas' => $kelas,
            'stock' => $stock,
            'matkul' => $matkul,
            'ruangan' => $ruangan,
            'dosen' => $dosen,
        ]);
    }

    public function peminjaman(Request $request, Barang $barang, Stock $stock)
    {
        $mahasiswaId = Auth::user()->id;

        $peminjaman = Peminjaman::create([
            'mahasiswa_id' => $mahasiswaId,
            'barang_id' => $barang->id,
            'stock_id' => $stock->id,
            'ruangan_id' => $request->input('ruangan_id'),
            'matkul_id' => $request->input('matkul_id'),
            'dosen_id' => $request->input('dosen_id'),
            'stock_pinjam' => $request->stock_pinjam,
            'QR' => rand(10000, 99999),
            'tgl_pinjam' => $request->input('tgl_pinjam'),
            'waktu_pinjam' => $request->input('waktu_pinjam'),
            'waktu_kembali' => $request->input('waktu_kembali'),
            'keterangan' => $request->input('keterangan'),
            'spo_id' => $request->input('spo_id'),
            'aprovals' => 'Belum',
            'status' => 'Menunggu Persetujuan'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil dibuat dan menunggu persetujuan.',
            'data' => $peminjaman
        ]);
    }

    public function informasi()
    {
        $peminjaman = Peminjaman::with('mahasiswa', 'barang', 'stock', 'ruangan')->paginate('5');

        foreach ($peminjaman as $data) {
            $data->QR = QrCode::size(150)->generate($data->id);
            $data->waktu_pinjam_unix = \Carbon\Carbon::parse($data->waktu_pinjam)->timestamp;
            $data->waktu_kembali_unix = \Carbon\Carbon::parse($data->waktu_kembali)->timestamp;
        }

        return response()->json(['peminjaman' => $peminjaman]);
    }

    public function viewProfile(): JsonResponse
    {
        $mahasiswa = Auth::user();
        $kelas = Kelas::all();
        return response()->json([
            'mahasiswa' => $mahasiswa,
            'kelas' => $kelas
        ]);
    }

    public function editProfile(Request $request, Mahasiswa $mahasiswa): JsonResponse
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'nullable|string',
            'kelas_id' => 'required|exists:kelas,id',
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
            'kelas_id' => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $foto
        ]);

        return response()->json([
            'message' => 'Profile berhasil diperbarui.',
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function viewUbahKataSandi(): JsonResponse
    {
        $mahasiswa = Auth::user();
        return response()->json(['mahasiswa' => $mahasiswa]);
    }

    public function ubahKataSandi(Request $request, Mahasiswa $mahasiswa): JsonResponse
    {
        $request->validate([
            'password' => 'required|string',
            'konfirmasi_password' => 'required|string',
        ]);

        if ($request->password !== $request->konfirmasi_password) {
            return response()->json(['error' => 'Kata sandi dan konfirmasi kata sandi tidak cocok.'], 422);
        }

        $mahasiswa->password = Hash::make($request->password);
        $mahasiswa->save();

        return response()->json(['message' => 'Kata sandi berhasil diperbarui.']);
    }
}
