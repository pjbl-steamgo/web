<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan; // Pastikan ini sesuai dengan nama Model kamu (Layanan atau Service)

class ServiceController extends Controller
{
    public function index()
    {
        try {
            // Mengambil semua data dari tabel layanan di MongoDB
            $services = Layanan::all();

            // Mengirimkan response JSON untuk ditangkap oleh Flutter
            return response()->json([
                'success' => true,
                'data'    => $services
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data layanan: ' . $e->getMessage()
            ], 500);
        }
    }
}