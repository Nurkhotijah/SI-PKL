<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun admin industri
        $adminIndustri = User::create([
            'name' => 'Industri',
            'email' => 'industri@gmail.com',
            'password' => Hash::make('industri123'), // Password admin industri
            'role' => 'admin-industri', // Role admin industri
        ]);
        $adminIndustri->assignRole('admin-industri');

        // Membuat akun sekolah (registrasi sekolah)
        $sekolah = User::create([
            'name' => 'SMKN 1 Ciomas',
            'email' => 'smkn1ciomas@gmail.com',
            'alamat' => 'Jl. Raya Laladon, Laladon, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610',
            'password' => Hash::make('sekolah123'), // Password sekolah
            'role' => 'admin-sekolah', // Role admin sekolah
        ]);
        $sekolah->assignRole('admin-sekolah');

        // Membuat akun siswa
        $siswa = User::create([
            'name' => 'Fitri Amaliah',
            'email' => 'fitri@gmail.com',
            'password' => Hash::make('fitri123'), // Password siswa
            'role' => 'siswa', // Role siswa
        ]);
        $siswa->assignRole('siswa');

        // Siswa hanya perlu login menggunakan email dan password yang sudah dibuatkan oleh admin industri
        // Akun siswa akan dibuat oleh admin industri
    }
}