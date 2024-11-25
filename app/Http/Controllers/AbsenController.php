<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Absen;

class AbsenController extends Controller
{
    public function absenMasuk(Request $request)
    {
        $user = Auth::user();
        $today = now()->toDateString();
    
        $cekAbsen = Absen::where('user_id', $user->id)
                         ->whereDate('created_at', now()->toDateString())
                         ->first();
    
        if ($cekAbsen && $cekAbsen->absen_masuk) {
            return response()->json(['message' => 'Anda sudah absen masuk hari ini.'], 400);
        }
    
        // Simpan foto absen masuk (asumsikan foto diupload)
        $fotoMasuk = $request->file('foto_masuk')->store('public/absen_foto');
    
        // Simpan data absen masuk
        $absen = $cekAbsen ?: new Absen();
        $absen->user_id = $user->id;
        $absen->absen_masuk = now();
        $absen->foto_masuk = $fotoMasuk;  // Menyimpan foto absen masuk
        $absen->save();
    
        return response()->json(['message' => 'Absen masuk berhasil.']);
    }
    
    public function absenKeluar(Request $request)
    {
        $user = Auth::user();
        $today = now()->toDateString();
    
        // Cari data absen yang valid
        $absen = Absen::where('user_id', $user->id)
                      ->whereDate('created_at', $today)
                      ->first();
    
        if (!$absen || !$absen->absen_masuk || $absen->absen_keluar) {
            return response()->json(['message' => 'Anda belum absen masuk atau sudah absen keluar.'], 400);
        }
    
        // Simpan foto absen keluar (asumsikan foto diupload)
        $fotoKeluar = $request->file('foto_keluar')->store('public/absen_foto');
    
        // Simpan data absen keluar
        $absen->absen_keluar = now();
        $absen->foto_keluar = $fotoKeluar;  // Menyimpan foto absen keluar
        $absen->save();
    
        return response()->json(['message' => 'Absen keluar berhasil.']);
    }
        public function checkStatus()
    {
        $user = Auth::user();  // Mendapatkan data user yang sedang login
        $today = now()->toDateString();
    
        $absen = Absen::where('user_id', $user->id)
                      ->whereDate('created_at', $today)
                      ->first();
    
        // Kembalikan respons dengan status absen dan data user
        return response()->json([
            'absenSelesai' => $absen && $absen->absen_masuk && $absen->absen_keluar,
            'user' => $user,  // Menampilkan data user yang sedang login
        ]);
    }
}    
