<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Fungsi untuk mendapatkan pesanan terakhir yang sedang aktif
    public function getActiveOrder(Request $request)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Parameter user_id diperlukan.'
            ], 400);
        }

        // Mengambil pesanan terbaru milik user tersebut
        $pesanan = Pesanan::where('user_id', $userId)
                          ->orderBy('created_at', 'desc')
                          ->first();

        // Jika user belum pernah melakukan booking sama sekali
        if (!$pesanan) {
            return response()->json([
                'success' => true,
                'data' => null
            ], 200);
        }

        // Load relasi layanan agar detail harga & nama layanan terbaca di mobile
        // (Pastikan model Pesanan kamu memiliki fungsi relasi layanan())
        if (method_exists($pesanan, 'layanan')) {
            $pesanan->load('layanan');
        }

        return response()->json([
            'success' => true,
            'data' => $pesanan
        ], 200);
    }

    public function getOrderHistory(Request $request)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Parameter user_id diperlukan.'
            ], 400);
        }

        // Ambil SEMUA pesanan milik user ini, urutkan dari yang terbaru
        $riwayatPesanan = Pesanan::where('user_id', $userId)
                                 ->orderBy('created_at', 'desc')
                                 ->get();

        // Load relasi 'layanan' untuk setiap pesanan agar nama layanan & harganya terbaca
        $riwayatPesanan->load('layanan');

        return response()->json([
            'success' => true,
            'data' => $riwayatPesanan
        ], 200);
    }

    // Fungsi untuk mendapatkan daftar layanan aktif
    public function getServices()
    {
        // Asumsi kamu memiliki Model Layanan dan tabelnya
        // Pastikan modelnya bernama Layanan. Sesuaikan jika namanya beda.
        $layanan = \App\Models\Layanan::all();

        return response()->json([
            'success' => true,
            'data' => $layanan
        ], 200);
    }
}