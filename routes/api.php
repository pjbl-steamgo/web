<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\JamOperasionalController;
use App\Http\Controllers\Api\UserController;

// Rute Autentikasi
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rute Pesanan (Order)
Route::get('/active-order', [OrderController::class, 'getActiveOrder']); // <-- Arahkan ke OrderController
Route::get('/order-history', [OrderController::class, 'getOrderHistory']);
Route::get('/services', [OrderController::class, 'getServices']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/status/{id}', [OrderController::class, 'checkStatus']);
Route::post('/orders/{id}/payment', [OrderController::class, 'uploadPayment']);
Route::get('/layanan', [ServiceController::class, 'index']);
Route::get('/jam-operasional', [JamOperasionalController::class, 'index']);
Route::get('/user/{id_user}', [UserController::class, 'show']);
Route::put('/user/{id_user}', [UserController::class, 'updateProfile']);