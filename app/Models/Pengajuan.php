<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengajuan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul_pkl',
        'tahun_ajaran',
        'tanggal_mulai_pkl',
        'tanggal_selesai_pkl',
        'jurusan',
        'pembimbing',
        'lampiran',
        'status_persetujuan',
        'id_sekolah',
    ];

    /**
     * Get the related school.
     */
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah');
    }
}
