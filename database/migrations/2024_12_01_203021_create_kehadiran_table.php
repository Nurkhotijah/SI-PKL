<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->date('tanggal'); // Tanggal kehadiran
            $table->time('waktu_masuk')->nullable(); // Waktu masuk
            $table->time('waktu_keluar')->nullable(); // Waktu keluar
            $table->enum('status', ['hadir', 'izin', 'tidak hadir'])->default('hadir'); // Status kehadiran
            $table->string('foto_masuk')->nullable(); // Foto saat masuk
            $table->string('foto_keluar')->nullable(); // Foto saat keluar
            $table->string('foto_izin')->nullable(); // Foto bukti izin
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kehadiran');
    }

};
