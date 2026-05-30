<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Pesanan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bagikan data ke seluruh file Blade secara global
        View::composer('*', function ($view) {
            
            // 1. Hitung data Booking Baru
            $notifBooking = Pesanan::where('status', 'Booking')->count();
            
            // 2. Hitung data Menunggu Validasi Pembayaran
            $notifPembayaran = Pesanan::where('status', 'Menunggu Pembayaran')->count();
            
            // 3. Hitung data Antrian Aktif (Status 'Antri' DAN 'Proses')
            $notifAntrian = Pesanan::whereIn('status', ['Antri', 'Proses'])->count();
            
            // 4. Hitung total Riwayat Pesanan (Status 'Selesai' DAN 'Batal')
            $notifPesanan = Pesanan::whereIn('status', ['Selesai', 'Batal'])->count();
            
            // 5. Hitung Chat/Pesan Masuk (Proteksi jika belum buat Model Chat)
            $notifChat = 0;
            if (class_exists(\App\Models\Chat::class)) {
                // Jika model Chat sudah ada, hitung pesan yang belum dibaca (is_read = false)
                $notifChat = \App\Models\Chat::where('is_read', false)->count();
            } else {
                // Jika belum ada model Chat, kita beri angka simulator dulu agar UI tidak kosong
                $notifChat = 2; 
            }

            // Kirimkan semua variabel ke Sidebar
            $view->with([
                'notifBooking'    => $notifBooking,
                'notifPembayaran' => $notifPembayaran,
                'notifAntrian'    => $notifAntrian,
                'notifPesanan'    => $notifPesanan,
                'notifChat'       => $notifChat,
            ]);
        });
    }
}