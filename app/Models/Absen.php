<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absen'; // Nama tabel di database
    protected $fillable = ['user_id', 'absen_masuk', 'absen_keluar'];
}
