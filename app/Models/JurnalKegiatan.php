<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalKegiatan extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'jurnal_kegiatan';

    // Kolom-kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'kegiatan', 
        'tanggal', 
        'waktu_mulai', 
        'waktu_selesai', 
        'laporan_pkl', 
        'foto_kegiatan', 
        'id_sekolah', 
        'id_user'
    ];

    // Relasi dengan tabel 'users' untuk ID Sekolah
    public function sekolah()
    {
        return $this->belongsTo(User::class, 'id_sekolah');
    }

    // Relasi dengan tabel 'users' untuk ID User (Siswa)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
