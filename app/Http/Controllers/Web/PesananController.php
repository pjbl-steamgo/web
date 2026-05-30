<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Layanan;
use Carbon\Carbon;

class PesananController extends Controller
{
    /**
     * TAMPILKAN SEMUA DATA PESANAN (RIWAYAT)
     */
    public function index()
    {
        // Mengambil semua riwayat pesanan (termasuk yang sudah Selesai & Batal)
        $pesanans = Pesanan::with('layanan')->orderBy('tanggal', 'desc')->get();
        
        return view('index', [
            'initPage' => 'pesanan',
            'pesanans' => $pesanans
        ]);
    }

    /**
     * TAHAP 1: KONFIRMASI BOOKING MASUK
     * (Pesanan diterima, namun pelanggan belum membayar. Slot BELUM dikurangi)
     */
    public function konfirmasiBooking($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        // Ubah status agar pelanggan tahu booking di-acc dan bisa lanjut bayar
        $pesanan->update(['status' => 'Menunggu Pembayaran']);

        return redirect()->back()->with('success', 'Booking dikonfirmasi! Menunggu pelanggan melakukan pembayaran.');
    }

    /**
     * TAHAP 2: KONFIRMASI PEMBAYARAN (INTI SISTEM / RACE CONDITION)
     * (Uang masuk -> Slot dipotong -> Masuk antrian -> Batalkan yang lain jika penuh)
     */
    public function konfirmasiPembayaran($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $layanan = $pesanan->layanan;

        if (!$layanan) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan pada sistem.');
        }

        // 1. Validasi Keamanan: Pastikan slot benar-benar masih tersedia
        if ($layanan->slot_tersedia <= 0) {
            return redirect()->back()->with('error', 'Gagal! Slot layanan ini baru saja habis dipesan pelanggan lain.');
        }

        // 2. Transaksi Aman! Potong kapasitas slot layanan
        $layanan->decrement('slot_tersedia');

        // 3. Logika Antrian Cerdas:
        // Cek apakah ada kendaraan lain yang sedang dicuci (Proses).
        // Jika kosong, langsung eksekusi (Proses). Jika ada yang dicuci, suruh tunggu (Antri).
        $isAdaYangProses = Pesanan::where('status', 'Proses')->exists();
        
        if (!$isAdaYangProses) {
            $pesanan->update(['status' => 'Proses']);
        } else {
            $pesanan->update(['status' => 'Antri']);
        }

        // 4. LOGIKA SAPU BERSIH (RACE CONDITION PREVENTION)
        // Cek data terbaru slot di database. Jika ternyata ini adalah slot terakhir (0),
        // maka hancurkan/batalkan semua booking lain yang iseng menahan tempat (belum bayar).
        if ($layanan->fresh()->slot_tersedia == 0) {
            Pesanan::where('layanan_id', $layanan->id)
                ->whereIn('status', ['Booking', 'Menunggu Pembayaran', 'Pending'])
                ->where('_id', '!=', $pesanan->id) // Kecualikan pesanan si pemenang ini
                ->update(['status' => 'Batal Otomatis']);
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi! Kendaraan telah masuk ke antrian aktif.');
    }

    /**
     * TAHAP 3: SELESAI DIKERJAKAN
     * (Kendaraan bersih -> Pindah ke Riwayat -> Kembalikan Slot -> Panggil antrian selanjutnya)
     */
    public function selesai($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        // 1. Ubah status menjadi Selesai (Otomatis hilang dari papan antrian aktif)
        $pesanan->update(['status' => 'Selesai']);

        // 2. Kembalikan 1 slot ke layanan tersebut agar bisa dipesan pelanggan baru
        if ($pesanan->layanan) {
            $pesanan->layanan->increment('slot_tersedia');
        }

        // 3. ALGORITMA FIFO (First In First Out): 
        // Cari 1 orang yang sudah 'Antri' paling lama, lalu otomatis naikkan statusnya ke 'Proses'
        $nextPesanan = Pesanan::where('status', 'Antri')
            ->orderBy('tanggal', 'asc') // Urutkan dari waktu kedatangan paling awal
            ->first();

        if ($nextPesanan) {
            $nextPesanan->update(['status' => 'Proses']);
        }

        return redirect()->back()->with('success', 'Pengerjaan selesai! 1 Slot dikembalikan dan kendaraan berikutnya otomatis diproses.');
    }

    /**
     * HAPUS DATA PESANAN
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        // Jika yang dihapus ternyata sedang antri/proses, kembalikan dulu slotnya biar tidak nyangkut
        if (in_array($pesanan->status, ['Proses', 'Antri']) && $pesanan->layanan) {
            $pesanan->layanan->increment('slot_tersedia');
        }

        $pesanan->delete();

        return redirect()->back()->with('success', 'Data pesanan berhasil dihapus secara permanen.');
    }
}