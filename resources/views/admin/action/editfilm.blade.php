@extends('layouts.admin')

@section('title', 'Edit Film')

@section('breadcrumb')
    Edit Film
@endsection

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow text-gray-800">
    <h2 class="text-2xl font-bold mb-6">✏️ Edit Film: {{ $film->title }}</h2>

    {{-- Error validasi --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4 border border-red-300">
            <ul class="list-disc ml-6">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.update.film', $film->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block font-semibold mb-1">🎬 Judul Film</label>
            <input type="text" name="title" id="judul" class="form-input w-full" value="{{ old('title', $film->title) }}" required>
        </div>

        <div>
            <label for="genre" class="block font-semibold mb-1">🎭 Genre</label>
            <input type="text" name="genre" id="genre" class="form-input w-full" value="{{ old('genre', $film->genre) }}" required>
        </div>

        <div>
            <label for="duration" class="block font-semibold mb-1">⏱ Durasi (menit)</label>
            <input type="number" name="duration" id="duration" class="form-input w-full" value="{{ old('duration', $film->duration) }}" required>
        </div>

        <div>
            <label for="sinopsis" class="block font-semibold mb-1">📖 Sinopsis</label>
            <textarea name="sinopsis" id="sinopsis" rows="4" class="form-textarea w-full" required>{{ old('sinopsis', $film->sinopsis) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="rating" class="block font-semibold mb-1">⭐ Rating</label>
                <input type="number" step="0.1" name="rating" id="rating" class="form-input w-full" value="{{ old('rating', $film->rating) }}" required>
            </div>

            <div>
                <label for="bintang" class="block font-semibold mb-1">🌟 Bintang</label>
                <input type="number" name="bintang" id="bintang" class="form-input w-full" value="{{ old('bintang', $film->bintang) }}" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="age" class="block font-semibold mb-1">🔞 Batas Usia</label>
                <input type="text" name="age" id="age" class="form-input w-full" value="{{ old('age', $film->age) }}" required>
            </div>

            <div>
                <label for="trailer_url" class="block font-semibold mb-1">🎥 Trailer</label>
                <input type="url" name="trailer_url" id="trailer_url" class="form-input w-full" value="{{ old('trailer_url', $film->trailer_url) }}" required>
            </div>
        </div>

        <div>
            <label for="poster" class="block font-semibold mb-1">🖼️ Ganti Poster (opsional)</label>
            <input type="file" name="poster" id="poster" accept="image/*" class="form-input w-full">
            <p class="text-sm text-gray-600 mt-1">Biarkan kosong jika tidak ingin mengganti poster.</p>
            @if($film->poster)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster" class="h-40 rounded shadow">
                </div>
            @endif
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium px-6 py-2 rounded-lg transition duration-200 shadow">
                💾 Update Film
            </button>
        </div>
    </form>
</div>
@endsection
