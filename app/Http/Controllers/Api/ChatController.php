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
        
        return response()->json([
            'success' => true,
            'data' => $messages
        ], 200);
    }

    // Menerima pesan (Teks & Gambar) dari HP Pelanggan
    public function sendMessage(Request $request, $id_user)
    {
        $data = [
            'user_id' => $id_user,
            'sender'  => 'user',
            'message' => $request->message ?? '',
            'is_read' => false,
            'reply_to_text' => $request->reply_to_text, // Menerima data Reply
        ];

        // Menerima file gambar jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('chat_images', 'public');
            $data['image'] = $path;
        }

        $chat = Chat::create($data);

        return response()->json([
            'success' => true,
            'data' => $chat
        ], 201);
    }

    // Menghapus pesan dari HP Pelanggan
    public function deleteMessage($id_msg)
    {
        Chat::where('_id', $id_msg)->orWhere('id', $id_msg)->delete();
        return response()->json(['success' => true]);
    }
}