<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\PengajuanSiswaController;
use App\Http\Controllers\JurnalKegiatanController;
use App\Http\Controllers\SekolahController;


Route::get('/', function () {
    return view('welcome');
});

// Route login
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', function () {
    return view('auth.register');  // Menampilkan halaman registrasi
})->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');
// // Route lupa password 
// Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// INDUSTRI

Route::get('/dashboard-industri', [IndustriController::class, 'dashboard'])->name('industri.dashboard');

Route::get('/update-industri', [IndustriController::class, 'updateIndustri'])->name('update-industri');

Route::get('/kelola-kehadiran', [IndustriController::class, 'kelolaKehadiran'])->name('kelola-kehadiran');

// Rute untuk mengelola pengajuan
Route::get('/kelola-pengajuan', [IndustriController::class, 'kelolaPengajuan'])->name('kelola-pengajuan');

Route::get('/kelola-nilai', [IndustriController::class, 'kelolaNilai'])->name('kelola-nilai');

Route::get('/kehadiran-siswa', [IndustriController::class, 'kehadiranSiswa'])->name('kehadiran-siswa');

// Rute untuk jurnal siswa
Route::get('/jurnal-siswapkl', [IndustriController::class, 'jurnalSiswapkl'])->name('jurnal-siswapkl');

Route::get('/data-sekolah', [IndustriController::class, 'dataSekolah'])->name('data-sekolah');

Route::get('/lihat-siswa', [IndustriController::class, 'lihatSiswa'])->name('lihat-siswa');

Route::get('/kelola-pengajuansiswa', [IndustriController::class, 'kelolaPengajuansiswa'])->name('kelola-pengajuansiswa');

Route::get('/profile-industri', [IndustriController::class, 'profileIndustri'])->name('profile-industri');

Route::get('/pages-industri/edit-pengajuan/{id}', function ($id) {
    return view('pages-industri.edit-pengajuan', compact('id'));
})->name('edit-pengajuan');


Route::get('/pages-industri/edit-kehadiran/{id}', function ($id) {
    return view('pages-industri.edit-kehadiran', compact('id'));
})->name('edit-kehadiran');

Route::get('/pages-industri/tambah-kehadiran/{id}', function ($id) {
    return view('pages-industri.tambah-kehadiran', compact('id'));
})->name('tambah-kehadiran');

Route::get('/pages-industri/cetak-rekap/{id}', function ($id) {
    return view('pages-industri.cetak-rekap', compact('id'));
})->name('cetak-rekap');

Route::get('/pages-industri/edit-rekap/{id}', function ($id) {
    return view('pages-industri.edit-rekap', compact('id'));
})->name('edit-rekap');

Route::get('/pages-industri/tambah-rekap/{id}', function ($id) {
    return view('pages-industri.tambah-rekap', compact('id'));
})->name('tambah-rekap');

Route::get('/pages-industri/lihat-rekap/{id}', function ($id) {
    return view('pages-industri.lihat-rekap', compact('id'));
})->name('lihat-rekap');

Route::get('/pages-industri/hapus-rekap/{id}', function ($id) {
    return view('pages-industri.hapus-rekap', compact('id'));
})->name('hapus-rekap');


// Route::get('/pages-industri/edit-nilai/{id}', function ($id) {
//     return view('pages-industri.edit-nilai', compact('id'));
// })->name('edit-nilai');

// Route::get('/pages-industri/tambah-nilai/{id}', function ($id) {
//     return view('pages-industri.tambah-nilai', compact('id'));
// })->name('tambah-nilai');

// Route::get('/pages-industri/cetak-nilai/{id}', function ($id) {
//     return view('pages-industri.cetak-nilai', compact('id'));
// })->name('cetak-nilai');

// ADMIN

Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// Rute untuk mengelola kehadiran
Route::get('/kehadiran-siswapkl', [AdminController::class, 'kehadiranSiswapkl'])->name('kehadiran-siswapkl');

// Rute untuk mengelola pengajuan
Route::get('/pengajuan', [AdminController::class, 'pengajuan'])->name('pengajuan');

Route::get('/pengajuan-siswa', [PengajuanSiswaController::class, 'index'])->name('pengajuan-siswa');
Route::get('/tambah-siswa', [PengajuanSiswaController::class, 'create'])->name('tambah-siswa');
Route::post('/pengajuan-siswa/store', [PengajuanSiswaController::class, 'store'])->name('pengajuan-siswa.store');
Route::delete('/siswa/{id}', [PengajuanSiswaController::class, 'destroy'])->name('hapus-siswa');

Route::middleware(['auth'])->group(function () {
    // Menampilkan daftar pengajuan siswa
    
});

Route::get('/data-siswa', [AdminController::class, 'dataSiswa'])->name('data-siswa');

// Route::get('/tambah-siswa', [AdminController::class, 'tambahSiswa'])->name('tambah-siswa');

Route::get('/nilai-siswa', [AdminController::class, 'nilaiSiswa'])->name('nilai-siswa');

Route::get('/rekap-kehadiransiswa', [AdminController::class, 'rekapKehadiransiswa'])->name('rekap-kehadiransiswa');

// Rute untuk jurnal siswa
Route::get('/jurnal-siswa', [AdminController::class, 'jurnalSiswa'])->name('jurnal-siswa');

Route::get('/profile-admin', [AdminController::class, 'profileAdmin'])->name('profile-admin');
Route::get('/profile-update', [AdminController::class, 'profileUpdate'])->name('profile-update');


// Route::get('/edit-pengajuan', [AdminController::class, 'edit'])->name('edit-pengajuan');

// Route::get('/edit-Kehadiran', [AdminController::class, 'edit'])->name('edit-kehadiran');

// USER

Route::post('/absen/masuk', [AbsenController::class, 'absenMasuk']);
Route::post('/absen/keluar', [AbsenController::class, 'absenKeluar']);


Route::get('/dashboard-user', [UserController::class, 'dashboard'])->name('user.dashboard');

Route::get('/riwayat-kehadiran', [UserController::class, 'riwayatKehadiran'])->name('riwayat-kehadiran');

Route::middleware(['auth'])->group(function () {
    Route::get('/jurnal-kegiatan', [JurnalKegiatanController::class, 'index'])->name('jurnal-kegiatan');
    Route::get('/create', [JurnalKegiatanController::class, 'create'])->name('tambah-jurnal');
    Route::post('/store', [JurnalKegiatanController::class, 'store'])->name('jurnal-kegiatan.store');
    Route::get('/{id}', [JurnalKegiatanController::class, 'show'])->name('show');
    Route::delete('/{id}', [JurnalKegiatanController::class, 'destroy'])->name('destroy');
});
Route::get('/pengajuan-izin', [UserController::class, 'pengajuanizin'])->name('pengajuan-izin');

Route::get('/penilaian-pkl', [UserController::class, 'penilaianpkl'])->name('penilaian-pkl');

Route::get('/rekap-kehadiran', [UserController::class, 'rekapkehadiran'])->name('rekap-kehadiran');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');

Route::get('/update-profile', [ProfileController::class, 'edit'])->name('profile.update');

Route::get('/edit-izin', [UserController::class, 'editizin'])->name('edit-izin');

Route::get('/hapus-izin', [UserController::class, 'hapusizin'])->name('hapus-izin');

// Route untuk mengganti kata sandi
Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

