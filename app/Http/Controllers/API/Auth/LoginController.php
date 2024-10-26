<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Mahasiswa;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'identifier' => 'required',
            'password' => 'required|min:6',
        ], [
            'identifier.required' => 'Username/NIM harus diisi',
            'password.required' => 'Kata sandi harus diisi',
        ]);

        // Credentials for the mahasiswa guard
        $credentials = $request->only('identifier', 'password');

        // Attempt to log in the user using the 'mahasiswa' guard
        if (Auth::guard('mahasiswa')->attempt(['nim' => $credentials['identifier'], 'password' => $credentials['password']])) {
            $user = Auth::guard('mahasiswa')->user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Berhasil masuk sebagai mahasiswa',
                'user' => $user,
                'token' => $token,
            ]);
        }

        return response()->json(['error' => 'Kredensial tidak valid.'], 401);
    }

    public function logout()
    {
        Auth::guard('mahasiswa')->logout(); // Log out the user from the 'mahasiswa' guard
        Session::flush(); // Clear the session
        return response()->json(['message' => 'Logout berhasil.']);
    }
}
