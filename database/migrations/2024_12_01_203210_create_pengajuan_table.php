<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
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
            $table->id(); // Primary key
            $table->string('judul_pkl'); // Judul PKL
            $table->string('tahun_ajaran'); // Tahun Ajaran
            $table->date('tanggal_mulai_pkl'); // Tanggal Mulai PKL
            $table->date('tanggal_selesai_pkl'); // Tanggal Selesai PKL
            $table->string('jurusan'); // Jurusan
            $table->string('pembimbing'); // Nama Pembimbing
            $table->string('lampiran'); // File PDF surat permohonan PKL
            $table->enum('status_persetujuan', ['pending', 'diterima', 'ditolak'])->default('pending'); // Status persetujuan
            $table->unsignedBigInteger('id_sekolah'); // Foreign key ke tabel sekolah
            $table->timestamps(); // created_at dan updated_at

            // Foreign key constraint
            $table->foreign('id_sekolah')
                ->references('id')
                ->on('sekolah')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
<<<<<<< HEAD
}
=======
>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
};
>>>>>>> df323360b582fd69d2e2a877035dac20917ed5c4
