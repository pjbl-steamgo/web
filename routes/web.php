<?php

use Illuminate\Support\Facades\Route;

// Redirect dari root URL (/) ke /dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Rute Utama Dashboard
Route::get('/dashboard', function () {
    return view('index', ['initPage' => 'dashboard']);
})->name('dashboard');

// Rute Antrian & Jadwal
Route::get('/antrian-jadwal', function () {
    return view('index', ['initPage' => 'antrian']);
})->name('antrian.jadwal');

// Rute Kelola Pesanan
Route::get('/pesanan', function () {
    return view('index', ['initPage' => 'pesanan']);
})->name('pesanan');

// Rute Layanan & Harga
Route::get('/layanan', function () {
    return view('index', ['initPage' => 'layanan']);
})->name('layanan');

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