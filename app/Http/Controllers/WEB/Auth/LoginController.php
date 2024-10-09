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

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ], [
            'identifier.required'=> 'Username/NIM harus diisi',
            'password.required'=> 'Kata sandi harus diisi',
        ]);

        // dd($request->all());
        $credentials = $request->only('identifier', 'password');

        if (Auth::guard('admin')->attempt(['username' => $credentials['identifier'], 'password' => $request->password])) {

            if (Auth::guard('admin')->user()->role->nama == 'Admin') {
                return redirect()->route('dashboard');
            }elseif (Auth::guard('admin')->user()->role->nama == 'Staff') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withErrors(['errors'])->withInput();
            } 
                return redirect()->back()->withErrors(['email' => 'Email atau password salah'])->withInput();
            }
        }

        if (Auth::guard('mahasiswa')->attempt(['nim' => $credentials['identifier'], 'password' => $request->password])) {
            return redirect()->route('mahasiswa');
        }

        return redirect()->back()->withErrors(['errors'],)->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
