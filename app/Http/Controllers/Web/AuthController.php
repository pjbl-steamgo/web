<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller; // Wajib di-import karena beda folder
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input form
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // 2. Proteksi Tambahan: Pastikan hanya akun dengan role 'admin' yang bisa masuk
        // Ini mencegah pelanggan dari aplikasi mobile login ke panel admin
        $credentials['role'] = 'admin';

        // Cek apakah user mencentang fitur "Remember Me"
        $remember = $request->has('remember');

        // 3. Proses otentikasi
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // 4. Jika gagal
        return back()->withErrors([
            'username' => 'Username, password salah, atau Anda tidak memiliki akses.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}