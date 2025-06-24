@extends('layouts.admin')

@section('title', 'Tambah Film')

@section('breadcrumb')
    Tambah Film
@endsection

@section('content')
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-lg text-gray-800 dark:text-gray-100">
        <h2 class="text-2xl font-bold mb-6">📝 Form Tambah Film</h2>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 border border-green-300 dark:bg-green-900 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error validasi --}}
        @if($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4 border border-red-300 dark:bg-red-900 dark:text-red-200">
                <ul class="list-disc ml-6">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('admin.store.film') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="title" class="block font-semibold mb-1">🎬 Judul Film</label>
                <input type="text" name="title" id="title" class="form-input w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:ring focus:ring-primary-500" value="{{ old('title') }}" required>
            </div>

            <div>
                <label for="genre" class="block font-semibold mb-1">🎭 Genre</label>
                <input type="text" name="genre" id="genre" class="form-input w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2" value="{{ old('genre') }}" required>
            </div>

            <div>
                <label for="duration" class="block font-semibold mb-1">⏱ Durasi (menit)</label>
                <input type="number" name="duration" id="duration" min="1" class="form-input w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2" value="{{ old('duration') }}" required>
            </div>

            <div>
                <label for="sinopsis" class="block font-semibold mb-1">📖 Sinopsis</label>
                <textarea name="sinopsis" id="sinopsis" rows="4" class="form-textarea w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:ring focus:ring-primary-500" required>{{ old('sinopsis') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="rating" class="block font-semibold mb-1">⭐ Rating (0-10)</label>
                    <input type="number" step="0.1" max="10" min="0" name="rating" id="rating" class="form-input w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2" value="{{ old('rating') }}" required>
                </div>

                <div>
                    <label for="bintang" class="block font-semibold mb-1">🌟 Bintang (0-5)</label>
                    <input type="number" name="bintang" id="bintang" min="0" max="5" class="form-input w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2" value="{{ old('bintang') }}" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="age" class="block font-semibold mb-1">🔞 Batas Usia</label>
                    <input type="text" name="age" id="age" class="form-input w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2" value="{{ old('age') }}" required>
                </div>

                <div>
                    <label for="trailer_url" class="block font-semibold mb-1">🎥 Link Trailer (YouTube)</label>
                    <input type="url" name="trailer" id="trailer_url" class="form-input w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2" value="{{ old('trailer_url') }}" required>
                </div>
            </div>

            <div>
                <label for="poster" class="block font-semibold mb-1">🖼️ Poster Film</label>
                <input type="file" name="poster" id="poster" accept="image/*" class="form-input w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2" required>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-medium px-6 py-2 rounded-lg transition duration-200 shadow">
                    Simpan Film
                </button>
            </div>
        </form>
    </div>
@endsection
