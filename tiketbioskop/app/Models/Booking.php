<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

protected $fillable = ['film_id', 'bioskop', 'jam_tayang_id', 'kursi', 'payment_method', 'payment_status'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function jadwal()
{
    return $this->belongsTo(JamTayang::class, 'jam_tayang_id');
}
}
