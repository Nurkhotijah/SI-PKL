<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('data_sekolah_request', function (Blueprint $table) {
        $table->id();
        $table->foreignId('industri_id')->constrained('industri');
        $table->foreignId('sekolah_id')->constrained('sekolah');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('data_sekolah_request');
}

};
