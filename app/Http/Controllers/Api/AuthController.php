<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; // ── WAJIB DITAMBAHKAN AGAR TIDAK EROR ──

class AuthController extends Controller
{
    // 1. FUNGSI REGISTER DARI MOBILE
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:mongodb.user,username',
            'no_hp'    => 'required|string|unique:mongodb.user,no_hp',
            'email'    => 'required|email|unique:mongodb.user,email',
            'password' => 'required|string|min:6',
        ]);

        $idUser = 'USR-' . strtoupper(bin2hex(random_bytes(3)));

        $user = User::create([
            'id_user'        => $idUser,
            'username'       => $request->username,
            'no_hp'          => $request->no_hp,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'jumlah_pesanan' => 0, 
            'member'         => 'Silver',
            'foto_profil'    => null,
            'role'           => 'user'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Akun berhasil didaftarkan!',
            'data'    => $user
        ], 201);
    }

    // 2. FUNGSI LOGIN DARI MOBILE (MENGGUNAKAN JWT)
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string', 
            'password'   => 'required|string',
        ]);

        $user = User::where('email', $request->identifier)
                    ->orWhere('no_hp', $request->identifier)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Kredensial tidak valid! Periksa kembali data Anda.'
            ], 401);
        }

        $token = auth('api')->login($user);

        return response()->json([
            'success' => true,
            'message' => 'Login Berhasil!',
            'user'    => $user,
            'token'   => $token 
        ], 200);
    }

    // 3. FUNGSI LOGOUT DARI MOBILE
    public function logout()
    {
        try {
            auth('api')->logout();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil logout'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal logout, token mungkin sudah tidak valid.'
            ], 500);
        }
    }

    // 4. FUNGSI RESET PASSWORD
    public function resetPassword(Request $request)
    {
        // Karena Validator sudah di-import di atas, kode ini tidak akan eror lagi
        $validator = Validator::make($request->all(), [
            'identifier' => 'required', 
            'password' => 'required|min:6|confirmed', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . $validator->errors()->first()
            ], 400);
        }

        try {
            $user = User::where('email', $request->identifier)
                        ->orWhere('no_hp', $request->identifier)
                        ->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun dengan Email / No HP tersebut tidak ditemukan.'
                ], 404);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset! Silakan login kembali.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }
}