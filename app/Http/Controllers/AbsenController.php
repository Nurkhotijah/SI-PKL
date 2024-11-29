<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function index()
    {
        // Mendapatkan data kehadiran berdasarkan user yang sedang login
        $kehadiran = Absen::where('user_id', Auth::id())->get();

        // Mengarahkan ke tampilan Riwayat-absensi.blade.php
        return view('pages-user.Riwayat-absensi', compact('kehadiran'));
    }

    public function uploadFotoIzin(Request $request)
{
    // Validasi input untuk file foto izin
    $request->validate([
        'foto_izin' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Mengecek apakah file diunggah
    if ($request->hasFile('foto_izin')) {
        // Menyimpan file ke dalam storage lokal
        $fotoIzin = $request->file('foto_izin');
        $fotoIzinPath = $fotoIzin->store('foto_izin', 'public'); // Menyimpan ke folder storage/app/public/foto_izin

        // Menyimpan data ke tabel Absen berdasarkan user login
        $absen = Absen::where('user_id', Auth::id())
                      ->latest()
                      ->first(); // Ambil data absen terbaru dari user yang login

        if ($absen) {
            $absen->update(['foto_izin' => $fotoIzinPath]); // Update data kolom `foto_izin`
        } else {
            // Jika tidak ada data absen sebelumnya, buat data baru
            Absen::create([
                'user_id' => Auth::id(),
                'tanggal' => now(),
                'status_kehadiran' => 'Izin', // Set status kehadiran sebagai 'Izin'
                'foto_izin' => $fotoIzinPath,
            ]);
        }
    }

    return redirect()->route('riwayat-kehadiran')->with('success', 'Foto izin berhasil di-upload');
}

    public function downloadRekap()
    {
        // Menyusun path untuk file rekap yang akan didownload
        $path = storage_path('app/public/rekap/rekap_'.Auth::user()->name.'.pdf');
        
        // Mengunduh file rekap
        return response()->download($path);
    }

    // Fungsi untuk menampilkan detail kehadiran berdasarkan ID
    public function show($id)
    {
        $absen = Absen::findOrFail($id);
        return view('kehadiran.show', compact('absen'));
    }
}
