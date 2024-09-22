<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function users()
    {
        $user = User::all();
        return view('admin.users.index', ['user' => $user]);
    }

    public function addUsers()
    {
        return view('admin.users.create');
    }

    public function storeUsers(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'nama_lengkap' => 'required|string',
            'telepon' => 'nullable|string|max:15',
            'keterangan' => 'nullable|string',
            'password' => 'required|string|min:8',
            'role_id' => 'required|in:' . Role::DOSEN . ',' . Role::MAHASISWA
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->telepon = $request->telepon;
        $user->keterangan = $request->keterangan;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Pendaftaran sudah berhasil.');
    }
}
