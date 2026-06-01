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
            ->orderBy('created_at', 'asc')
            ->get();
            
        // 2. Ambil SEMUA data layanan
        $layanans = Layanan::all();

        // 3. Ambil data Jam Operasional dan URUTKAN dari database
        $jamOperasionals = JamOperasional::orderBy('jam', 'asc')->get();

        // 4. Jika database kosong, buat data default (statis) yang sudah terurut
        if ($jamOperasionals->isEmpty()) {
            $jamStatis = [
                '08:00 - 09:00', '09:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00',
                '12:00 - 13:00', '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00',
                '16:00 - 17:00', '17:00 - 18:00', '18:00 - 19:00', '19:00 - 20:00'
            ];
            
            $jamOperasionals = collect($jamStatis)->map(function($jam, $index) {
                return (object)[
                    'id' => 'statis-' . $index,
                    'jam' => $jam,
                    'is_active' => true
                ];
            });
        }

        return view('index', [
            'initPage' => 'antrian-jadwal',
            'antrians' => $antrians,
            'layanans' => $layanans,
            'jamOperasionals' => $jamOperasionals 
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:Antri,Proses,Selesai,Batal,Dihapus'
        ]);

        $statusLama = $pesanan->status;
        $statusBaru = $request->status;

        $pesanan->update([
            'status' => $statusBaru
        ]);

        if ($statusLama === 'Proses' && in_array($statusBaru, ['Selesai', 'Batal', 'Dihapus'])) {
            $antreanBerikutnya = Pesanan::where('tanggal', $pesanan->tanggal)
                ->where('layanan_id', $pesanan->layanan_id)
                ->where('status', 'Antri')
                ->orderBy('created_at', 'asc')
                ->first();

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