<?php

namespace App\Http\Controllers;

use App\Models\JurnalKegiatan;
use App\Models\PengajuanSiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndustriController extends Controller
{
    public function UpdateIndustri()
    {
        // Logika untuk menampilkan 
        return view('pages-industri.update-industri');
    }
    public function dashboard()
    {
        return view('pages-industri.dashboard-industri');
    }
    public function kelolaKehadiran()
    {
        // Logika untuk mengelola kehadiran
        return view('pages-industri.kelola-kehadiran');
    }

    public function dataSekolah()
    {
        $listSekolah = User::where('role', 'sekolah')->get();

        return view('pages-industri.data-sekolah', compact('listSekolah'));
    }

    public function lihatSiswa($id)
    {
        $listSiswa = PengajuanSiswa::where('id_sekolah', $id)->get();

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

        $pengajuanSiswa = PengajuanSiswa::where('id', $id)->first();

        PengajuanSiswa::where('id', $id)->update(['status' => $status]);

        User::create([
            'name' => $pengajuanSiswa->nama_siswa,
            'email' => preg_replace('/\s+/', '-', $pengajuanSiswa->nama_siswa) . '@gmail.com',
            'alamat' => null,
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);

        // Kembalikan response sukses
        return response()->json([
            'success' => 200,
            'message' => "Status siswa telah diperbarui menjadi {$status}.",
        ]);
    }

    // Fungsi untuk membuat akun siswa setelah pengajuan disetujui
    protected function createSiswaAccount(PengajuanSiswa $pengajuanSiswa)
    {
        // Membuat akun siswa baru
        $user = User::create([
            'name' => $pengajuanSiswa->nama_siswa,
            'email' => $pengajuanSiswa->nama_siswa . '@gmail.com', // Contoh: email berdasarkan nama siswa
            'password' => bcrypt('siswa123'), // Password default atau bisa diset sesuai kebutuhan
            'role' => 'siswa', // Menandakan bahwa role-nya adalah siswa
            'id_sekolah' => $pengajuanSiswa->id_sekolah, // Menyimpan ID sekolah dari siswa
        ]);
    }

    public function jurnalSiswapkl()
    {
        // Mendapatkan data user yang sedang login
        $users = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Cek apakah pengguna memiliki relasi 'sekolah' dan id_sekolah ada
        if (!$users || !$users->id_user) {
            return redirect()->route('login')->with('error', 'Pengguna tidak memiliki data sekolah.');
        }

        // Mendapatkan data jurnal berdasarkan ID sekolah dan ID user (siswa)
        $listjurnal = JurnalKegiatan::where('id_sekolah', $users->id_sekolah) // Filter berdasarkan ID sekolah
            ->where('id_user', $users->id) // Filter berdasarkan ID user (siswa)
            ->get();

        // Mengirim data jurnal ke tampilan
        return view('pages-industri.jurnal-siswapkl', compact('listjurnal'));
    }


    public function detailJurnal($sekolahId, $userId)
    {
        // Cek apakah ID sekolah dan ID user valid
        if (!$sekolahId || !$userId) {
            return redirect()->route('dataSekolah')->with('error', 'Data tidak ditemukan.');
        }

        // Mendapatkan data jurnal berdasarkan ID sekolah dan ID user yang dipilih
        $listdetail = JurnalKegiatan::where('id_sekolah', $sekolahId)
            ->where('id_user', $userId)
            ->get();

        // Mengirim data detail jurnal ke tampilan
        return view('pages-industri.detail-jurnal', compact('listdetail'));
    }

    public function kelolaPengajuansiswa()
    {
        // Logika untuk mengelola kehadiran
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
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.profile-industri');
    }

    public function editPengajuan()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.edit-pengajuan');
    }

    //REKAP KEHADIRAN SISWA


    public function lihatKehadiran()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.lihat-rekap');
    }

    public function HapusKehadiran()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.hapus-rekap');
    }

    public function editKehadiran()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.edit-rekap');
    }

    public function tambahKehadiran()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.tambah-rekap');
    }

    public function cetakKehadiran()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.cetak-rekap');
    }

    //KELOLA NILAI

    // public function editNilai()
    // {
    //     // Logika untuk menampilkan jurnal siswa
    //     return view('pages-industri.edit-nilai'); 
    // }

    // public function tambahNilai()
    // {
    //     // Logika untuk menampilkan jurnal siswa
    //     return view('pages-industri.tambah-nilai'); 
    // }

    // public function cetakNilai()
    // {
    //     // Logika untuk menampilkan jurnal siswa
    //     return view('pages-industri.cetak-nilai'); 
    // }
}
