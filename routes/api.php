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

// =========================================================================
// RUTE PUBLIK (HANYA UNTUK MENDAPATKAN TOKEN)
// =========================================================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);


// =========================================================================
// RUTE PRIVATE MOBILE (WAJIB MENYERTAKAN TOKEN JWT DI HEADERS)
// Semua fitur aplikasi SteamGo terkunci di dalam sini
// =========================================================================
Route::middleware('auth:api')->group(function () {

    // Rute Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rute Informasi Umum
    Route::get('/layanan', [ServiceController::class, 'index']);
    Route::get('/jam-operasional', [JamOperasionalController::class, 'index']);

    // Rute Pengaturan
    Route::get('/pengaturan/faq', [SettingController::class, 'getFaq']);
    Route::get('/pengaturan/syarat-ketentuan', [SettingController::class, 'getSyaratKetentuan']);

    // Rute Pesanan (Order)
    Route::get('/active-order', [OrderController::class, 'getActiveOrder']);
    Route::get('/order-history', [OrderController::class, 'getOrderHistory']);
    Route::get('/services', [OrderController::class, 'getServices']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/status/{id}', [OrderController::class, 'checkStatus']);
    Route::post('/orders/{id}/payment', [OrderController::class, 'uploadPayment']);

    // Rute User & Profil
    Route::get('/user/{id_user}', [UserController::class, 'show']);
    Route::put('/user/{id_user}', [UserController::class, 'updateProfile']);
    Route::put('/user/{id_user}/password', [UserController::class, 'updatePassword']);

    // Rute Upload dan Hapus Foto Profil
    Route::post('/user/{id_user}/foto', [UserController::class, 'uploadFoto']);
    Route::delete('/user/{id_user}/foto', [UserController::class, 'deleteFoto']);

    // Rute Chat Mobile (Flutter) — membutuhkan JWT
    Route::get('/chat/{id_user}', [ChatController::class, 'getMessages']);
    Route::post('/chat/{id_user}', [ChatController::class, 'sendMessage']);
    Route::delete('/chat/message/{id_msg}', [ChatController::class, 'deleteMessage']);
    Route::post('/chat/{id_user}/reopen', [ChatController::class, 'reopenChat']);
});


// =========================================================================
// RUTE CHAT ADMIN (Digunakan oleh Web Panel)
// Dibiarkan di luar auth:api karena panel web menggunakan Session (auth:web)
// =========================================================================

// 1. Ambil Riwayat Pesan
Route::get('/admin/chat/{id_user}', function ($id_user) {
    $messages = \App\Models\Chat::where('user_id', $id_user)->orderBy('created_at', 'asc')->get();
    \App\Models\Chat::where('user_id', $id_user)->where('sender', 'user')->update(['is_read' => true]);
    // Admin selalu lihat semua pesan, tidak peduli is_resolved
    return response()->json(['success' => true, 'data' => $messages]);
});

// 2. Kirim Pesan, Reply, dan Kirim Gambar
Route::post('/admin/chat/{id_user}', function (Request $request, $id_user) {
    $data = [
        'user_id'       => $id_user,
        'sender'        => 'admin',
        'message'       => $request->message ?? '',
        'is_read'       => false,
        'reply_to_text' => $request->reply_to_text,
    ];

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('chat_images', 'public');
        $data['image'] = $path;
    }

    \App\Models\Chat::create($data);
    return response()->json(['success' => true]);
});

// 3. Hapus Pesan
Route::delete('/admin/chat/message/{id_msg}', function ($id_msg) {
    \App\Models\Chat::where('_id', $id_msg)->orWhere('id', $id_msg)->delete();
    return response()->json(['success' => true]);
});

// 4. Tandai Percakapan Selesai — dipanggil dari web panel, tanpa JWT
Route::post('/admin/chat/{id_user}/resolve', [ChatController::class, 'resolve']);

// 5. Reopen percakapan yang sudah selesai
Route::post('/admin/chat/{id_user}/reopen', function ($id_user) {
    \App\Models\Chat::where('user_id', $id_user)->update(['is_resolved' => false]);
    return response()->json(['success' => true]);
});