<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalKegiatanTable extends Migration
{
    public function up()
{
    Schema::create('jurnal_kegiatan', function (Blueprint $table) {
        $table->id();
        $table->string('kegiatan');
        $table->date('tanggal');
        $table->time('waktu_mulai');
        $table->time('waktu_selesai');
        $table->string('laporan_pkl')->nullable();
        $table->string('foto_kegiatan')->nullable();
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('jurnal_kegiatan');
    }
}
