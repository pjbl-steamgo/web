<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController; // <-- Tambahkan import ini

// Rute Autentikasi
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rute Pesanan (Order)
Route::get('/active-order', [OrderController::class, 'getActiveOrder']); // <-- Arahkan ke OrderController
Route::get('/order-history', [OrderController::class, 'getOrderHistory']);
Route::get('/services', [OrderController::class, 'getServices']);   