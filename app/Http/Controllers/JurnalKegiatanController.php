<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurnalKegiatan;
use Illuminate\Support\Facades\Storage;

class JurnalKegiatanController extends Controller
{
    public function index()
    {
        $jurnal = JurnalKegiatan::all();
        return view('pages-user.jurnal-kegiatan', compact('jurnal'));
    }

    public function create()
    {
        return view('pages-user.tambah-jurnal');
    }

    public function store(Request $request)
    {
        $request->validate([
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
            'kegiatan' => $request->kegiatan,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'laporan_pkl' => $laporanPath,
            'foto_kegiatan' => $fotoPath,
        ]);

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
    return view('pages-user.edit-jurnal', compact('jurnal')); // Pastikan view ini benar
}

public function update(Request $request, $id)
{
    $request->validate([
        'kegiatan' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'waktu_mulai' => 'required',
        'waktu_selesai' => 'required',
        'laporan_pkl' => 'nullable|file|mimes:pdf|max:2048',
        'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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

    // Update data lain
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

        if ($jurnal->laporan_pkl) {
            Storage::disk('public')->delete($jurnal->laporan_pkl);
        }

        if ($jurnal->foto_kegiatan) {
            Storage::disk('public')->delete($jurnal->foto_kegiatan);
        }

        $jurnal->delete();

        return redirect()->route('pages-user.jurnal-kegiatan')->with('success', 'Jurnal kegiatan berhasil dihapus!');
    }
}