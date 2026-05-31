<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JamOperasional; // Sesuaikan dengan Model kamu
use Illuminate\Http\Request;

class JamOperasionalController extends Controller
{
    public function index()
    {
        try {
            // Ambil semua data jam operasional dan urutkan
            $jams = JamOperasional::orderBy('jam', 'asc')->get();

            return response()->json([
                'success' => true,
                'data'    => $jams
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data: ' . $e->getMessage()
            ], 500);
        }
    }
}