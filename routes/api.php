<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    return User::all(); // Mengambil data dari koleksi 'user' di DB 'steamgo'
});