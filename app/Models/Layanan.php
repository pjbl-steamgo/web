<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // Pastikan pakai ini untuk Laravel-MongoDB

class Layanan extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'layanan';

    // Sesuai dengan field di crud.js
    protected $fillable = [
        'nama', 'jenis', 'harga', 'durasi', 
        'deskripsi', 'icon', 'gradient', 'label', 
        'pesananBulan', 'status', 'populer'
    ];
}