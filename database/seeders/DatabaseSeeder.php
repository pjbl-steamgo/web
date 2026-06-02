<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Mengecek agar tidak terjadi duplikat
        $adminExist = User::where('username', 'admin')->first();

        if (!$adminExist) {
            User::create([
                'username' => 'Admin SteamGo', 
                'password' => Hash::make('admin123'),
                'role'     => 'admin' // Menambahkan field role
            ]);
            
            $this->command->info('Akun Admin berhasil dibuat!');
        } else {
            $this->command->info('Akun Admin sudah tersedia di database.');
        }
    }
}