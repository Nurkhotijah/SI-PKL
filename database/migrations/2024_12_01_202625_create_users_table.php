<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
<<<<<<< HEAD
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('alamat')->nullable();
        $table->string('email')->unique();
        $table->string('password');
        $table->enum('role', ['siswa', 'sekolah', 'industri']);
        $table->string('foto_profil')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('users');
}

=======
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['siswa', 'sekolah', 'industri']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
};
