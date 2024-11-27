<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('absens', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID user/siswa
        $table->enum('status', ['masuk', 'keluar'])->default('masuk');
        $table->timestamp('waktu')->useCurrent(); // Waktu absen
        $table->string('foto')->nullable(); // Kolom untuk menyimpan nama file foto
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absens');
    }
};
