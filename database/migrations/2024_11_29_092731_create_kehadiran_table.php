<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKehadiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID pengguna yang absen
            $table->date('tanggal'); // Tanggal kehadiran
            $table->string('status'); 
            $table->time('waktu_masuk')->nullable(); // Waktu masuk (jika hadir)
            $table->time('waktu_keluar')->nullable(); // Waktu keluar (jika hadir)
            $table->string('foto_izin')->nullable(); // Foto bukti izin (jika izin)
            $table->string('foto_masuk')->nullable(); // Foto bukti absen masuk (jika hadir)
            $table->string('foto_keluar')->nullable(); // Foto bukti absen keluar (jika hadir)
            $table->timestamps(); // Created_at dan updated_at

            // Menambahkan foreign key constraint untuk user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kehadiran');
    }
}
