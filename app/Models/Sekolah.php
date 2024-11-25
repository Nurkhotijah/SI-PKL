<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = [
        'nama_sekolah',
        'email',
        'alamat_sekolah',
        'password',
    ];
}
