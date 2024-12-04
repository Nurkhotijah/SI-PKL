<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Menampilkan daftar siswa
    public function index()
    {
        $siswas = Siswa::all();
        return view('pages-admin.pengajuan-siswa', compact('siswas'));
    }

    // Menampilkan form untuk menambah siswa
    public function create()
    {
        return view('pages-admin.tambah-siswa');
    }

    // Menyimpan data siswa baru
    public function store(Request $request)
    {
<<<<<<< HEAD
        dd($request->all());
        
=======
>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'cv' => 'nullable|file|mimes:pdf,doc,docx',
        ]);
<<<<<<< HEAD
    
=======

>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv');
        }
<<<<<<< HEAD
    
=======

>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
        Siswa::create([
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'cv' => $cvPath,
            'status' => 'Pending',
        ]);
<<<<<<< HEAD
    
        // Mengarahkan ke halaman yang sesuai
        return redirect()->route('pages-admin.pengajuan-siswa')->with('success', 'Siswa berhasil ditambahkan.');    }
    
=======

        // Mengarahkan ke halaman yang sesuai
        return redirect()->route('pages-admin.pengajuan-siswa')->with('success', 'Siswa berhasil ditambahkan.');
    }

>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4

    // Menghapus data siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('pengajuan-siswa')->with('success', 'Siswa berhasil dihapus.');
    }
}
