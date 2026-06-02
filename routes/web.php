<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\JamOperasionalController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\LayananController;
use App\Http\Controllers\Web\PesananController;
use App\Http\Controllers\Web\AntrianController;
use App\Http\Controllers\Web\PelangganController;
use App\Http\Controllers\Web\OrderAdminController;
use App\Http\Controllers\Web\ChatAdminController;
use App\Http\Controllers\Web\LaporanController;

// ----------------------------------------------------------------------
// RUTE UNTUK TAMU (BELUM LOGIN)
// ----------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// ----------------------------------------------------------------------
// RUTE TERPROTEKSI (WAJIB LOGIN)
// Semua rute di dalam grup ini akan mengecek session aktif terlebih dahulu
// ----------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    
    // Redirect dari root URL (/) ke /dashboard
    Route::get('/', function () {
        return redirect('/dashboard');
    });

    // Rute Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute Utama Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Antrian & Jadwal
    Route::get('/antrian-jadwal', [AntrianController::class, 'index'])->name('antrian.index');
    Route::put('/antrian-jadwal/{id}/status', [AntrianController::class, 'updateStatus'])->name('antrian.updateStatus');

    // Rute Kelola Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.destroy');
    // Rute khusus untuk menyelesaikan pesanan dengan logika FIFO
    Route::patch('/pesanan/{id}/selesai', [PesananController::class, 'selesaikanPesanan'])->name('pesanan.selesai');
    // Rute untuk transaksi pesanan
    Route::post('/pesanan/{id}/konfirmasi-booking', [PesananController::class, 'konfirmasiBooking'])->name('pesanan.konfirmasiBooking');
    Route::post('/pesanan/{id}/konfirmasi-pembayaran', [PesananController::class, 'konfirmasiPembayaran'])->name('pesanan.konfirmasiPembayaran');

    // Rute Tampilan Halaman (GET)
    Route::get('/konfirmasi-booking', [PesananController::class, 'halamanBooking'])->name('halaman.booking');
    Route::get('/konfirmasi-pembayaran', [PesananController::class, 'halamanPembayaran'])->name('halaman.pembayaran');

    // Rute Layanan & Harga
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
    // Rute ini untuk memproses form simpan data
    Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
    Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');
    Route::post('/layanan/{id}/toggle', [LayananController::class, 'toggleStatus'])->name('layanan.toggle');
    Route::post('/layanan/update-status/{id}', [LayananController::class, 'updateStatus'])->name('layanan.updateStatus');

    // Rute Data Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');

    // Rute Laporan Pendapatan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/export-csv', [LaporanController::class, 'exportCsv'])->name('laporan.exportCsv');
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.exportPdf');

    // Rute Pesan Pelanggan (Chat)
    Route::get('/chat', [ChatAdminController::class, 'index'])->name('admin.chat');
    Route::post('/chat/{user_id}/reply', [ChatAdminController::class, 'reply'])->name('admin.chat.reply');

    // Rute untuk toggle Jam Operasional (API Internal via Fetch)
    Route::patch('/jam-operasional/toggle-all', [JamOperasionalController::class, 'toggleAll']);
    Route::patch('/jam-operasional/{id}/toggle', [JamOperasionalController::class, 'toggle']);

});