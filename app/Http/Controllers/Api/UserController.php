<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // <-- WAJIB DITAMBAHKAN untuk mengelola file gambar

class UserController extends Controller
{
    public function show($id_user)
    {
        try {
            // Mencari user berdasarkan id_user (bukan _id default MongoDB)
            $user = User::where('id_user', $id_user)->first();

            if ($user) {
                return response()->json([
                    'success' => true,
                    'data'    => $user
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fungsi untuk memperbarui data profil teks (kecuali foto dan password)
    public function updateProfile(Request $request, $id_user)
    {
        try {
            $user = User::where('id_user', $id_user)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ], 404);
            }

            // Validasi data yang dikirim dari Flutter
            $validatedData = $request->validate([
                'username' => 'sometimes|string|max:255',
                'no_hp'    => 'sometimes|string|max:20',
                'email'    => 'sometimes|email|max:255',
            ]);

            // Lakukan update ke MongoDB
            $user->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui',
                'data'    => $user
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fungsi Update Password
    public function updatePassword(Request $request, $id_user)
    {
        try {
            $user = User::where('id_user', $id_user)->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
            }

            // Hanya memvalidasi password_baru
            $request->validate([
                'password_baru' => 'required|min:6|confirmed', 
            ]);

            // Langsung update password di database
            $user->update([
                'password' => Hash::make($request->password_baru)
            ]);

            return response()->json(['success' => true, 'message' => 'Kata sandi berhasil diubah'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // =========================================================
    // FUNGSI BARU: UPLOAD FOTO PROFIL (Metode POST)
    // =========================================================
    public function uploadFoto(Request $request, $id_user)
    {
        try {
            $user = User::where('id_user', $id_user)->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
            }

            // Validasi input berupa file gambar
            $request->validate([
                'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal ukuran 2MB
            ]);

            if ($request->hasFile('foto_profil')) {
                // Hapus foto lama dari penyimpanan jika sebelumnya user sudah punya foto
                if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                    Storage::disk('public')->delete($user->foto_profil);
                }

                // Simpan foto baru ke folder 'storage/app/public/profile_photos'
                $path = $request->file('foto_profil')->store('profile_photos', 'public');

                // Update kolom foto_profil di database
                $user->update(['foto_profil' => $path]);

                return response()->json([
                    'success' => true, 
                    'message' => 'Foto profil berhasil diperbarui', 
                    'data' => $path
                ], 200);
            }

            return response()->json(['success' => false, 'message' => 'Tidak ada file yang diunggah'], 400);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // =========================================================
    // FUNGSI BARU: HAPUS FOTO PROFIL (Metode DELETE)
    // =========================================================
    public function deleteFoto($id_user)
    {
        try {
            $user = User::where('id_user', $id_user)->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
            }

            // Jika ada foto, hapus fisik file-nya dari server
            if ($user->foto_profil) {
                if (Storage::disk('public')->exists($user->foto_profil)) {
                    Storage::disk('public')->delete($user->foto_profil);
                }
                
                // Set nilai di MongoDB menjadi null kembali
                $user->update(['foto_profil' => null]);
            }

            return response()->json(['success' => true, 'message' => 'Foto profil berhasil dihapus'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}