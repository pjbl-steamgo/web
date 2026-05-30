<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan diarahkan ke model User/Pelanggan milikmu
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    /**
     * Tampilkan Halaman Data Pelanggan
     */
    public function index()
    {
        // Mengambil semua user dengan urutan pendaftaran terbaru
        $pelanggans = User::orderBy('created_at', 'desc')->get();

        return view('index', [
            'initPage' => 'pelanggan',
            'pelanggans' => $pelanggans
        ]);
    }

    /**
     * Proses Simpan Akun Baru (Simulator Aplikasi Mobile)
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Data (Menggunakan Model secara Langsung)
        $request->validate([
            'username'    => ['required', 'string', 'min:3', Rule::unique(User::class, 'username')],
            'no_hp'       => ['required', 'string', 'min:10', Rule::unique(User::class, 'no_hp')],
            'email'       => ['required', 'email', Rule::unique(User::class, 'email')],
            'password'    => ['required', 'string', 'min:6'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ], [
            'username.unique' => 'Gagal: Username ini sudah digunakan oleh pelanggan lain.',
            'no_hp.unique'    => 'Gagal: Nomor Handphone ini sudah terdaftar sebelumnya.',
            'email.unique'    => 'Gagal: Alamat Email ini sudah terdaftar sebelumnya.',
        ]);

        // 2. GENERATE ID USER OTOMATIS
        $idUser = 'USR-' . strtoupper(bin2hex(random_bytes(3)));

        // 3. HANDLE UPLOAD FOTO PROFIL
        $fotoPath = null;
        if ($request->hasFile('foto_profil')) {
            $fotoPath = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        // 4. LOGIKA TIER MEMBER
        $jumlahPesananAwal = 0;
        $tierMember = 'Silver';

        // 5. SIMPAN KE MONGODB
        User::create([
            'id_user'        => $idUser,
            'username'       => $request->username,
            'no_hp'          => $request->no_hp,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'foto_profil'    => $fotoPath,
            'jumlah_pesanan' => $jumlahPesananAwal, 
            'member'         => $tierMember,
        ]);

        return redirect()->back()->with('success', 'Akun User baru berhasil dibuat dengan ID: ' . $idUser);
    }
}