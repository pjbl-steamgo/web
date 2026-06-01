<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaturan; // Tetap memanggil model dari tabel pengaturan

class SettingController extends Controller
{
    /**
     * Mengambil data Bantuan & FAQ
     */
    public function getFaq()
    {
        // Asumsi data FAQ disimpan dengan tipe/kategori 'faq'
        $faq = Pengaturan::where('tipe', 'faq')->get(); 
        
        return response()->json([
            'success' => true, 
            'data'    => $faq
        ], 200);
    }

    /**
     * Mengambil data Syarat & Ketentuan
     */
    public function getSyaratKetentuan()
    {
        // Asumsi data SK disimpan dengan tipe/kategori 'syarat_ketentuan'
        $sk = Pengaturan::where('tipe', 'syarat_ketentuan')->first(); 
        
        return response()->json([
            'success' => true, 
            'data'    => $sk
        ], 200);
    }
}