<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSiswa extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_siswa';

    protected $fillable = [
        'nama_siswa',
        'jurusan',
        'tanggal_mulai',
        'tanggal_selesai',
        'cv',
        'sekolah_id', // Menambahkan 'sekolah_id' ke dalam fillable
    ];

    // Relasi dengan model Sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
