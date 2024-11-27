<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('pengajuan_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('jurusan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('cv'); // Menyimpan path file CV
            $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
            $table->foreignId('id_sekolah') // Menggunakan id_sekolah, bukan sekolah_id
                ->constrained('users')
                ->onDelete('cascade'); // Kolom untuk ID Sekolah, mengacu ke tabel users

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan_siswa');
    }
}
