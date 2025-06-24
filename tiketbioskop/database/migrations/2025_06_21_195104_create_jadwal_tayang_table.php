<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwal_tayang', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel films
            $table->unsignedBigInteger('film_id');
            $table->foreign('film_id')
                  ->references('id')
                  ->on('films')
                  ->onDelete('cascade');

            // Relasi ke tabel studios
            $table->unsignedBigInteger('studio_id');
            $table->foreign('studio_id')
                  ->references('id')
                  ->on('studios')
                  ->onDelete('cascade');

            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai')->nullable(); // Boleh null
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_tayang');
    }
};
