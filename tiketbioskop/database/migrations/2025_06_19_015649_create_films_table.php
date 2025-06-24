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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');                         // Judul Film
            $table->string('genre');                         // Genre
            $table->integer('duration');                     // Durasi (menit)
            $table->text('sinopsis')->nullable();            // Sinopsis Film
            $table->decimal('rating', 3, 1)->nullable();      // Rating (0.0 - 10.0)
            $table->integer('bintang')->nullable();          // Bintang (0-5)
            $table->string('age');                           // Batas usia (misal: 18+, 13+, dsb)
            $table->string('trailer')->nullable();           // URL YouTube trailer
            $table->string('poster_url')->nullable();        // Path file poster
            $table->boolean('is_recommended')->default(false); // Rekomendasi atau tidak
            $table->timestamps();                            // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
