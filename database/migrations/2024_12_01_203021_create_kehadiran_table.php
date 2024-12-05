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
<<<<<<< HEAD
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->date('tanggal'); // Tanggal kehadiran
            $table->time('waktu_masuk')->nullable(); // Waktu masuk
            $table->time('waktu_keluar')->nullable(); // Waktu keluar
            $table->enum('status', ['hadir', 'izin', 'tidak hadir'])->default('hadir'); // Status kehadiran
            $table->string('foto_masuk')->nullable(); // Foto saat masuk
            $table->string('foto_keluar')->nullable(); // Foto saat keluar
            $table->string('foto_izin')->nullable(); // Foto bukti izin
=======
<<<<<<< HEAD
            $table->foreignId('siswa_id')->constrained('siswa');
=======
>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal');
            $table->time('waktu_masuk')->nullable();
            $table->time('waktu_keluar')->nullable();
            $table->enum('status', ['hadir', 'izin', 'tidak hadir'])->default('hadir');
<<<<<<< HEAD
            $table->string('foto_izin')->nullable();
            $table->string('foto_masuk')->nullable();
            $table->string('foto_keluar')->nullable();
=======
            $table->string('foto')->nullable();
>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
>>>>>>> df323360b582fd69d2e2a877035dac20917ed5c4
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }
<<<<<<< HEAD
    
=======

>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
    public function down()
    {
        Schema::dropIfExists('kehadiran');
    }
<<<<<<< HEAD
    
=======
>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
};
