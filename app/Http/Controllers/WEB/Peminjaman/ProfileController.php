<?php

namespace App\Http\Controllers\WEB\Peminjaman;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function viewProfile()
    {
        $user = Auth::user();
        $kelas = Kelas::all();

        if ($user instanceof Mahasiswa) {
            return view('peminjaman.profile.mahasiswa.profile', ['mahasiswa' => $user], ['kelas' => $kelas]);
        } elseif ($user instanceof Dosen) {
            return view('peminjaman.profile.dosen.profile', ['dosen' => $user]);
        }
        return abort(404, 'Halaman tidak ditemukan');
    }

    public function editProfile(Request $request)
    {
        $user = Auth::user();

        if ($user instanceof Dosen) {
            $request->validate([
                'nama' => 'required|string',
                'nip' => 'required|string',
                'username' => 'required|string',
                'email' => 'required|email',
                'telepon' => 'nullable|string',
                'jenis_kelamin' => 'nullable|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Jika ada file foto di-request
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($user->foto && File::exists(public_path($user->foto))) {
                    File::delete(public_path($user->foto));
                }

                // Simpan foto baru
                $foto = $request->file('foto')->storeAs('foto_profile', time() . '_' . $request->file('foto')->getClientOriginalName());
            } else {
                $foto = $user->foto; // Tetap gunakan foto lama
            }

            // Update data Dosen
            $user->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'username' => $request->username,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'foto' => $foto,
            ]);

            return redirect()->route('profile.dosen')
                ->with('success', 'Profil berhasil diperbarui!');
        } elseif ($user instanceof Mahasiswa) {
            $request->validate([
                'nama' => 'required|string',
                'nim' => 'required|string',
                'email' => 'required|email',
                'telepon' => 'nullable|string',
                'kelas_id' => 'required|exists:kelas,id',
                'jenis_kelamin' => 'nullable|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Jika ada file foto di-request
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($user->foto && File::exists(public_path($user->foto))) {
                    File::delete(public_path($user->foto));
                }

                // Simpan foto baru
                $foto = $request->file('foto')->storeAs('foto_profile', time() . '_' . $request->file('foto')->getClientOriginalName());
            } else {
                $foto = $user->foto; // Tetap gunakan foto lama
            }

            // Update data Mahasiswa
            $user->update([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'kelas_id' => $request->kelas_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'foto' => $foto,
            ]);

            return redirect()->route('profile.mahasiswa') // Ubah ke route view mahasiswa
                ->with('success', 'Profil berhasil diperbarui!');
        }

        // Jika bukan Dosen atau Mahasiswa
        return abort(404, 'Halaman tidak ditemukan');
    }

    public function viewUbahKataSandi()
    {
        $user = Auth::user();
        if ($user instanceof Mahasiswa) {
            return view('peminjaman.profile.mahasiswa.ubahsandi', ['mahasiswa' => $user]);
        } elseif ($user instanceof Dosen) {
            return view('peminjaman.profile.dosen.ubahsandi', ['dosen' => $user]);
        }
    }

    public function ubahKataSandi(Request $request, Mahasiswa $mahasiswa, Dosen $dosen)
    {
        $user = Auth::user();

        if ($user instanceof Mahasiswa) {
            $request->validate([
                'password' => 'required|string',
                'konfirmasi_password' => 'required|string',
            ]);

            $mahasiswa->password = Hash::make($request->password);
            $mahasiswa->save();
        } elseif ($user instanceof Dosen) {
            $request->validate([
                'password' => 'required|string',
                'konfirmasi_password' => 'required|string',
            ]);

            $dosen->password = Hash::make($request->password);
            $dosen->save();
        }

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui!');
    }
}
