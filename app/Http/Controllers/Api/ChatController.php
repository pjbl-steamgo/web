<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    // Mengambil pesan untuk ditampilkan di HP Pelanggan
    public function getMessages($id_user)
    {
        $messages = Chat::where('user_id', $id_user)->orderBy('created_at', 'asc')->get();

        // Tandai pesan dari admin sudah dibaca saat pelanggan membuka chat
        Chat::where('user_id', $id_user)->where('sender', 'admin')->update(['is_read' => true]);

        // Cek apakah percakapan sudah di-resolve oleh admin
        $isResolved = Chat::where('user_id', $id_user)
            ->where('is_resolved', true)
            ->exists();

        return response()->json([
            'success'     => true,
            'is_resolved' => $isResolved,
            'data'        => $isResolved ? [] : $messages // kalau resolved, kirim array kosong
        ], 200);
    }

    // Menerima pesan (Teks & Gambar) dari HP Pelanggan
    public function sendMessage(Request $request, $id_user)
    {
        $data = [
            'user_id'       => $id_user,
            'sender'        => 'user',
            'message'       => $request->message ?? '',
            'is_read'       => false,
            'is_resolved'   => false,
            'reply_to_text' => $request->reply_to_text,
        ];

        // Menerima file gambar jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('chat_images', 'public');
            $data['image'] = $path;
        }

        $chat = Chat::create($data);

        return response()->json([
            'success' => true,
            'data'    => $chat
        ], 201);
    }

    // Menghapus pesan tunggal dari HP Pelanggan
    public function deleteMessage($id_msg)
    {
        Chat::where('_id', $id_msg)->orWhere('id', $id_msg)->delete();

        return response()->json(['success' => true]);
    }

    // Menandai seluruh percakapan sebagai selesai (dipanggil dari admin)
    // TIDAK menghapus pesan — hanya update flag is_resolved
    public function resolve($id_user)
    {
        Chat::where('user_id', $id_user)->update(['is_resolved' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Percakapan ditandai selesai.'
        ]);
    }

    public function reopenChat($id_user)
    {
        Chat::where('user_id', $id_user)->update(['is_resolved' => false]);

        return response()->json(['success' => true]);
    }
}