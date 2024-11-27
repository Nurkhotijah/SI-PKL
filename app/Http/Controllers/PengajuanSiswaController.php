<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PengajuanSiswaController extends Controller
{
    public function create() // Untuk menampilkan form pengajuan siswa
    {
        return view('pages-admin.tambah-siswa'); // Pastikan view yang dimaksud sesuai
    }

    public function store(Request $request) // Untuk menyimpan pengajuan siswa baru
    {

        // Pastikan yang login adalah sekolah
        // if ($users->role !== 'sekolah') {
        //     return redirect()->back()->with('error', 'Hanya sekolah yang dapat mengajukan siswa.');
        // }

        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'cv' => 'required|mimes:pdf',
        ]);

        dd($request->all());

        $users = Auth::user(); // Mendapatkan data pengguna yang login

        dd($request->file('cv'));
        // Menyimpan file CV ke direktori public
        $filePath = $request->file('cv')->store('cv_siswa', 'public');
        

        // Menyimpan pengajuan siswa ke dalam database
        PengajuanSiswa::create([
            'nama_siswa' => $request->nama_siswa,
            'jurusan' => $request->jurusan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'cv' => $filePath,
            'status' => 'Pending',
            'id_sekolah' => $users->id, // ID Sekolah yang login
        ]);

        return redirect()->route('pages-admin.pengajuan-siswa')->with('success', 'Pengajuan siswa berhasil diajukan.');
    }

    public function index()
    {
        // Mengambil semua pengajuan siswa yang diajukan oleh sekolah yang login
        $users = auth()->user();
        $pengajuanSiswa = PengajuanSiswa::where('id_sekolah', $users->id)->get();

        return view('pages-admin.pengajuan-siswa', compact('pengajuanSiswa'));
    }
}
