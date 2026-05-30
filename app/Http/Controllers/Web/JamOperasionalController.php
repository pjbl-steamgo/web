<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\JamOperasional;
use Illuminate\Http\Request;

class JamOperasionalController extends Controller
{
    // Fungsi untuk Toggle Individu
    public function toggle($id)
    {
        $jam = JamOperasional::findOrFail($id);
        $jam->update(['is_active' => !$jam->is_active]);
        
        return response()->json(['success' => true]);
    }

    // Fungsi untuk Master Toggle (Buka/Tutup Semua)
    public function toggleAll(Request $request)
    {
        $status = $request->status === 'on'; // True jika ingin buka, false jika tutup
        JamOperasional::query()->update(['is_active' => $status]);

        return response()->json(['success' => true]);
    }
}