<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * MENAMPILKAN SEMUA DATA PESANAN (HALAMAN UTAMA PESANAN)
     */
    public function index()
    {
        $pesanans = Pesanan::with('layanan')->orderBy('created_at', 'desc')->get();
        
        return view('index', [
            'initPage' => 'pesanan', // Pastikan nama ini sesuai dengan di file index.blade.php
            'pesanans' => $pesanans
        ]);
    }

    /**
     * MENAMPILKAN HALAMAN KONFIRMASI BOOKING (Hanya status Belum Dikonfirmasi)
     */
    public function halamanBooking()
    {
        $pesanans = Pesanan::with('layanan')
            ->where('status', 'Belum Dikonfirmasi')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('index', [
            'initPage' => 'konfirmasi-booking', // KUNCI PEMISAH: Hanya memanggil komponen booking
            'pesanans' => $pesanans
        ]);
    }

    /**
     * MENAMPILKAN HALAMAN KONFIRMASI PEMBAYARAN (Hanya status Sedang Diverifikasi)
     */
    public function halamanPembayaran()
    {
        $pesanans = Pesanan::with('layanan')
            ->where('status', 'Sedang Diverifikasi')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('index', [
            'initPage' => 'konfirmasi-pembayaran', // KUNCI PEMISAH: Hanya memanggil komponen pembayaran
            'pesanans' => $pesanans
        ]);
    }

    /**
     * AKSI ADMIN: Menyetujui Booking Masuk
     */
    public function konfirmasiBooking($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        if ($pesanan->status === 'Belum Dikonfirmasi') {
            $pesanan->update(['status' => 'Belum Bayar']);
            return redirect()->back()->with('success', 'Booking berhasil disetujui! Pengguna kini bisa melakukan pembayaran.');
        }
        
        return redirect()->back()->with('error', 'Gagal, status pesanan tidak valid.');
    }

    /**
     * AKSI ADMIN: Memverifikasi Bukti Pembayaran & Masuk Antrean
     */
    public function konfirmasiPembayaran($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->status === 'Sedang Diverifikasi') {
            // Algoritma Cek Antrean Berjalan
            $antreanAktif = Pesanan::where('tanggal', $pesanan->tanggal)
                ->where('layanan_id', $pesanan->layanan_id)
                ->where('status', 'Proses')
                ->count();

            // Jika sudah ada yang diproses, masukkan ke Antri. Jika kosong, langsung Proses.
            $statusBaru = $antreanAktif > 0 ? 'Antri' : 'Proses';
            
            $pesanan->update(['status' => $statusBaru]);
            
            return redirect()->back()->with('success', "Pembayaran diverifikasi! Pesanan otomatis masuk ke status: {$statusBaru}.");
        }

        return redirect()->back()->with('error', 'Gagal memverifikasi pembayaran.');
    }

    /**
     * AKSI ADMIN: Menyelesaikan Pesanan
     */
    public function selesaikanPesanan($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        // Simpan info penting sebelum mengubah
        $tanggalLayanan = $pesanan->tanggal;
        $idLayanan = $pesanan->layanan_id;
        $statusLama = $pesanan->status;

        // Ubah jadi selesai
        $pesanan->update(['status' => 'Selesai']);

        // LOGIKA SHIFTING: Jika yang diselesaikan adalah pesanan yang sedang diproses
        if ($statusLama === 'Proses') {
            $antreanBerikutnya = Pesanan::where('tanggal', $tanggalLayanan)
                ->where('layanan_id', $idLayanan)
                ->where('status', 'Antri')
                ->orderBy('created_at', 'asc')
                ->first();

            if ($antreanBerikutnya) {
                $antreanBerikutnya->update(['status' => 'Proses']);
                return redirect()->back()->with('success', 'Pesanan telah berhasil diselesaikan! Antrean berikutnya otomatis diproses.');
            }
        }

        return redirect()->back()->with('success', 'Pesanan telah berhasil diselesaikan!');
    }

    /**
     * AKSI ADMIN: Menghapus Pesanan
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->back()->with('success', 'Data pesanan berhasil dihapus secara permanen.');
    }
}