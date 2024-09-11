<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|in:' . Role::STAFF . ',' . Role::MAHASISWA
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Pendaftaran sudah berhasil.');
    }
}
