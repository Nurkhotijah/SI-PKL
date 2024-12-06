<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'jurnal';

    // Kolom-kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'kegiatan',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'foto_kegiatan',
        'laporan_pkl',
        'user_id'
    ];

    // Relasi dengan tabel 'users' untuk ID User (Siswa)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id');
    }
}
