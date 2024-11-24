<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        $captcha = $this->generateCaptcha(6);
        Session::put('captcha', $captcha);
        return view("auth.login", ['captcha' => $captcha]);
    }


    private function generateCaptcha($length)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $captcha = '';

        // Menghasilkan CAPTCHA
        for ($i = 0; $i < $length; $i++) {
            $captcha .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $captcha;
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required|min:6',
            'captcha' => 'required|same:captcha',
        ], [
            'identifier.required' => 'Username/NIM harus diisi',
            'password.required' => 'Kata sandi harus diisi',
            'captcha.required' => 'CAPTCHA harus diisi',
            'captcha.same' => 'CAPTCHA yang dimasukkan salah',
        ]);

        if ($request->captcha != Session::get('captcha')) {
            return redirect()->back()->with('error', 'wrong_captcha')->withInput();
        }

        $credentials = $request->only('identifier', 'password');

        if (Auth::guard('admin')->attempt(['username' => $credentials['identifier'], 'password' => $request->password])) {

            $role = Auth::guard('admin')->user()->role_id;
            if ($role == 1 || $role == 2) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()-with('error', 'wrong_credentials')->withInput();
            }

        }

        if (Auth::guard('mahasiswa')->attempt(['nim' => $credentials['identifier'], 'password' => $request->password])) {
            return redirect()->route('home');
        }

        if (Auth::guard('dosen')->attempt(['username' => $credentials['identifier'], 'password' => $request->password])) {
            return redirect()->route('home');
        }

        if (empty($request->identifier) || empty($request->password)) {
            return redirect()->back()->with('error', 'empty_fields')->withInput();

        }

        return redirect()->back()->with('error', 'wrong_credentials')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
