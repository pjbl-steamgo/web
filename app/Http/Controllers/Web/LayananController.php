<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule; // Wajib ditambahkan untuk validasi MongoDB

class LayananController extends Controller
{
    // 1. Fungsi Menampilkan Data (Diperbarui untuk MongoDB)
    public function index()
    {
        $layanans = Layanan::all();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Hitung pesanan secara manual karena withCount() tidak support di MongoDB
        foreach ($layanans as $layanan) {
            $layanan->pesanans_count = Pesanan::where('layanan_id', $layanan->id)
                ->where('created_at', '>=', $startOfMonth)
                ->count();
        }
        
        return view('index', [
            'initPage' => 'layanan',
            'layanans' => $layanans
        ]);
    }

    // 2. Fungsi Tambah Data
    public function store(Request $request)
    {
        // Validasi Unique yang aman untuk MongoDB
        $request->validate([
            'nama_layanan'   => ['required', 'string', 'max:255', Rule::unique(Layanan::class, 'nama_layanan')],
            'kategori'       => ['required', 'string'], 
            'harga'          => ['required', 'numeric'],
            'estimasi_waktu' => ['required', 'numeric'],
            'slot_tersedia'  => ['required', 'numeric'],
            'deskripsi'      => ['required', 'string']
        ], [
            'nama_layanan.unique' => 'Gagal! Nama layanan ini sudah terdaftar di database.'
        ]);

        Layanan::create([
            'nama_layanan'   => $request->nama_layanan,
            'kategori'       => $request->kategori,
            'harga'          => (int) $request->harga,
            'estimasi_waktu' => (int) $request->estimasi_waktu,
            'slot_tersedia'  => (int) $request->slot_tersedia,
            'deskripsi'      => $request->deskripsi,
            'is_active'      => true
        ]);

        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    // 3. Fungsi Edit Data
    public function update(Request $request, $id)
    {
        // Validasi Unique dengan Exception (Pengecualian) ID untuk MongoDB
        $request->validate([
            'nama_layanan'   => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique(Layanan::class, 'nama_layanan')->ignore($id, '_id') // Ini cara benarnya di Laravel!
            ],
            'kategori'       => ['required', 'string'], 
            'harga'          => ['required', 'numeric'],
            'estimasi_waktu' => ['required', 'numeric'],
            'slot_tersedia'  => ['required', 'numeric'],
            'deskripsi'      => ['required', 'string']
        ], [
            'nama_layanan.unique' => 'Gagal! Nama layanan tersebut sudah digunakan oleh layanan lain.'
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->update([
            'nama_layanan'   => $request->nama_layanan,
            'kategori'       => $request->kategori,
            'harga'          => (int) $request->harga,
            'estimasi_waktu' => (int) $request->estimasi_waktu,
            'slot_tersedia'  => (int) $request->slot_tersedia,
            'deskripsi'      => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Layanan berhasil diperbarui!');
    }

    // 4. Fungsi Hapus Data
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
    }

    // 5. Fungsi Toggle On/Off
    public function toggleStatus($id)
    {
        $layanan = Layanan::findOrFail($id);
        
        $currentState = $layanan->is_active ?? true;
        
        $layanan->update([
            'is_active' => !$currentState
        ]); 

        return redirect()->back();
    }
}