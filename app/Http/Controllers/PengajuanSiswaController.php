<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// class PengajuanSiswaController extends Controller
// {
//     public function create() // Untuk menampilkan form pengajuan siswa
//     {
//         return view('pages-admin.tambah-siswa'); // Pastikan view yang dimaksud sesuai
//     }

//     public function store(Request $request) // Untuk menyimpan pengajuan siswa baru
//     {
//         //  dd($request->all());
        
//         $request->validate([
//             'nama_siswa' => 'required|string|max:255',
//             'jurusan' => 'required|string|max:255',
//             'tanggal_mulai' => 'required|date',
//             'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
//             'cv' => 'required|mimes:pdf',
//         ]);

//         $users = Auth::user(); // Mendapatkan data pengguna yang login

//         // Menyimpan file CV ke direktori public
//         $filePath = $request->file('cv')->store('cv_siswa', 'public');

//         // Menyimpan pengajuan siswa ke dalam database
//         PengajuanSiswa::create([
//             'nama_siswa' => $request->nama_siswa,
//             'jurusan' => $request->jurusan,
//             'tanggal_mulai' => $request->tanggal_mulai,
//             'tanggal_selesai' => $request->tanggal_selesai,
//             'cv' => $filePath,
//             'status' => 'Pending',
//             'id_sekolah' => $users->id, // ID Sekolah yang login
//         ]);

//         return redirect('/pengajuan-siswa')->with('success', 'Pengajuan siswa berhasil diajukan.');
//     }

//     public function index()
//     {
//         // Mengambil semua pengajuan siswa yang diajukan oleh sekolah yang login
//         $users = Auth::user();
//         $pengajuanSiswa = PengajuanSiswa::where('id_sekolah', $users->id)->get();

//         return view('pages-admin.pengajuan-siswa', compact('pengajuanSiswa'));
//     }
//     public function destroy($id)
//     {
//         // Cari pengajuan siswa berdasarkan ID
//         $pengajuan = PengajuanSiswa::find($id);

//         // Periksa apakah data pengajuan ditemukan
//         if (!$pengajuan) {
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Pengajuan siswa tidak ditemukan'
//             ], 404);
//         }

//         // Hapus file CV jika ada
//         if ($pengajuan->cv && Storage::exists('public/' . $pengajuan->cv)) {
//             Storage::delete('public/' . $pengajuan->cv);
//         }

//         // Hapus data pengajuan siswa dari database
//         $pengajuan->delete();

//         // Kembali ke halaman yang sama dengan pesan sukses
//         return redirect()->back()->with('success', 'Pengajuan siswa berhasil dihapus.');
//     }

//      // Method untuk mengupdate status pengajuan siswa yang dipilih
    
// }
