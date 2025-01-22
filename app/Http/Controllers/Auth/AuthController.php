<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.loginForm');
    }


    public function login(Request $request)
    {
        // Ambil email dan password dari request
        $credential = $request->only('email', 'password');
        // Validasi input
        $validated = Validator::make($credential, [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Jika validasi gagal, redirect kembali dengan error
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }
        // Jika login berhasil, regenerasi session dan redirect
        if (Auth::attempt($credential)) {
            // Buat ulang sesi untuk mencegah serangan fiksasi sesi
            $request->session()->regenerate();
        
            // Mengarahkan pengguna ke halaman dashboard
            return redirect()->intended(route('dashboard'));
        }
        // Jika login gagal, kembali dengan pesan error
        return redirect()->back()->with('error', 'Login Gagal. Email atau Password salah');
    }


    public function logout(Request $request)
    {
        // Logout, invalidate session, dan regenerate token
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Redirect ke halaman login
        return redirect()->route('login.form');
    }

    //menampilkan halaman unauthorized
    public function unauthorized()
    {
        return view('auth.403');
    }
}