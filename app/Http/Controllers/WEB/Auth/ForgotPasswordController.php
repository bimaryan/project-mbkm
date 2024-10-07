<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
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

        return redirect()->route('login')->with('message', 'We have e-mailed your password reset link!');
    }

    public function resetPassword($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPasswordProcess(Request $request)
    {

        $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
                'token' => 'required',
            ],
            [
                'email.required' => 'Email harus diisi',
                'password.required' => 'Password harus diisi',
            ]
        );

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token,

            ])
            ->first();

        if (!Hash::check($request->token, $updatePassword->token)) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        \DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
        Mahasiswa::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        return redirect()->route('login')->with('message', 'Your password has been changed!');
    }
}
