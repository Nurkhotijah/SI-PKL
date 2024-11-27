<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurnalKegiatan;
use App\Models\Jurnal; // Model Jurnal untuk akses ke jurnal kegiatan
use App\Models\User;  // Model Siswa untuk akses ke data siswa
use App\Models\Sekolah; // Model Sekolah untuk akses ke data sekolah
use Illuminate\Support\Facades\Storage;

class JurnalKegiatanController extends Controller
{
    public function index()
    {
        $jurnal = JurnalKegiatan::where('user_id', auth()->user()->id)->get();

        return view('pages-user.jurnal-kegiatan', compact('jurnal'));
    }

    public function create()
    {
        return view('pages-user.tambah-jurnal');
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'nama' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'laporan_pkl' => 'nullable|file|mimes:pdf|max:2048',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $laporanPath = $request->file('laporan_pkl') ? $request->file('laporan_pkl')->store('laporan', 'public') : null;
        $fotoPath = $request->file('foto_kegiatan') ? $request->file('foto_kegiatan')->store('kegiatan', 'public') : null;

        JurnalKegiatan::create([
            // 'nama' => $request->nama,
            'kegiatan' => $request->kegiatan,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'laporan_pkl' => $laporanPath,
            'foto_kegiatan' => $fotoPath,
        ]);

        return redirect()->route('jurnal-kegiatan')->with('success', 'Jurnal kegiatan berhasil ditambahkan!');
    }

    public function showJurnalKegiatan()
    {
        // Mengambil semua jurnal yang dimiliki oleh siswa
        $jurnal = Jurnalkegiatan::all();

        // Mengirim data ke view siswa
        return view('jurnal-kegiatan', compact('jurnal'));
    }

    // Menampilkan data siswa dan sekolah di halaman industri
    public function showSiswaIndustri()
    {
        // Mengambil semua jurnal kegiatan beserta data siswa terkait
        $detailjurnal = JurnalKegiatan::with('user')->get();  // Mengambil jurnal dengan relasi ke user (siswa)
        dd($detailjurnal); // Memeriksa data yang diambil
        // Mengirim data jurnal ke view industri
        return view('jurnal-siswapkl', compact('detailjurnal'));
    }
    
    // Menampilkan detail jurnal kegiatan siswa berdasarkan ID
    public function showJurnalDetail($id)
    {
        // Mencari jurnal kegiatan berdasarkan ID
        $jurnal = Jurnalkegiatan::findOrFail($id);

        // Mengirim data ke view detail jurnal
        return view('detail-jurnal', compact('jurnal'));
    }
}
