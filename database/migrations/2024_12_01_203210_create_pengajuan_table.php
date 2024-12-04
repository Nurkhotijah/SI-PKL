<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
<<<<<<< HEAD
{
    Schema::create('pengajuan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('siswa_id')->constrained('siswa');
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->string('cv_file');
        $table->enum('status_persetujuan', ['pending', 'diterima', 'ditolak'])->default('pending');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('pengajuan');
}

=======
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->string('nama');
            $table->string('jurusan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('cv_file');
            $table->enum('status_persetujuan', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();

            $table->foreign('id_sekolah')->references('id')->on('sekolah')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
};
