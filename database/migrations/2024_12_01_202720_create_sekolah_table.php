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
<<<<<<< HEAD
            $table->string('nama');
            $table->text('alamat');
            $table->string('email')->unique();
            $table->string('foto_profil')->nullable();
            $table->timestamps();
        });
    }
    
=======
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->text('alamat');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
    public function down()
    {
        Schema::dropIfExists('sekolah');
    }
<<<<<<< HEAD
    
=======
>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
};
