<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Layanan;
use App\Models\JamOperasional;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AntrianController extends Controller
{
    public function index()
    {
        // 1. Ambil data antrian (hanya Proses dan Antri)
        $antrians = Pesanan::with('layanan')
            ->whereIn('status', ['Proses', 'Antri'])
            ->orderBy('tanggal', 'asc')
            ->orderBy('created_at', 'asc') // Menjaga urutan FIFO di tampilan Admin
            ->get();
            
        // 2. Ambil SEMUA data layanan untuk diisi ke dalam dropdown filter
        $layanans = Layanan::all();

        // 3. Ambil data Jam Operasional
        $jamOperasionals = JamOperasional::all();

        return view('index', [
            'initPage' => 'antrian-jadwal',
            'antrians' => $antrians,
            'layanans' => $layanans,
            'jamOperasionals' => $jamOperasionals 
        ]);
    }

    // Fungsi untuk memperbarui status antrian (misal dari "Proses" menjadi "Selesai")
    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:Antri,Proses,Selesai,Batal,Dihapus' // Sesuaikan dengan enum di databasemu
        ]);

        // Simpan status lama untuk pengecekan
        $statusLama = $pesanan->status;
        $statusBaru = $request->status;

        // Ubah status pesanan yang diklik Admin
        $pesanan->update([
            'status' => $statusBaru
        ]);

        // ==============================================================
        // LOGIKA OTOMATIS MEMAJUKAN SISTEM ANTREAN FIFO (QUEUE SHIFTING)
        // ==============================================================
        // Jika pesanan yang tadinya 'Proses' diubah menjadi 'Selesai' atau dibatalkan
        if ($statusLama === 'Proses' && in_array($statusBaru, ['Selesai', 'Batal', 'Dihapus'])) {
            
            // Cari 1 orang pertama (First In) yang statusnya 'Antri' di tanggal dan layanan yang sama
            $antreanBerikutnya = Pesanan::where('tanggal', $pesanan->tanggal)
                ->where('layanan_id', $pesanan->layanan_id)
                ->where('status', 'Antri')
                ->orderBy('created_at', 'asc') // Paling dulu booking = Paling atas
                ->first();

            // Jika ada antrean selanjutnya, otomatis naik jadi Proses
            if ($antreanBerikutnya) {
                $antreanBerikutnya->update([
                    'status' => 'Proses'
                ]);
                
                return redirect()->back()->with('success', 'Status berhasil diperbarui! Antrean selanjutnya otomatis naik menjadi Proses.');
            }
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
}