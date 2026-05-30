<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Pesanan extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'pesanans';

    protected $fillable = [
        'kode_pesanan',      // Cth: '#INV-001'
        'tanggal',           // Bisa pakai tipe Date/Timestamp
        'nama_pelanggan',    // Cth: 'Faza I.'
        'layanan_id',        // Relasi ke tabel Layanan
        'kendaraan',         // Cth: 'NMAX'
        'metode_pembayaran', // Cth: 'Qris'
        'total_harga',       // Cth: 25000
        'status'             // Cth: 'Selesai', 'Proses', 'Antri'
    ];

    // Relasi untuk mengambil nama layanan berdasarkan layanan_id
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
}