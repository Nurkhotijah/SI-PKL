<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanSiswaController extends Controller
{
    // Menampilkan daftar pengajuan siswa
    public function index()
    {
        // Mengambil data pengajuan siswa yang terkait dengan sekolah pengguna yang sedang login
        $pengajuanSiswa = PengajuanSiswa::where('sekolah_id', Auth::user()->sekolah_id)->get();

        return view('pages-admin.pengajuan-siswa', compact('pengajuanSiswa'));
    }

    // Menampilkan form untuk menambahkan pengajuan baru
    public function create()
    {
        return view('pages-admin.tambah-siswa');
    }

    // Menyimpan pengajuan baru
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'cv' => 'required|mimes:pdf|max:9000', // Hanya menerima file PDF dengan ukuran maksimal 9MB
        ]);

        $sekolahId = Auth::user()->sekolah_id;

        if (!$sekolahId) {
            return redirect()->back()->with('error', 'ID Sekolah tidak ditemukan untuk pengguna yang login.');
        }

        if (!Auth::check() || !$sekolahId) {
            return redirect()->back()->with('error', 'Pengguna tidak terautentikasi atau ID Sekolah tidak ditemukan.');
        }

        // Upload CV
        $cv = $request->file('cv')->store('cv_files', 'public'); // Menyimpan file ke storage publik

        // Simpan data pengajuan siswa ke database
        PengajuanSiswa::create([
            'nama_siswa' => $request->nama_siswa,
            'jurusan' => $request->jurusan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'cv' => $cv,
            'sekolah_id' => $sekolahId,
        ]);

        return redirect()->route('pengajuan-siswa')->with('success', 'Pengajuan PKL berhasil diajukan.');
    }

    // Menghapus pengajuan siswa
    public function destroy($id)
    {
        $pengajuan = PengajuanSiswa::findOrFail($id);

        // Hapus file CV dari storage
        Storage::disk('public')->delete($pengajuan->cv);

        // Hapus pengajuan siswa dari database
        $pengajuan->delete();

        return redirect()->route('pengajuan-siswa')->with('success', 'Pengajuan siswa berhasil dihapus.');
    }
}
