<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalKegiatanTable extends Migration
{
    public function up()
    {
        Schema::create('jurnal_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('kegiatan');
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('laporan_pkl')->nullable();
            $table->string('foto_kegiatan')->nullable();
            $table->foreignId('id_sekolah') // Menggunakan id_sekolah, bukan sekolah_id
                ->constrained('users')
                ->onDelete('cascade'); // Kolom untuk ID Sekolah, mengacu ke tabel users
                $table->foreignId('id_user') // Menggunakan id_sekolah, bukan sekolah_id
                ->constrained('users')
                ->onDelete('cascade'); // Kolom untuk ID Sekolah, mengacu ke tabel users
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('jurnal_kegiatan');
    }
}
