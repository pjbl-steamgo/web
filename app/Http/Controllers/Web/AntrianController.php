<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function index()
    {
        // 1. Ambil data antrian (hanya Proses dan Antri)
        $antrians = \App\Models\Pesanan::with('layanan')
            ->whereIn('status', ['Proses', 'Antri'])
            ->orderBy('tanggal', 'asc')
            ->get();
            
        // 2. Ambil SEMUA data layanan untuk diisi ke dalam dropdown filter
        $layanans = \App\Models\Layanan::all();

        return view('index', [
            'initPage' => 'antrian-jadwal',
            'antrians' => $antrians,
            'layanans' => $layanans // <-- Kirim data layanans ke view
        ]);

        $jamOperasionals = \App\Models\JamOperasional::all(); // <-- Tambahkan ini
        return view('index', [
            'initPage' => 'antrian-jadwal',
            'antrians' => $antrians,
            'layanans' => $layanans,
            'jamOperasionals' => $jamOperasionals // <-- Kirim ke View
        ]);
    }

    // Fungsi untuk memperbarui status antrian (misal dari "Antri" menjadi "Proses" atau "Selesai")
    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:Antri,Proses,Selesai,Dibatal'
        ]);

        $pesanan->update([
            'status' => $request->status
        ]);

        // Jika berhasil diubah, kembali ke halaman antrian
        return redirect()->back();
    }
}