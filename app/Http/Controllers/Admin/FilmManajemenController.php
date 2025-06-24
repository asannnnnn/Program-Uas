<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmManajemenController extends Controller
{
    public function index()
    {
        $films = Film::all();
        return view('admin.managefilm', compact('films'));
    }

    public function create()
    {
        return view('admin.action.createfilm');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'duration' => 'required|integer',
            'sinopsis' => 'required',
            'rating' => 'required|string|max:10',
            'bintang' => 'required|integer|min:0|max:5',
            'age' => 'required|string|max:10',
            'trailer_url' => 'nullable|url',
            'poster' => 'required|image|max:2048', // ← WAJIB!
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        Film::create($validated);

        return redirect()->route('admin.managefilm')->with('success', 'Film berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $film = Film::findOrFail($id);
        return view('admin.action.editfilm', compact('film'));
    }

    public function update(Request $request, $id)
    {
        $film = Film::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'duration' => 'required|integer',
            'sinopsis' => 'required',
            'rating' => 'required|string|max:10',
            'bintang' => 'required|integer|min:0|max:5',
            'age' => 'required|string|max:10',
            'trailer_url' => 'nullable|url',
            'poster' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            if ($film->poster) {
                Storage::disk('public')->delete($film->poster);
            }
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $film->update($validated);

        return redirect()->route('admin.managefilm')->with('success', 'Film berhasil diupdate.');
    }

    public function destroy($id)
    {
        $film = Film::findOrFail($id);
        if ($film->poster) {
            Storage::disk('public')->delete($film->poster);
        }
        $film->delete();
        return redirect()->route('admin.managefilm')->with('success', 'Film berhasil dihapus.');
    }
}
