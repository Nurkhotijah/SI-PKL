<?php

namespace App\Http\Controllers;

use App\Models\JurnalKegiatan;
use App\Models\PengajuanSiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function kelolaPengajuansiswa()
    {
        // Logika untuk mengelola kehadiran
        return view('pages-industri.kelola-pengajuansiswa');
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


    public function jurnalSiswapkl($id)
    {
        $users = Auth::user(); // Mendapatkan data pengguna yang sedang login
    
        // Mengambil data jurnal kegiatan berdasarkan ID sekolah pengguna yang sedang login
        $listjurnal = JurnalKegiatan::where('id_sekolah', $users->id_sekolah)
                                     ->where('id_user', $users->id)
                                     ->get();
    
        // Mengirimkan data jurnal ke tampilan
        return view('pages-industri.jurnal-siswapkl', compact('listjurnal'));
    }
    public function detailJurnal($id)
{
    $users = Auth::user(); // Mendapatkan data pengguna yang sedang login
    
    // Mengambil data jurnal kegiatan berdasarkan ID pengguna yang sedang login
    $listdetail = JurnalKegiatan::where('id_user', $users->id) // Berdasarkan ID pengguna (siswa) yang sedang login
                                ->get();
    
    // Mengirimkan data detail jurnal ke tampilan
    return view('pages-industri.detail-jurnal', compact('listdetail'));
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
