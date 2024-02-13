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
        Schema::create('pertemuan', function (Blueprint $table) {
            $table->id('id_pertemuan');
            $table->string('judul_pertemuan');
            $table->string('kegiatan');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedBigInteger('id_ekstra');
            $table->timestamps();

            $table->foreign('id_ekstra')->references('id_ekstra')->on('ekstrakurikuler');
        });
    }

    /**x
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuan');
    }
};
