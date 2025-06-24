<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamTayang extends Model
{
    use HasFactory;

    protected $table = 'jam_tayangs'; // atau sesuaikan jika tabelnya bernama lain

    protected $fillable = ['jam']; // isi field yang bisa diisi
}
