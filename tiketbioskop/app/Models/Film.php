<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'title', 'genre', 'duration', 'sinopsis', 'rating',
        'bintang', 'age', 'trailer_url', 'poster', 'is_recommended',
    ];
}
