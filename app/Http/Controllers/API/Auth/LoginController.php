<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        $captcha = $this->generateCaptcha(6);
        Session::put('captcha', $captcha);

        $user = Mahasiswa::all();
        return response()->json(['captcha' => $captcha, 'user' => $user]);
    }

    private function generateCaptcha($length)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $captcha = '';

        for ($i = 0; $i < $length; $i++) {
            $captcha .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $captcha;
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
            'captcha' => 'required|same:captcha',
        ], [
            'identifier.required' => 'Username/NIM harus diisi',
            'password.required' => 'Kata sandi harus diisi',
            'captcha.required' => 'CAPTCHA harus diisi',
            'captcha.same' => 'CAPTCHA yang dimasukkan salah',
        ]);

        if ($request->captcha != Session::get('captcha')) {
            return response()->json(['error' => 'CAPTCHA tidak valid.'], 422);
        }

        $credentials = $request->only('identifier', 'password');

        if (Auth::guard('admin')->attempt(['username' => $credentials['identifier'], 'password' => $request->password])) {
            $user = Auth::guard('admin')->user();

            if ($user->role_id == '1' || $user->role_id == '2') {
                return response()->json([
                    'message' => 'Login berhasil',
                    'role' => $user->role_id == '1' ? 'Admin' : 'User',
                    'user' => $user
                ]);
            }
            return response()->json(['error' => 'Role tidak ditemukan.'], 403);
        }

        if (Auth::guard('mahasiswa')->attempt(['nim' => $credentials['identifier'], 'password' => $request->password])) {
            $user = Auth::guard('mahasiswa')->user();
            return response()->json([
                'message' => 'Login berhasil',
                'role' => 'Mahasiswa',
                'user' => $user
            ]);
        }

        return response()->json(['error' => 'Login gagal, periksa kredensial Anda.'], 401);
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return response()->json(['message' => 'Logout berhasil.']);
    }
}
