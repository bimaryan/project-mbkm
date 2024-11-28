<?php

namespace App\Http\Controllers\WEB\Peminjaman;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Keranjang;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function viewProfile()
    {
        $kelas = Kelas::all();

<<<<<<< HEAD
        $notifikasiKeranjang = Keranjang::with(['mahasiswa', 'dosen', 'barang'])
            ->where('users_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        if ($user instanceof Mahasiswa) {
            return view('peminjaman.profile.mahasiswa.profile', ['mahasiswa' => $user, 'notifikasiKeranjang' => $notifikasiKeranjang], ['kelas' => $kelas]);
        } elseif ($user instanceof Dosen) {
            return view('peminjaman.profile.dosen.profile', ['dosen' => $user, 'notifikasiKeranjang' => $notifikasiKeranjang]);
=======
        if (Auth::guard('dosen')->check()) {
            $user = Auth::guard('dosen')->user();
        } elseif (Auth::guard('mahasiswa')->check()) {
            $user = Auth::guard('mahasiswa')->user();
        } else {
            abort(404, 'User not found');
>>>>>>> 2dd4ed6370eb5dbf1a73259d9543443952af7f68
        }

        return view('peminjaman.profile.edit', compact('user', 'kelas'));
    }

    public function update(Request $request)
    {
        if (Auth::guard('dosen')->check()) {
            $user = Auth::guard('dosen')->user();

            $request->validate([
                'nama' => 'required',
                'nip' => 'required',
                'username' => 'required|unique:dosens,username,' . $user->id,
                'email' => 'required|string|email',
                'telepon' => 'required',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $user->username = $request->username;
            $user->nip = $request->nip;
        } elseif (Auth::guard('mahasiswa')->check()) {
            $user = Auth::guard('mahasiswa')->user();

            $request->validate([
                'nama' => 'required',
                'nim' => 'required|unique:mahasiswas,nim,' . $user->id,
                'kelas_id' => 'required|exists:kelas,id',
                'email' => 'required|string|email',
                'telepon' => 'required',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $user->nim = $request->nim;
            $user->kelas_id = $request->kelas_id;
        } else {
            abort(403, 'Unauthorized');
        }

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->telepon = $request->telepon;
        $user->jenis_kelamin = $request->jenis_kelamin;

        if ($request->hasFile('foto')) {
            if ($user->foto !== null) {
                File::delete(public_path('foto/' . $user->foto));
            }
            $image = $request->file('foto');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('foto'), $name);
            $user->foto = $name;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }


    public function viewUbahKataSandi()
    {
<<<<<<< HEAD
        $user = Auth::user();

        $notifikasiKeranjang = Keranjang::with(['mahasiswa', 'dosen', 'barang'])
            ->where('users_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        if ($user instanceof Mahasiswa) {
            return view('peminjaman.profile.mahasiswa.ubahsandi', ['mahasiswa' => $user]);
        } elseif ($user instanceof Dosen) {
            return view('peminjaman.profile.dosen.ubahsandi', ['dosen' => $user, 'notifikasiKeranjang' => $notifikasiKeranjang]);
=======
        if (Auth::guard('dosen')->check()) {
            $user = Auth::guard('dosen')->user();
        } elseif (Auth::guard('mahasiswa')->check()) {
            $user = Auth::guard('mahasiswa')->user();
        } else {
            abort(404, 'User not found');
>>>>>>> 2dd4ed6370eb5dbf1a73259d9543443952af7f68
        }

        return view('peminjaman.profile.ubahsandi', compact('user'));
    }

    public function ubahKataSandi(Request $request, Mahasiswa $mahasiswa, Dosen $dosen)
    {
        if (Auth::guard('dosen')->check()) {
            $user = Auth::guard('dosen')->user();
            $request->validate([
                'password' => 'required|string',
                'konfirmasi_password' => 'required|string',
            ]);

            $user->password = Hash::make($request->password);
            $user->save();
        } elseif (Auth::guard('mahasiswa')->check()) {
            $user = Auth::guard('mahasiswa')->user();
            $request->validate([
                'password' => 'required|string',
                'konfirmasi_password' => 'required|string',
            ]);

            $user->password = Hash::make($request->password);
            $user->save();
        } else {
            abort(404, 'User not found');
        }

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui!');
    }
}
