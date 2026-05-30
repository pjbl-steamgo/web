<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. FUNGSI REGISTER DARI MOBILE
    public function register(Request $request)
    {
        // Validasi input dari mobile
        $request->validate([
            'username' => 'required|string|unique:mongodb.user,username',
            'no_hp'    => 'required|string|unique:mongodb.user,no_hp',
            'email'    => 'required|email|unique:mongodb.user,email',
            'password' => 'required|string|min:6',
        ]);

        // Generate ID User
        $idUser = 'USR-' . strtoupper(bin2hex(random_bytes(3)));

        // Simpan ke MongoDB
        $user = User::create([
            'id_user'        => $idUser,
            'username'       => $request->username,
            'no_hp'          => $request->no_hp,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'jumlah_pesanan' => 0, 
            'member'         => 'Silver',
            'foto_profil'    => null
        ]);

        // Balas ke Flutter dengan pesan sukses
        return response()->json([
            'success' => true,
            'message' => 'Akun berhasil didaftarkan!',
            'data'    => $user
        ], 201);
    }

    // 2. FUNGSI LOGIN DARI MOBILE
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string', // Bisa berupa email ATAU no_hp
            'password'   => 'required|string',
        ]);

        // Cari user berdasarkan email atau no_hp
        $user = User::where('email', $request->identifier)
                    ->orWhere('no_hp', $request->identifier)
                    ->first();

        // Cek apakah user ada dan passwordnya cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Kredensial tidak valid! Periksa kembali data Anda.'
            ], 401);
        }

        // Balas ke Flutter dengan data user (untuk disimpan di SharedPreferences)
        return response()->json([
            'success' => true,
            'message' => 'Login Berhasil!',
            'data'    => $user
        ], 200);
    }
}