<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Ambil semua pesanan yang statusnya 'Selesai'
        // Kita gunakan 'with' untuk mengambil relasi layanan agar bisa cek kategori (Mobil/Motor)
        $pesanans = Pesanan::with('layanan')
            ->where('status', 'Selesai')
            ->get();

        // 2. Hitung Total Pendapatan
        $totalPendapatan = $pesanans->sum('total_harga');

        // 3. Hitung Total Pesanan
        $totalPesanan = $pesanans->count();

        // 4. Hitung Pesanan Motor & Mobil
        $totalPesananMotor = $pesanans->filter(function($p) {
            return isset($p->layanan) && strtolower($p->layanan->kategori) === 'motor';
        })->count();

        $totalPesananMobil = $pesanans->filter(function($p) {
            return isset($p->layanan) && strtolower($p->layanan->kategori) === 'mobil';
        })->count();

        // 5. Hitung Rata-rata
        $rataRataPesanan = $totalPesanan > 0 ? ($totalPendapatan / $totalPesanan) : 0;

        // Kita kirim data ke view index dengan initPage 'laporan'
        return view('index', [
            'initPage'           => 'laporan',
            'totalPendapatan'    => $totalPendapatan,
            'totalPesanan'       => $totalPesanan,
            'totalPesananMotor'  => $totalPesananMotor,
            'totalPesananMobil'  => $totalPesananMobil,
            'rataRataPesanan'    => $rataRataPesanan,
        ]);
    }

    public function exportCsv(Request $request)
    {
        $pesanans = Pesanan::with('layanan')->where('status', 'Selesai')->get();

        $fileName = 'Laporan_Pesanan_' . date('Y-m-d') . '.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($pesanans) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID Pesanan', 'Pelanggan', 'Layanan', 'Tanggal', 'Harga']);

            foreach ($pesanans as $p) {
                fputcsv($file, [
                    $p->kode_pesanan,
                    $p->nama_pelanggan,
                    $p->layanan->nama_layanan ?? '-',
                    $p->tanggal,
                    $p->total_harga
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $pesanans = Pesanan::with('layanan')->where('status', 'Selesai')->get();
        $totalPendapatan = $pesanans->sum('total_harga');

        // Jika menggunakan dompdf
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.laporan-pdf', compact('pesanans', 'totalPendapatan'));
        return $pdf->download('Laporan_Pesanan_' . date('Y-m-d') . '.pdf');
    }
}