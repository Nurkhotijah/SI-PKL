<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\JurnalKegiatan;
use App\Models\Pengajuan;
use App\Models\PengajuanSiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndustriController extends Controller
{
    public function UpdateIndustri()
    {
        return view('pages-industri.update-industri');
    }

    public function dashboard()
    {
        return view('pages-industri.dashboard-industri');
    }

    public function kelolaKehadiran()
    {
        return view('pages-industri.kelola-kehadiran');
    }

    public function dataSekolah()
    {
        $listSekolah = User::where('role', 'sekolah')->get();
        return view('pages-industri.data-sekolah', compact('listSekolah'));
    }

    public function lihatSiswa($id)
    {
        $listSiswa = Pengajuan::where('id_sekolah', $id)->get();
        return view('pages-industri.lihat-siswa', compact('listSiswa'));
    }

    public function updateStatusSiswa(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $id = $validated['id'];
        $status = $validated['status'];

        $pengajuanSiswa = Pengajuan::where('id', $id)->first();
        Pengajuan::where('id', $id)->update(['status' => $status]);

        User::create([
            'name' => $pengajuanSiswa->nama_siswa,
            'email' => preg_replace('/\s+/', '-', $pengajuanSiswa->nama_siswa) . '@gmail.com',
            'alamat' => null,
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);

        return response()->json([
            'success' => 200,
            'message' => "Status siswa telah diperbarui menjadi {$status}.",
        ]);
    }

    protected function createSiswaAccount(Pengajuan $pengajuanSiswa)
    {
        $user = User::create([
            'name' => $pengajuanSiswa->nama_siswa,
            'email' => $pengajuanSiswa->nama_siswa . '@gmail.com',
            'password' => bcrypt('siswa123'),
            'role' => 'siswa',
            'id_sekolah' => $pengajuanSiswa->id_sekolah,
        ]);
    }

    public function kelolaPengajuansiswa()
    {
        return view('pages-industri.kelola-pengajuansiswa');
    }

    public function kelolaNilai()
    {
        return view('pages-industri.kelola-nilai');
    }

    public function kehadiranSiswa()
    {
        return view('pages-industri.kehadiran-siswa');
    }

    public function profileindustri()
    {
        return view('pages-industri.profile-industri');
    }

    public function editPengajuan()
    {
        return view('pages-industri.edit-pengajuan');
    }

    public function lihatKehadiran()
    {
        return view('pages-industri.lihat-rekap');
    }

    public function HapusKehadiran()
    {
        return view('pages-industri.hapus-rekap');
    }

    public function editKehadiran()
    {
        return view('pages-industri.edit-rekap');
    }

    public function tambahKehadiran()
    {
        return view('pages-industri.tambah-rekap');
    }

    public function cetakKehadiran()
    {
        return view('pages-industri.cetak-rekap');
    }
}
