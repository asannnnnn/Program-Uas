<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Studio;

class StudioManajemenController extends Controller
{
    public function index()
    {
        $studios = Studio::all();
        return view('admin.managestudio', compact('studios'));
    }

    public function create()
    {
        return view('admin.action.createstudio');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Studio::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.managestudio')->with('success', 'Studio berhasil ditambahkan!');
    }

    public function destroy($id)
{
    $studio = Studio::findOrFail($id);
    $studio->delete();

    return redirect()->route('admin.managestudio')->with('success', 'Studio berhasil dihapus.');
}
}
