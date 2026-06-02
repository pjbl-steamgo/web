<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Layanan extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'layanans';

    protected $fillable = [
        'kategori',
        'nama_layanan',
        'deskripsi',
        'estimasi_waktu',
        'harga',
        'is_active'
    ];

    // Tambahkan relasi ini
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'layanan_id');
    }
}