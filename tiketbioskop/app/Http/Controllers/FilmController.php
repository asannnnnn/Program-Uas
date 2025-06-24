<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\JadwalTayang;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function userDashboard(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter');

        $jadwal = JadwalTayang::with('filmDetail')
            ->when($search, function ($query, $search) {
                $query->whereHas('filmDetail', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                });
            })
            ->get()
            ->unique('film'); // Pastikan 'film' adalah field yang konsisten (ID atau judul)

        // Ambil data film dari relasi
        $films = $jadwal->map->filmDetail->filter();

        if ($filter === 'top_rated') {
            $films = $films->sortByDesc('rating');
        }

        return view('user.dashboard', compact('films'));
    }

    public function showTrailer($id)
    {
        $film = Film::findOrFail($id);
        return view('user.trailer', compact('film'));
    }

    public function booking($id)
{
    $film = Film::findOrFail($id);

    // Ambil semua jadwal tayang berdasarkan ID film
    $group = JadwalTayang::where('film_id', $film->id)->get();

    return view('user.booking', compact('film', 'group'));
}

}
