<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalTayang extends Model
{
    protected $table = 'jadwal_tayang';

    protected $fillable = [
        'tanggal',
        'film_id',
        'jam_mulai',
        'jam_selesai',
        'studio_id',
    ];

    public function filmDetail()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function studioDetail()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }
}
