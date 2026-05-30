<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LayananController;
use App\Http\Controllers\Web\PesananController;
use App\Http\Controllers\Web\AntrianController;

// Redirect dari root URL (/) ke /dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Rute Utama Dashboard
Route::get('/dashboard', function () {
    return view('index', ['initPage' => 'dashboard']);
})->name('dashboard');

// Rute Antrian & Jadwal
Route::get('/antrian-jadwal', [AntrianController::class, 'index'])->name('antrian.index');
Route::put('/antrian-jadwal/{id}/status', [AntrianController::class, 'updateStatus'])->name('antrian.updateStatus');

// Rute Kelola Pesanan
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
// Rute khusus untuk menyelesaikan pesanan dengan logika FIFO
Route::patch('/pesanan/{id}/selesai', [PesananController::class, 'selesaikanPesanan'])->name('pesanan.selesai');

// Rute Layanan & Harga
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
// Rute ini untuk memproses form simpan data
Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');
Route::patch('/layanan/{id}/toggle', [LayananController::class, 'toggleStatus'])->name('layanan.toggle');

// Rute Data Pelanggan
Route::get('/pelanggan', function () {
    return view('index', ['initPage' => 'pelanggan']);
})->name('pelanggan');

// Rute Laporan Pendapatan
Route::get('/laporan', function () {
    return view('index', ['initPage' => 'laporan']);
})->name('laporan');

// Rute Pesan Pelanggan (Chat)
Route::get('/chat', function () {
    return view('index', ['initPage' => 'chat']);
})->name('chat');

// Rute Pengaturan Sistem
Route::get('/pengaturan', function () {
    return view('index', ['initPage' => 'pengaturan']);
})->name('pengaturan');

// Rute untuk toggle Jam Operasional (API Internal via Fetch)
Route::patch('/jam-operasional/toggle-all', [App\Http\Controllers\Web\JamOperasionalController::class, 'toggleAll']);
Route::patch('/jam-operasional/{id}/toggle', [App\Http\Controllers\Web\JamOperasionalController::class, 'toggle']);