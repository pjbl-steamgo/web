<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

class ChatAdminController extends Controller
{
    public function index(Request $request)
    {
        // PERBAIKAN: Hanya mengambil daftar user yang memiliki chat aktif (belum di-resolve)
        $userIds = Chat::where('is_resolved', false)->distinct('user_id')->get()->pluck('user_id');
        $users = User::whereIn('id_user', $userIds)->get();

        // Jika admin memilih salah satu user dari daftar
        $activeUser = $request->query('user'); 
        $messages = [];

        if ($activeUser) {
            $messages = Chat::where('user_id', $activeUser)->orderBy('created_at', 'asc')->get();
            // Tandai sudah dibaca oleh admin
            Chat::where('user_id', $activeUser)->where('sender', 'user')->update(['is_read' => true]);
        }

        return view('index', [ 
            'initPage'   => 'chat',
            'users'      => $users,
            'activeUser' => $activeUser,
            'messages'   => $messages
        ]);
    }

    // Mengirim balasan dari Admin ke User
    public function reply(Request $request, $user_id)
    {
        $request->validate(['message' => 'required|string']);

        // PERBAIKAN: Buka kembali semua riwayat chat (unresolve)
        Chat::where('user_id', $user_id)->update(['is_resolved' => false]);

        Chat::create([
            'user_id' => $user_id,
            'sender'  => 'admin', // Penanda bahwa admin yang membalas
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()->back();
    }
}