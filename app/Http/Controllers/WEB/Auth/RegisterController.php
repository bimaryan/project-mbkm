<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'password' => 'required|string|min:8',
            'nama_lengkap' => 'required|string|unique:users,nama_lengkap',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->role_id = 3;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Pendaftaran sudah berhasil.');
    }
}
