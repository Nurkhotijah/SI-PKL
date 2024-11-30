<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\JurnalKegiatan;

class JurnalKegiatanController extends Controller
{
    public function index()
{
    // Mendapatkan data pengguna yang login
    $users = Auth::user();

    // Mengambil semua jurnal kegiatan berdasarkan ID sekolah dan ID user
    $jurnal = JurnalKegiatan::where('id_sekolah', $users->id)
                             ->where('id_user', $users->id)
                             ->get();

    return view('pages-user.jurnal-kegiatan', compact('jurnal'));
}

    public function create()
    {
        return view('pages-user.tambah-jurnal');
    }

    public function store(Request $request)
{
    // Validasi input dari form
    $request->validate([
        'kegiatan' => 'required|string|max:100',
        'tanggal' => 'required|date',
        'waktu_mulai' => 'required',
        'waktu_selesai' => 'required',
        'laporan_pkl' => 'nullable|file|mimes:pdf|max:5000',
        'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
    ]);

    // Mendapatkan data pengguna yang login
    $users = Auth::user();

    // Menyimpan file laporan PKL jika ada
    $laporanPath = $request->file('laporan_pkl') ? $request->file('laporan_pkl')->store('laporan', 'public') : null;
    // Menyimpan file foto kegiatan jika ada
    $fotoPath = $request->file('foto_kegiatan') ? $request->file('foto_kegiatan')->store('kegiatan', 'public') : null;

    // Menyimpan data jurnal kegiatan ke dalam database
    JurnalKegiatan::create([
        'kegiatan' => $request->kegiatan,
        'tanggal' => $request->tanggal,
        'waktu_mulai' => $request->waktu_mulai,
        'waktu_selesai' => $request->waktu_selesai,
        'laporan_pkl' => $laporanPath,
        'foto_kegiatan' => $fotoPath,
        'id_user' => $users->id,  // ID pengguna yang login (siswa)
        'id_sekolah' => $users->id_sekolah,  // ID sekolah yang terkait dengan pengguna
    ]);

    // Redirect ke halaman jurnal kegiatan dengan pesan sukses
    return redirect()->route('jurnal-kegiatan')->with('success', 'Jurnal kegiatan berhasil ditambahkan!');
}
    public function show($id)
    {
        $jurnal = JurnalKegiatan::findOrFail($id);
        return view('pages-user.jurnal-kegiatan', compact('jurnal'));
    }

    public function edit($id)
    {
        $jurnal = JurnalKegiatan::findOrFail($id);
        return view('pages-user.edit-jurnal', compact('jurnal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kegiatan' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'laporan_pkl' => 'nullable|file|mimes:pdf|max:5000',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        $jurnal = JurnalKegiatan::findOrFail($id);

        // Update file jika ada
        if ($request->hasFile('laporan_pkl')) {
            if ($jurnal->laporan_pkl) {
                Storage::disk('public')->delete($jurnal->laporan_pkl);
            }
            $jurnal->laporan_pkl = $request->file('laporan_pkl')->store('laporan', 'public');
        }

        if ($request->hasFile('foto_kegiatan')) {
            if ($jurnal->foto_kegiatan) {
                Storage::disk('public')->delete($jurnal->foto_kegiatan);
            }
            $jurnal->foto_kegiatan = $request->file('foto_kegiatan')->store('kegiatan', 'public');
        }

        $jurnal->update([
            'kegiatan' => $request->kegiatan,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()->route('jurnal-kegiatan')->with('success', 'Jurnal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jurnal = JurnalKegiatan::findOrFail($id);

        // Hapus file laporan jika ada
        if ($jurnal->laporan_pkl) {
            Storage::disk('public')->delete($jurnal->laporan_pkl);
        }

        // Hapus file foto jika ada
        if ($jurnal->foto_kegiatan) {
            Storage::disk('public')->delete($jurnal->foto_kegiatan);
        }

        $jurnal->delete();

        return redirect()->route('jurnal-kegiatan')->with('success', 'Jurnal kegiatan berhasil dihapus!');
    }

    public function uploadLaporan(Request $request, $id)
    {
        $request->validate([
            'laporan_pkl' => 'required|file|mimes:pdf|max:5000',
        ]);

        $jurnal = JurnalKegiatan::findOrFail($id);

        // Hapus file lama jika ada
        if ($jurnal->laporan_pkl) {
            Storage::disk('public')->delete($jurnal->laporan_pkl);
        }

        // Simpan file baru
        $laporanPath = $request->file('laporan_pkl')->store('laporan', 'public');

        $jurnal->update([
            'laporan_pkl' => $laporanPath,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil diunggah!');
    }
}
