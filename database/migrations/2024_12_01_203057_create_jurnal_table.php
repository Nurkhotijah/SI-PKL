<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
<<<<<<< HEAD
{
    Schema::create('jurnal', function (Blueprint $table) {
        $table->id();
        $table->foreignId('siswa_id')->constrained('siswa');
        $table->text('kegiatan');
        $table->date('tanggal');
        $table->time('waktu_mulai');
        $table->time('waktu_selesai');
        $table->string('foto_kegiatan')->nullable();
        $table->string('laporan_file')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('jurnal');
}

=======
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('kegiatan');
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('foto_kegiatan')->nullable();
            $table->string('laporan_file')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jurnal');
    }
>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
};
