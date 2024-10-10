<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetSuccess;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:mahasiswas,email',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => carbon::now()
        ]);

        Mail::send('auth.email', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->route('login')->with('success', 'Kami telah mengirimkan link untuk mereset kata sandi Anda melalui email!');
    }

    public function resetPassword($token)
    {
        session(['password_reset_token' => $token]);
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPasswordProcess(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|string',
                'token' => 'required|string',
            ],
            [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email harus valid',
            ]
        );

        $token = session('password_reset_token');

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $token,
            ])->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token or email!');
        }

        $mahasiswa = Mahasiswa::where('email', $request->email)->first();

        $defaultPassword = '@Poli' . $mahasiswa->nim;
        $mahasiswa->update(['password' => Hash::make($defaultPassword)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        Mail::to($mahasiswa->email)->send(new PasswordResetSuccess($mahasiswa, $defaultPassword));

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login dengan NIM sebagai password.');
    }
}
