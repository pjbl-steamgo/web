<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

// Sementara aja untuk testing koneksi mongodb
Route::get('/', function () {
    // Mencoba mengambil semua data dari koleksi 'user'
    $users = User::all();
    
    // Jika berhasil konek, tampilkan pesan dan datanya
    return response()->json([
        'message' => 'Koneksi ke MongoDB berhasil!',
        'data' => $users
    ]);
});