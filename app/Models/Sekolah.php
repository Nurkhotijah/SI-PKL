<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

<<<<<<< HEAD
    // Kolom yang dapat diisi
    protected $fillable = [
        'nama_sekolah',
        'email',
        'alamat_sekolah',
        'password',
    ];
=======
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sekolah';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
    ];

    /**
     * Get the user that owns the sekolah.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
}
