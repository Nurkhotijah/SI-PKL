<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'tanggal', 
        'status_kehadiran', 
        'waktu_masuk', 
        'waktu_keluar', 
        'foto_izin',
        'foto_masuk',
        'foto_keluar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

