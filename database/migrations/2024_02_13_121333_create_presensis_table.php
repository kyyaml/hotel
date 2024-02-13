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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id('id_absen');
            $table->unsignedBigInteger('id_pertemuan');
            $table->unsignedBigInteger('nis');
            $table->time('time');
            $table->enum('keterangan', ['hadir','izin']);
            $table->enum('status', ['proses', 'diterima', 'ditolak'])->default('proses');
            
            $table->timestamps();

            $table->foreign('id_pertemuan')->references('id_pertemuan')->on('pertemuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
