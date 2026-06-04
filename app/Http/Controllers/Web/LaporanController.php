<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * FUNGSI BANTUAN: Untuk membaca format string aneh dari Database MongoDB
     * Mengubah "03 Juni 2026, 08:00 - 09:00" menjadi Objek Tanggal yang bisa dibaca sistem.
     */
    private function parseTanggalIndo($tanggalString)
    {
        if (empty($tanggalString)) return Carbon::today();

        // 1. Buang koma dan rentang jam (Ambil HANYA "03 Juni 2026")
        $datePart = explode(',', $tanggalString)[0];
        $datePart = trim($datePart);

        // 2. Terjemahkan ke bahasa Inggris agar Carbon paham
        $bulanIndo = [
            'Januari' => 'January', 'Februari' => 'February', 'Maret' => 'March',
            'April' => 'April', 'Mei' => 'May', 'Juni' => 'June',
            'Juli' => 'July', 'Agustus' => 'August', 'September' => 'September',
            'Oktober' => 'October', 'November' => 'November', 'Desember' => 'December'
        ];
        $datePart = strtr($datePart, $bulanIndo);

        // 3. Konversi menjadi objek tanggal
        try {
            return Carbon::parse($datePart);
        } catch (\Exception $e) {
            return Carbon::today(); // Fallback aman jika tiba-tiba format rusak
        }
    }

    public function index(Request $request) 
    {
        // 1. Ambil SEMUA pesanan "Selesai"
        $allPesanans = Pesanan::with('layanan')->where('status', 'Selesai')->get();

        // 2. Tangkap parameter periode dari URL
        $periode = $request->query('periode');

        // 3. Filter data dengan aman menggunakan helper parseTanggalIndo
        $pesanans = $allPesanans->filter(function($p) use ($periode) {
            $tanggal = $this->parseTanggalIndo($p->tanggal);
            
            if (in_array($periode, ['hari', 'harian'])) {
                return $tanggal->isToday();
            } elseif (in_array($periode, ['tahun', 'tahunan'])) {
                return $tanggal->isCurrentYear();
            } else {
                // Default fallback: Bulan Ini
                return $tanggal->isCurrentMonth() && $tanggal->isCurrentYear();
            }
        })->values();

        // 4. Hitung Statistik
        $totalPendapatan = $pesanans->sum('total_harga');
        $totalPesanan = $pesanans->count();

        $totalPesananMotor = $pesanans->filter(function($p) {
            return isset($p->layanan) && strtolower($p->layanan->kategori) === 'motor';
        })->count();

        $totalPesananMobil = $pesanans->filter(function($p) {
            return isset($p->layanan) && strtolower($p->layanan->kategori) === 'mobil';
        })->count();

        $rataRataPesanan = $totalPesanan > 0 ? ($totalPendapatan / $totalPesanan) : 0;

        return view('index', [
            'initPage'           => 'laporan',
            'pesanans'           => $pesanans,
            'totalPendapatan'    => $totalPendapatan,
            'totalPesanan'       => $totalPesanan,
            'totalPesananMotor'  => $totalPesananMotor,
            'totalPesananMobil'  => $totalPesananMobil,
            'rataRataPesanan'    => $rataRataPesanan,
        ]);
    }

    public function exportCsv(Request $request)
    {
        $allPesanans = Pesanan::with('layanan')->where('status', 'Selesai')->get();
        $periode = $request->query('periode');

        $pesanans = $allPesanans->filter(function($p) use ($periode) {
            $tanggal = $this->parseTanggalIndo($p->tanggal);
            if (in_array($periode, ['hari', 'harian'])) return $tanggal->isToday();
            if (in_array($periode, ['tahun', 'tahunan'])) return $tanggal->isCurrentYear();
            return $tanggal->isCurrentMonth() && $tanggal->isCurrentYear();
        })->values();

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
                    $p->tanggal, // Tulis data mentah aslinya ke CSV
                    $p->total_harga
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $allPesanans = Pesanan::with('layanan')->where('status', 'Selesai')->get();
        $periode = $request->query('periode');

        $pesanans = $allPesanans->filter(function($p) use ($periode) {
            $tanggal = $this->parseTanggalIndo($p->tanggal);
            if (in_array($periode, ['hari', 'harian'])) return $tanggal->isToday();
            if (in_array($periode, ['tahun', 'tahunan'])) return $tanggal->isCurrentYear();
            return $tanggal->isCurrentMonth() && $tanggal->isCurrentYear();
        })->values();

        $totalPendapatan = $pesanans->sum('total_harga');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.laporan-pdf', compact('pesanans', 'totalPendapatan'));
        return $pdf->download('Laporan_Pesanan_' . date('Y-m-d') . '.pdf');
    }
}