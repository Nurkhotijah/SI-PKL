<?php

namespace App\Http\Controllers;
// use App\Models\Pengajuan;


use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('pages-admin.dashboard-admin');
    } public function kehadiranSiswapkl()  
    {
        // Logika untuk mengelola kehadiran
        return view('pages-admin.kehadiran-siswapkl'); 
    }

    public function pengajuan() 
    {
        // Logika untuk mengelola pengajuan
        return view('pages-admin.pengajuan'); 
    }
    
    public function pengajuanSiswa() 
    {
        // Logika untuk mengelola pengajuan
        return view('pages-admin.pengajuan-siswa'); 
    }

    public function tambahSiswa() 
    {
        // Logika untuk mengelola pengajuan
        return view('pages-admin.tambah-siswa'); 
        
    }
    
    public function dataSiswa() 
    {
        // Logika untuk mengelola pengajuan
        return view('pages-admin.data-siswa'); 
        
    }
    public function jurnalSiswa()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-admin.jurnal-siswa'); 
    }

    public function jurnalDetail()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-admin.jurnal-detail'); 
    }

    public function nilaiSiswa()
    {
       
        return view('pages-admin.nilai-siswa'); 
    }

    public function rekapKehadiransiswa()
    {
        
        return view('pages-admin.rekap-kehadiransiswa'); 
    }

    public function profileAdmin()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-admin.profile-admin'); 
    }

    public function profileUpdate()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-admin.profile-update'); 
    }

    public function pengajuanindex() 
    {
        // Logika untuk mengelola pengajuan
        return view('pages-admin.pengajuan.pengajuan-index'); 
        
    }

    public function lihatsiswa() 
    {
        // Logika untuk mengelola pengajuan
        return view('pages-admin.pengajuan.lihat-siswa'); 
        
    }

}
