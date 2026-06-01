<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\JamOperasionalController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\ChatController;

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

// Rute Layanan & Operasional
Route::get('/layanan', [ServiceController::class, 'index']);
Route::get('/jam-operasional', [JamOperasionalController::class, 'index']);

// Rute User & Profil
Route::get('/user/{id_user}', [UserController::class, 'show']);
Route::put('/user/{id_user}', [UserController::class, 'updateProfile']);
// Rute untuk Update Password
Route::put('/user/{id_user}/password', [UserController::class, 'updatePassword']);

// Rute untuk FAQ dan S&K diarahkan ke SettingController
Route::get('/pengaturan/faq', [SettingController::class, 'getFaq']);
Route::get('/pengaturan/syarat-ketentuan', [SettingController::class, 'getSyaratKetentuan']);

// =========================================================================
// RUTE CHAT ADMIN (Dengan Fitur Teks, Gambar, Reply, & Hapus)
// =========================================================================

// 1. Ambil Riwayat Pesan
Route::get('/admin/chat/{id_user}', function($id_user) {
    $messages = \App\Models\Chat::where('user_id', $id_user)->orderBy('created_at', 'asc')->get();
    \App\Models\Chat::where('user_id', $id_user)->where('sender', 'user')->update(['is_read' => true]);
    return response()->json(['success' => true, 'data' => $messages]);
});

// 2. Kirim Pesan, Reply, dan Kirim Gambar
Route::post('/admin/chat/{id_user}', function(Request $request, $id_user) {
    $data = [
        'user_id' => $id_user,
        'sender'  => 'admin',
        'message' => $request->message ?? '',
        'is_read' => false,
        'reply_to_text' => $request->reply_to_text, // Simpan teks balasan
    ];

    // Jika ada upload gambar (Kirim dari FormData)
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('chat_images', 'public');
        $data['image'] = $path; // Simpan path gambar ke DB
    }

    \App\Models\Chat::create($data);
    return response()->json(['success' => true]);
});

// 3. Fitur Hapus Pesan
Route::delete('/admin/chat/message/{id_msg}', function($id_msg) {
    // Mendukung penghapusan via _id (MongoDB) atau id biasa
    \App\Models\Chat::where('_id', $id_msg)->orWhere('id', $id_msg)->delete();
    return response()->json(['success' => true]);
});

// =========================================================================
// RUTE CHAT MOBILE (Flutter)
// =========================================================================

Route::get('/chat/{id_user}', [ChatController::class, 'getMessages']);
Route::post('/chat/{id_user}', [ChatController::class, 'sendMessage']);
Route::delete('/chat/message/{id_msg}', [ChatController::class, 'deleteMessage']);