<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi data registrasi
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Nama Sekolah atau Username
            'email' => 'required|string|email|max:255|unique:users',
            'alamat' => 'required|string|max:255', // Alamat
            'password' => 'required|string|min:8', // Password
            'agreement' => 'accepted', // Validasi checkbox persetujuan
        ]);
    
        // Menyimpan data sekolah ke database
        $user = User::create([
            'name' => $validated['name'], // Nama Sekolah atau Username
            'email' => $validated['email'],
            'alamat' => $validated['alamat'], // Menambahkan alamat
            'password' => Hash::make($validated['password']),
            'role' => 'admin-sekolah', // Mengubah role menjadi sekolah
        ]);
    
        // Menetapkan role sekolah
        $user->assignRole('admin-sekolah');
    
        // Login otomatis setelah registrasi (opsional)
        // auth()->login($user);
    
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
    
// public function login(Request $request)
// {
//     $validated = $request->validate([
//         'email' => 'required|string|email',
//         'password' => 'required|string',
//     ]);

//     if (auth()->attempt($validated)) {
//         return redirect()->route('dashboard');
//     }

//     return back()->withErrors(['email' => 'Invalid credentials']);
// }
}