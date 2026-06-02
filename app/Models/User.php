<?php

namespace App\Models;

// Ganti Authenticatable bawaan dengan milik MongoDB
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
// Import JWTSubject dari Tymon
use Tymon\JWTAuth\Contracts\JWTSubject;

// Tambahkan "implements JWTSubject" di sini
class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Tentukan koneksi ke MongoDB
    protected $connection = 'mongodb';

    // Sesuaikan dengan nama koleksi di Compass kamu
    protected $collection = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_user',
        'username',
        'no_hp',
        'email',
        'password',
        'foto_profil',
        'jumlah_pesanan',
        'member',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =========================================================
    // 2 FUNGSI WAJIB UNTUK JWT AUTHENTICATION
    // =========================================================

    /**
     * Mendapatkan identifier yang akan disimpan di dalam token JWT (Subject Claim).
     * Biasanya ini akan mengembalikan ID unik dari user (di MongoDB berupa _id).
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Mengembalikan array key-value yang berisi data tambahan (Custom Claims)
     * untuk disisipkan ke dalam token JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        // Menyisipkan data role dan username ke dalam token
        // Sangat berguna agar di frontend (Flutter) Anda bisa mengetahui role user
        // tanpa harus melakukan request ulang ke database.
        return [
            'role' => $this->role,
            'username' => $this->username,
        ];
    }
}