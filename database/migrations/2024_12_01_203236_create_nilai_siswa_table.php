<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('nilai_siswa', function (Blueprint $table) {
        $table->id();
        $table->foreignId('siswa_id')->constrained('siswa');
        $table->integer('nilai');
        $table->text('umpan_balik')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('nilai_siswa');
}

};
