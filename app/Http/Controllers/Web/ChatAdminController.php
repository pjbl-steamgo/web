<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

class ChatAdminController extends Controller
{
    // Menampilkan daftar user yang pernah chat & isi chatnya
    public function index(Request $request)
    {
        // Mengambil daftar user unik yang pernah ngechat
        $userIds = Chat::distinct('user_id')->get()->pluck('user_id');
        $users = User::whereIn('id_user', $userIds)->get();

        // Jika admin memilih salah satu user dari daftar
        $activeUser = $request->query('user'); 
        $messages = [];

        if ($activeUser) {
            $messages = Chat::where('user_id', $activeUser)->orderBy('created_at', 'asc')->get();
            // Tandai sudah dibaca oleh admin
            Chat::where('user_id', $activeUser)->where('sender', 'user')->update(['is_read' => true]);
        }

        // ==============================================================
        // PERBAIKAN UTAMA: 
        // Wajib return ke 'index', BUKAN 'pages.chat'.
        // Dan wajib mengirimkan 'initPage' => 'chat' agar CSS termuat!
        // ==============================================================
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

        Chat::create([
            'user_id' => $user_id,
            'sender'  => 'admin', // Penanda bahwa admin yang membalas
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()->back();
    }
}