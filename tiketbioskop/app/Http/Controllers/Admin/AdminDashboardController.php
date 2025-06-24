<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Studio;
use App\Models\JadwalTayang;

class AdminDashboardController extends Controller
{
    public function index()
{
    // Ambil semua film untuk fallback, jika perlu
    $films = Film::all()->keyBy('id');

    // Ambil jadwal dan relasi film-nya
    $jadwals = JadwalTayang::with('filmDetail')->get()->groupBy(function ($item) {
        return $item->tanggal . '|' . $item->film_id . '|' . $item->studio_id;
    });

    return view('admin.dashboard', compact('jadwals', 'films'));
}


    public function create()
    {
        $films = Film::all();
        $studios = Studio::all();

        return view('admin.action.createjadwal', compact('films', 'studios'));
    }

    public function store(Request $request)
    {
        $this->trimJamMulai($request);
$validated = $request->validate([
    'tanggal' => 'required|date',
    'film_id' => 'required|exists:films,id',
    'studio_id' => 'required|exists:studios,id',
    'jam_mulai' => 'required|array',
    'jam_mulai.*' => 'nullable|regex:/^\d{2}:\d{2}$/',
]);


        $film = Film::findOrFail($validated['film_id']);
        $studio = Studio::findOrFail($validated['studio_id']);

        foreach ($validated['jam_mulai'] as $jam) {
            if ($jam) {
                JadwalTayang::create([
    'tanggal' => $validated['tanggal'],
    'film_id' => $film->id,     
    'jam_mulai' => $jam,
    'studio_id' => $studio->id,
]);

            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = JadwalTayang::findOrFail($id);

       $jamList = JadwalTayang::where('tanggal', $jadwal->tanggal)
    ->where('film_id', $jadwal->film_id)
    ->where('studio_id', $jadwal->studio_id)
    ->orderBy('jam_mulai')
    ->pluck('jam_mulai')
    ->toArray();


        $films = Film::all();
        $studios = Studio::all();

       $filmId = $jadwal->film_id;
$studioId = $jadwal->studio_id;


        return view('admin.action.editjadwal', [
            'jadwal' => $jadwal,
            'jamMulaiList' => $jamList,
            'films' => $films,
            'studios' => $studios,
            'selectedFilmId' => $filmId,
            'selectedStudioId' => $studioId,
        ]);
    }

    public function update(Request $request, $id)
{
    $this->trimJamMulai($request);
    $validated = $request->validate([
        'tanggal' => 'required|date',
        'film_id' => 'required|exists:films,id',
        'studio_id' => 'required|exists:studios,id',
        'jam_mulai' => 'required|array',
        'jam_mulai.*' => 'nullable|date_format:H:i',
    ]);

    $film = Film::findOrFail($validated['film_id']);
    $studio = Studio::findOrFail($validated['studio_id']);

    $jadwalLama = JadwalTayang::findOrFail($id);

    // Ganti pakai film_id dan studio_id
    JadwalTayang::where('tanggal', $jadwalLama->tanggal)
        ->where('film_id', $jadwalLama->film_id)
        ->where('studio_id', $jadwalLama->studio_id)
        ->delete();

    foreach ($validated['jam_mulai'] as $jam) {
        if ($jam) {
            JadwalTayang::create([
                'tanggal' => $validated['tanggal'],
                'film_id' => $validated['film_id'],
                'jam_mulai' => $jam,
                'studio_id' => $validated['studio_id'],
            ]);
        }
    }

    return redirect()->route('admin.dashboard')->with('success', 'Jadwal berhasil diupdate.');
}


    // Helper method untuk trim detik jam_mulai sebelum validasi
    private function trimJamMulai(Request $request)
    {
        $input = $request->all();

        if (isset($input['jam_mulai']) && is_array($input['jam_mulai'])) {
            $input['jam_mulai'] = array_map(function ($time) {
                return $time ? substr($time, 0, 5) : null; // ambil jam dan menit saja (HH:MM)
            }, $input['jam_mulai']);

            // filter null atau kosong
            $input['jam_mulai'] = array_filter($input['jam_mulai'], fn($v) => !is_null($v) && $v !== '');
        }

        $request->merge($input);
    }
   public function destroy($id)
{
    $jadwal = JadwalTayang::findOrFail($id);

    // Ambil nilai film_id dari jadwal yang ingin dihapus
    $filmId = $jadwal->film_id;

    // Hapus semua jadwal yang punya film_id sama
    JadwalTayang::where('film_id', $filmId)->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Semua jadwal untuk film tersebut berhasil dihapus.');
}


}
