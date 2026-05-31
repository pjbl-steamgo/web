<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan ini mengarah ke model User kamu
use Illuminate\Http\Request;

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

    // Fungsi untuk memperbarui data profil dari Mobile
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
}