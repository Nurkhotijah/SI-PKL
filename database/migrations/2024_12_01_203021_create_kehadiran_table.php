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
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
