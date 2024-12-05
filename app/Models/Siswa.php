<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa'; // Nama tabel di database

    protected $fillable = [
        'id_sekolah',
        'id_pengajuan',
        'nama_siswa',
        'jurusan',
        'pembimbing',
        'tanggal_mulai_pkl',
        'tanggal_selesai_pkl',
        'cv',
        'status_pengajuan',
    ]; // Kolom-kolom yang dapat diisi secara mass assignment

    /**
     * Relasi ke model Sekolah.
     * Satu siswa memiliki satu sekolah.
     */
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah');
    }

    /**
     * Relasi ke model Pengajuan.
     * Satu siswa memiliki satu pengajuan.
     */
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }

    /**
     * Scope untuk memfilter siswa berdasarkan status pengajuan.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_pengajuan', $status);
    }
}
