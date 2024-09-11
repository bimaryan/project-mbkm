<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role_id == Role::ADMIN) {
                return redirect()->route('admin.users');
            } elseif ($user->role_id == Role::STAFF) {
                return redirect()->route('staff');
            } elseif ($user->role_id == Role::MAHASISWA) {
                return redirect()->route('mahasiswa');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
