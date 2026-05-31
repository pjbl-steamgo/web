<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderAdminController extends Controller
{
    /**
     * MENAMPILKAN HALAMAN KELOLA PESANAN (SOLUSI MASALAH 1)
     * Pastikan query di sini tidak mem-filter status tertentu saja,
     * sehingga pesanan baru dengan status "Belum Dikonfirmasi" tetap muncul.
     */
    public function index()
    {
        // Mengambil semua data pesanan dari yang paling baru
        $pesanans = Pesanan::orderBy('created_at', 'desc')->get();
        
        // Sesuaikan 'pages.konfirmasi-booking' dengan nama file blade aslimu
        // Jika file bladenya ada di resources/views/kelola-pesanan.blade.php, ubah jadi 'kelola-pesanan'
        return view('pages.konfirmasi-booking', compact('pesanans'));
    }

    /**
     * AKSI ADMIN 1: Mengonfirmasi Booking Baru
     * Mengubah status dari 'Belum Dikonfirmasi' -> 'Belum Bayar'
     */
    public function konfirmasiBooking($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        if ($pesanan->status === 'Belum Dikonfirmasi') {
            $pesanan->update(['status' => 'Belum Bayar']);
            
            return redirect()->back()->with('success', 'Booking berhasil disetujui! Pengguna kini bisa melihat tagihan dan melakukan pembayaran.');
        }
        
        return redirect()->back()->with('error', 'Gagal, status pesanan tidak valid untuk dikonfirmasi.');
    }

    /**
     * AKSI ADMIN 2: Memverifikasi Bukti Pembayaran
     * Mengubah status dari 'Sedang Diverifikasi' -> 'Proses' ATAU 'Antri'
     */
    public function konfirmasiPembayaran($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->status === 'Sedang Diverifikasi') {
            
            // ALGORITMA ANTREAN:
            // Cek apakah ada kendaraan lain yang sedang 'Proses' di hari dan layanan yang sama
            $antreanAktif = Pesanan::where('tanggal', $pesanan->tanggal)
                ->where('layanan_id', $pesanan->layanan_id)
                ->where('status', 'Proses')
                ->count();

            // Jika sudah ada yang diproses, masukkan ke Antri. Jika kosong, langsung Proses.
            $statusBaru = $antreanAktif > 0 ? 'Antri' : 'Proses';

            $pesanan->update(['status' => $statusBaru]);
            
            return redirect()->back()->with('success', "Pembayaran diverifikasi! Pesanan otomatis masuk ke status: {$statusBaru}.");
        }

        return redirect()->back()->with('error', 'Gagal, bukti pembayaran belum diunggah oleh pelanggan.');
    }

    /**
     * (OPSIONAL) FUNGSI HAPUS PESANAN
     * Jika admin ingin membatalkan/menghapus pesanan secara manual
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->back()->with('success', 'Data pesanan berhasil dihapus.');
    }
}