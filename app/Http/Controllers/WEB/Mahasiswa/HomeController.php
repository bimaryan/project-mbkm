<?php

namespace App\Http\Controllers\WEB\Mahasiswa;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
                })->paginate(6);
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
            'barangKosong' => $barangKosong
        ]);
    }

    public function viewbarang($name)
    {
        $view = Barang::where('name', $name)->first();

        if (!$view) {
            return redirect('/')->with('error', 'Data barang tidak ditemukan.');
        }

        return view('mahasiswa.detailbarang.index', ['view' => $view]);
    }

    public function informasi()
    {
        return view('mahasiswa.informasi.index');
    }

    public function viewProfile(Request $request, Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.profile.profile', ['mahasiswa' => $mahasiswa]);
    }

    public function editProfile(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'required|string',
            'jenis_kelamin' => 'required|string',
        ], [
            'required.nama' => ':Nama harus diisi',
            'required.email' => ':attribute harus diisi',
            'required.telepon' => ':attribute harus diisi',
            'required.jenis_kelamin' => ':attribute harus diisi',
        ]);

        $mahasiswa->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);
        // dd($mahasiswa->all());

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
