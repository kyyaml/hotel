<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member_ekstra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ekstra');
            $table->unsignedBigInteger('nis');

            $table->timestamps();
            
            // Menambahkan foreign key ke tabel siswa
            $table->foreign('nis')->references('nis')->on('siswa');

            // Menambahkan foreign key ke tabel ekstrakurikuler
            $table->foreign('id_ekstra')->references('id_ekstra')->on('ekstrakurikuler');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_ekstra');
    }
};
