<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalKegiatan extends Model
{
    use HasFactory;

    protected $table = 'jurnal_kegiatan';

    protected $fillable = [
        'nama',
        'kegiatan',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'laporan_pkl',
        'foto_kegiatan',
    ];
}
