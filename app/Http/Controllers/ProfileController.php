<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.index'); // Halaman profil Anda
    }

    public function edit()
    {
        return view('profile.Update-profile'); // Halaman edit profil Anda
    }
    
    // Metode untuk mengganti kata sandi
    public function updatePassword(Request $request)
    {
        // Logika untuk mengganti kata sandi di sini
        return redirect()->back()->with('success', 'Kata sandi berhasil diganti.');
    }
}
