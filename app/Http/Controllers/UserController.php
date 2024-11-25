<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function dashboard()
    {
        // Data absensi dummy (nanti bisa diganti dari database)
        $attendanceData = [
            'present' => 20,
            'absent' => 2,
            'late' => 1,
        ];
    
        // Perbaiki path view sesuai dengan lokasi file yang benar
        return view('pages-user.dashboard-user', compact('attendanceData'));
    }
    
    public function riwayatKehadiran() {
    return view('pages-user.Riwayat-absensi');
}
     public function pengajuanizin() {
    return view('pages-user.Pengajuan-izin');
}
public function jurnalKegiatan() {
    return view('pages-user.Jurnal-kegiatan');
}
public function penilaianpkl() {
    return view('pages-user.Penilaian-pkl');
}
public function rekapkehadiran() {
    return view('pages-user.Rekap-kehadiran');
}
public function profile() {
    return view('pages-user.Profile');
}

 // Metode untuk menampilkan halaman edit pengajuan
 public function editizin()
{
    return view('pages-user.Edit-izin'); 
}

public function tambahjurnal()
{
    return view('pages-user.Tambah-jurnal'); 
}

// Metode untuk menghapus pengajuan
public function hapusizin()
{
    return view('pages-user.Hapus-izin'); 
}

   
    public function logout(Request $request)
    {
        Auth::logout(); // Menggunakan facade Auth untuk logout

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
