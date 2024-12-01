<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
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

};
