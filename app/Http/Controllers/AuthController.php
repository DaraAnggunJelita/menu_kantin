<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil input login
        $credentials = $request->only('email', 'password');

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role user
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Jika bukan admin
            Auth::logout();
            return back()->with('error', 'Akses ditolak. Hanya admin yang diperbolehkan login.');
        }

        // Gagal login
        return back()->with('error', 'Login gagal. Email atau password salah.');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate & regenerasi token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
