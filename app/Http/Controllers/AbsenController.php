<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    // Fungsi untuk melakukan absen masuk
    public function absenMasuk(Request $request)
    {
        // Validasi dan upload foto (jika ada)
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('absensi', 'public'); // Menyimpan file di folder public/absensi
        }

        // Simpan data absen masuk ke database
        Absen::create([
            'user_id' => Auth::user()->id,
            'status' => 'masuk',
            'foto' => $fotoPath, // Simpan path foto
            'waktu' => now(), // Waktu absen
        ]);

        return response()->json(['message' => 'Absen masuk berhasil']);
    }

    // Fungsi untuk melakukan absen keluar
    public function absenKeluar(Request $request)
    {
        // Validasi dan upload foto (jika ada)
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('absensi', 'public'); // Menyimpan file di folder public/absensi
        }

        // Simpan data absen keluar ke database
        Absen::create([
            'user_id' => Auth::user()->id,
            'status' => 'keluar',
            'foto' => $fotoPath, // Simpan path foto
            'waktu' => now(), // Waktu absen
        ]);

        return response()->json(['message' => 'Absen keluar berhasil']);
    }
}
