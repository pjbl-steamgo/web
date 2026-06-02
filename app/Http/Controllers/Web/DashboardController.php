<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $month = Carbon::now()->month;

        // 1. Statistik Kartu (Data Asli)
        $pendapatanHariIni = Pesanan::where('status', 'Selesai')
            ->whereDate('created_at', $today)
            ->sum('total_harga');

        $pesananSelesaiHariIni = Pesanan::where('status', 'Selesai')
            ->whereDate('created_at', $today)
            ->count();

        $antrianAktif = Pesanan::whereIn('status', ['Antri', 'Proses'])->count();

        $pelangganBaruHariIni = User::where('role', 'user')->whereDate('created_at', $today)->count();

        // 2. Pesanan Terbaru (Limit 5)
        $pesanansTerbaru = Pesanan::with('layanan')->latest()->take(5)->get();

        // 3. Antrian Sekarang (Sidebar)
        $antrianSidebar = Pesanan::with('layanan')
            ->whereIn('status', ['Antri', 'Proses'])
            ->orderBy('created_at', 'asc')
            ->take(4)
            ->get();

        // 4. Data Chart Pendapatan 7 Hari Terakhir
        $pendapatan7Hari = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dayName = $date->format('D'); 
            $mapHari = ['Mon' => 'Sen', 'Tue' => 'Sel', 'Wed' => 'Rab', 'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab', 'Sun' => 'Min'];
            
            $pendapatan = Pesanan::where('status', 'Selesai')
                ->whereDate('created_at', $date)
                ->sum('total_harga');
            
            $pendapatan7Hari[] = [
                'hari'   => $mapHari[$dayName] ?? $dayName,
                'jumlah' => $pendapatan,
                'label'  => $pendapatan >= 1000000 ? (round($pendapatan/1000000, 1) . 'jt') : (round($pendapatan/1000, 0) . 'K')
            ];
        }

        $maxPendapatan = max(array_column($pendapatan7Hari, 'jumlah')) ?: 1;

        // 5. Distribusi Layanan (Untuk Chart Donat)
        // Dikelompokkan berdasarkan nama dasar agar grafik donat tidak terpecah-pecah
        $pesananBulanIni = Pesanan::with('layanan')
            ->where('status', 'Selesai')
            ->whereMonth('created_at', $month)
            ->get();

        $totalPesananBulanIni = $pesananBulanIni->count();

        $dataDistribusi = $pesananBulanIni->groupBy(function($item) {
            $nama = $item->layanan->nama_layanan ?? 'Lainnya';
            // Normalisasi: Hapus kata motor/mobil agar Steam Motor & Steam Mobil jadi 1 grup
            $baseName = trim(str_ireplace([' motor', ' mobil', '-motor', '-mobil', 'motor', 'mobil'], '', strtolower($nama)));
            return ucwords($baseName); 
        })->map(function ($items, $namaLayanan) use ($totalPesananBulanIni) {
            $count = $items->count();
            return [
                'nama'   => $namaLayanan,
                'count'  => $count,
                'persen' => $totalPesananBulanIni > 0 ? round(($count / $totalPesananBulanIni) * 100) : 0
            ];
        });

        // Konversi ke JSON agar bisa dibaca oleh Chart.js di Blade
        $labelsDistribusi = json_encode($dataDistribusi->pluck('nama')->toArray());
        $valuesDistribusi = json_encode($dataDistribusi->pluck('count')->toArray());

        return view('index', [
            'initPage'              => 'dashboard',
            'pendapatanHariIni'     => $pendapatanHariIni,
            'pesananSelesaiHariIni' => $pesananSelesaiHariIni,
            'antrianAktif'          => $antrianAktif,
            'pelangganBaruHariIni'  => $pelangganBaruHariIni,
            'pesanansTerbaru'       => $pesanansTerbaru,
            'antrianSidebar'        => $antrianSidebar,
            'pendapatan7Hari'       => $pendapatan7Hari,
            'maxPendapatan'         => $maxPendapatan,
            'distribusiLayanan'     => $dataDistribusi,
            'labelsDistribusi'      => $labelsDistribusi,
            'valuesDistribusi'      => $valuesDistribusi,
            'totalPesananBulanIni'  => $totalPesananBulanIni
        ]);
    }
}