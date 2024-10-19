<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Barang;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $totalPeminjaman = Peminjaman::count();
        $totalMahasiswa = Mahasiswa::count();
        $totalAlat = Barang::where('kategori_id', 1)->count();
        $totalBahan = Barang::where('kategori_id', 2)->count();

        $peminjamanTerakhir30Hari = Peminjaman::where('tgl_pinjam', '>=', now()->subDays(30))->count();

        $persentasePeminjaman = ($totalPeminjaman > 0) ? ($peminjamanTerakhir30Hari / $totalPeminjaman) * 100 : 0;

        $totalDikembalikan = Peminjaman::where('status', 'Dikembalikan')->count();

        return view('admin.dashboard.index', compact('totalPeminjaman', 'totalMahasiswa', 'totalAlat', 'totalBahan', 'persentasePeminjaman', 'totalDikembalikan', 'peminjamanTerakhir30Hari'));
    }

    public function adminAndStaff(Request $request)
    {
        $query = Admin::query();

        $users = $query->paginate(5);
        $role = Role::all();

        return view('admin.pengguna.adminandstaff.index', ['user' => $users], ['role' => $role]);
    }

    public function storeAdminAndStaff(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'username' => 'required',
            'password' => 'required|string',
            'role_id' => 'required|exists:roles,id',
            // 'foto'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // $filePath = $request->file('foto')->move('uploads/photo', time() . '-' . $request->file('foto')->getClientOriginalName());

        // dd($request->all());

        Admin::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            // 'foto' => $filePath,
        ]);


        return redirect()->route('data-admin-dan-staff')->with('success', 'Pendaftaran berhasil!');
    }

    public function editAdminDanStaff(Request $request, Admin $user)
    {
        $role = Role::all();

        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'username' => 'required',
            'password' => 'required|string',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);


        return redirect()->route('data-admin-dan-staff', ['role' => $role])->with('success', 'Pengguna berhasil di diperbarui!');
    }

    public function deleteAdminDanStaff(Admin $user)
    {
        // $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('data-admin-dan-staff')->with('success', 'Kelas berhasil di hapus!');
    }
}
