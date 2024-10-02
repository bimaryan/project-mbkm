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
        $users = User::paginate(5);
        return view('admin.users.index', ['user' => $users]);
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
            'role_id' => 'required|in:' . Role::DOSEN . ',' . Role::MAHASISWA,
        ]);

        \DB::transaction(function () use ($request) {
            $user = new User();
            $user->name = $request->name;
            $user->nama_lengkap = $request->nama_lengkap;
            $user->telepon = $request->telepon;
            $user->keterangan = $request->keterangan;
            $user->role_id = $request->role_id;
            $user->password = Hash::make($request->password);
            $user->save();
        });

        return redirect()->route('admin.users')->with('success', 'Pendaftaran sudah berhasil.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Fetch the user by ID
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name,' . $id, // Allow current name
            'nama_lengkap' => 'required|string',
            'telepon' => 'nullable|string|max:15',
            'keterangan' => 'nullable|string',
            'role_id' => 'required|in:' . Role::DOSEN . ',' . Role::MAHASISWA,
        ]);

        \DB::transaction(function () use ($request, $id) {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->nama_lengkap = $request->nama_lengkap;
            $user->telepon = $request->telepon;
            $user->keterangan = $request->keterangan;
            $user->role_id = $request->role_id;

            // Update password only if provided
            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'string|min:8', // Validate new password
                ]);
                $user->password = Hash::make('@KEP2024');
            }

            $user->save();
        });

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        \DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);
            $user->delete();
        });

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
