<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('sekolah', function (Blueprint $table) {
        $table->id();
        $table->string('nama_sekolah');
        $table->string('email')->unique(); // Tambahkan kolom email untuk login
        $table->string('alamat_sekolah');
        $table->string('password'); // Kolom untuk password
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('sekolah');
}

};
