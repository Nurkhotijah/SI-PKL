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

     // Method untuk upload foto izin
     public function uploadFotoIzin(Request $request)
     {
         // Validasi foto izin yang di-upload (foto izin opsional)
         $request->validate([
             'foto_izin' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
         ]);
 
         // Mengecek apakah ada foto yang di-upload
         if ($request->hasFile('foto_izin')) {
             // Menyimpan foto izin ke storage
             $fotoIzin = $request->file('foto_izin');
             $fotoIzinPath = $fotoIzin->store('foto_izin', 'public'); // Menyimpan file di folder foto_izin
 
             // Menyimpan nama file foto izin ke tabel Absen
             $absen = Absen::where('user_id', Auth::id())->latest()->first(); // Mengambil riwayat absen terbaru untuk user yang login
             if ($absen) {
                 $absen->update(['foto_izin' => $fotoIzinPath]); // Update kolom foto_izin dengan path file
             }
         }
 
         // Redirect kembali dengan pesan sukses
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
