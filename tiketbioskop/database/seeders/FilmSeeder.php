<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;

class FilmSeeder extends Seeder
{
    public function run(): void
    {
        Film::create([
            'title' => 'Avengers: Endgame',
            'genre' => 'Action',
            'duration' => 181,
            'age' => 'dewasa',
            'poster' => '',
            'rating' => 8.5,
             'trailer_url' => 'https://www.youtube.com/embed/YoHD9XEInc0',
            'description' => 'Film tentang avanger.',
            'is_recommended' => true,
        ]);

        Film::create([
            'title' => 'Coco',
            'genre' => 'Animation',
            'duration' => 105,
            'age' => 'semua',
            'poster' => '',
            'rating' => 8.4,
            'trailer_url' => 'https://www.youtube.com/embed/A0azOIk0Kvg',
            'description' => 'Coco adalah film animasi-komputer fantasi 3D Amerika Serikat tahun 2017 yang diproduksi oleh Pixar Animation Studios, Darla K. Anderson sebagai produser dan dirilis oleh Walt Disney Pictures.[3] Cerita ini disutradarai oleh Lee Unkrich dan Adrian Molina, Lee Unkrich yang memiliki ide orisinal sementara Adrian Molina yang menulis skenario.[4] Film ini diisi oleh suara Anthony Gonzalez, Gael García Bernal, Benjamin Bratt, Renée Victor, dan Ana Ofelia Murguía. Film ini dirilis di Amerika Serikat pada tanggal 22 November 2017 dan di Indonesia pada tanggal 24 November 2017.[5]',
            'is_recommended' => false,
        ]);
    }
}
