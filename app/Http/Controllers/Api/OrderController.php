<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function getActiveOrder(Request $request)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Parameter user_id diperlukan.'], 400);
        }

        $pesanan = Pesanan::where('user_id', $userId)->orderBy('created_at', 'desc')->first();

        if (!$pesanan) {
            return response()->json(['success' => true, 'data' => null], 200);
        }

        if (method_exists($pesanan, 'layanan')) {
            $pesanan->load('layanan');
        }

        return response()->json(['success' => true, 'data' => $pesanan], 200);
    }

    public function getOrderHistory(Request $request)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Parameter user_id diperlukan.'], 400);
        }

        $riwayatPesanan = Pesanan::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $riwayatPesanan->load('layanan');

        return response()->json(['success' => true, 'data' => $riwayatPesanan], 200);
    }

    public function getServices()
    {
        $layanan = Layanan::all();
        return response()->json(['success' => true, 'data' => $layanan], 200);
    }

    // ---------------------------------------------------------
    // FUNGSI MEMBUAT PESANAN (TANPA LIMIT SLOT OTOMATIS)
    // ---------------------------------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required',
            'layanan_id'  => 'required',
            'kendaraan'   => 'required|string',
            'plat_nomor'  => 'required|string',
            'tanggal'     => 'required|string',
            'total_harga' => 'required|numeric'
        ]);

        $userId = $request->user_id;

        // 1. CARI USER BERDASARKAN Kolom `id_user` ATAU `_id` MongoDB
        $user = User::where('id_user', $userId)
                    ->orWhere('_id', $userId)
                    ->first();

        // Jika tetap tidak ketemu, tolak pesanan dan beri pesan error jelas ke Flutter
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "GAGAL: Data user dengan ID [{$userId}] tidak ditemukan di tabel users."
            ], 404);
        }

        // 2. SIMPAN PESANAN (Status Tetap: Belum Dikonfirmasi untuk alur pembayaran)
        $pesanan = new Pesanan();
        $pesanan->kode_pesanan      = 'STG-' . strtoupper(substr(uniqid(), -6));
        
        // AMBIL DATA DARI TABEL USERS
        $pesanan->nama_pelanggan    = $user->username ?? 'Pelanggan'; 
        $pesanan->no_hp             = $user->no_hp ?? '-';
        $pesanan->metode_pembayaran = 'QRIS';
        
        // DATA DARI FLUTTER
        $pesanan->user_id           = $userId;
        $pesanan->layanan_id        = $request->layanan_id;
        $pesanan->kendaraan         = $request->kendaraan;
        $pesanan->plat_nomor        = strtoupper($request->plat_nomor);
        $pesanan->tanggal           = $request->tanggal; // cth: "02 Juni 2026, 13:00 - 14:00"
        $pesanan->total_harga       = (int) $request->total_harga;
        
        // Status awal WAJIB Belum Dikonfirmasi agar bisa upload pembayaran di Flutter
        $pesanan->status            = 'Belum Dikonfirmasi'; 
        $pesanan->no_antrian        = '-'; 
        
        $pesanan->save();

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibuat.',
            'data'    => $pesanan
        ], 201);
    }

    public function checkStatus($id)
    {
        $pesanan = Pesanan::find($id);

        if (!$pesanan) {
            return response()->json([
                'success' => false,
                'status' => 'Dihapus',
                'message' => 'Pesanan tidak ditemukan atau kadaluarsa.'
            ]);
        }

        $sisaDetik = 0;

        if ($pesanan->status === 'Belum Bayar') {
            $waktuDisetujui = Carbon::parse($pesanan->updated_at);
            $batasWaktu = $waktuDisetujui->addMinutes(10);
            
            if (now()->greaterThanOrEqualTo($batasWaktu)) {
                $pesanan->delete();
                return response()->json([
                    'success' => false,
                    'status' => 'Dihapus',
                    'message' => 'Waktu pembayaran telah habis, pesanan dibatalkan otomatis.'
                ]);
            } else {
                $sisaDetik = now()->diffInSeconds($batasWaktu);
            }
        }

        return response()->json([
            'success' => true,
            'status' => $pesanan->status,
            'sisa_detik' => $sisaDetik
        ]);
    }

    // FUNGSI UPLOAD BUKTI PEMBAYARAN DARI FLUTTER
    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Maksimal 5MB
        ]);

        $pesanan = Pesanan::find($id);

        if (!$pesanan) {
            return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan.'], 404);
        }

        // Simpan gambar ke storage/app/public/payments
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('payments', $filename, 'public'); 
            
            $pesanan->bukti_pembayaran = '/storage/' . $path;
        }

        // Ubah status untuk diproses Admin di halaman /konfirmasi-pembayaran
        $pesanan->status = 'Sedang Diverifikasi';
        $pesanan->save();

        return response()->json([
            'success' => true,
            'message' => 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.'
        ]);
    }
}