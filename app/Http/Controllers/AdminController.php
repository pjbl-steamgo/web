<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Antrian;
use App\Models\Pesanan;

class AdminController extends Controller
{
    /**
     * Menampilkan Dashboard Utama Admin
     */
    public function index()
    {
        // Mengambil semua data dari collection MongoDB
        $layanan = Layanan::all();
        $pelanggan = Pelanggan::all();
        $antrian = Antrian::all();
        $pesanan = Pesanan::all();

        // Data statistik untuk kartu dashboard (Logic PHP)
        $totalPendapatan = $pesanan->where('status', 'Selesai')->sum('total');
        $pesananSelesai = $pesanan->where('status', 'Selesai')->count();
        $antrianAktif = $antrian->whereIn('status', ['Proses', 'Menunggu'])->count();
        $totalPelanggan = $pelanggan->count();

        return view('admin.dashboard', compact(
            'layanan', 
            'pelanggan', 
            'antrian', 
            'pesanan',
            'totalPendapatan',
            'pesananSelesai',
            'antrianAktif',
            'totalPelanggan'
        ));
    }

    /**
     * Menyimpan Layanan Baru ke MongoDB
     */
    public function storeLayanan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'jenis' => 'required|in:Motor,Mobil',
            'harga' => 'required|numeric',
            'durasi' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        // Logic penentuan icon dan warna gradient (Konversi dari crud.js)
        $icon = $request->jenis == 'Motor' ? '🏍️' : '🚗';
        $gradient = $request->jenis == 'Motor' 
            ? 'linear-gradient(90deg,#1A6BFF,#38B6FF)' 
            : 'linear-gradient(90deg,#00b4d8,#90e0ef)';

        Layanan::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'harga' => (int) $request->harga,
            'durasi' => (int) $request->durasi,
            'deskripsi' => $request->deskripsi,
            'icon' => $icon,
            'gradient' => $gradient,
            'label' => 'Layanan Baru',
            'pesananBulan' => 0,
            'status' => 'Aktif',
            'populer' => false
        ]);

        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Menghapus Layanan dari MongoDB
     */
    public function destroyLayanan($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
    }

    /**
     * Mengubah Status Layanan (Aktif/Nonaktif)
     */
    public function toggleLayanan($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->status = ($layanan->status == 'Aktif') ? 'Nonaktif' : 'Aktif';
        $layanan->save();

        return redirect()->back()->with('success', 'Status layanan berhasil diperbarui!');
    }

    /**
     * Menyimpan Pelanggan Baru
     */
    public function storePelanggan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'hp' => 'required|string',
            'member' => 'required|in:Baru,Silver,Gold',
        ]);

        $colors = [
            'linear-gradient(135deg,#1A6BFF,#38B6FF)',
            'linear-gradient(135deg,#00C48C,#38B6FF)',
            'linear-gradient(135deg,#f7971e,#ffd200)',
            'linear-gradient(135deg,#8B5CF6,#EC4899)'
        ];

        Pelanggan::create([
            'nama' => $request->nama,
            'hp' => $request->hp,
            'member' => $request->member,
            'totalSteam' => 0,
            'totalBayar' => 0,
            'terakhir' => '-',
            'avatar' => strtoupper(substr($request->nama, 0, 1)),
            'color' => $colors[array_rand($colors)]
        ]);

        return redirect()->back()->with('success', 'Pelanggan berhasil didaftarkan!');
    }

    /**
     * Menghapus Pelanggan
     */
    public function destroyPelanggan($id)
    {
        Pelanggan::destroy($id);
        return redirect()->back()->with('success', 'Data pelanggan dihapus!');
    }
}