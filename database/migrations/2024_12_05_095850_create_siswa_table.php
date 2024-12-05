<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('id_sekolah'); // Foreign key ke tabel sekolah
            $table->unsignedBigInteger('id_pengajuan'); // Foreign key ke tabel pengajuan
            $table->string('nama_siswa'); // Nama siswa
            $table->string('jurusan'); // Jurusan siswa
            $table->string('pembimbing'); // Nama pembimbing
            $table->date('tanggal_mulai_pkl'); // Tanggal mulai PKL
            $table->date('tanggal_selesai_pkl'); // Tanggal selesai PKL
            $table->string('cv'); // CV (file)
            $table->enum('status_pengajuan', ['pending', 'diterima', 'ditolak'])->default('pending'); // Status pengajuan
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_sekolah')
                ->references('id')
                ->on('sekolah')
                ->onDelete('cascade');

            $table->foreign('id_pengajuan')
                ->references('id')
                ->on('pengajuan')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswa');
    }
};
