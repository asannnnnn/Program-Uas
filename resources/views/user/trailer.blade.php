@extends('layouts.app')

@section('content')
<body class="bg-gray-900 font-sans text-white">
<div class="max-w-6xl mx-auto px-4 py-12 flex flex-col md:flex-row md:justify-between md:items-start gap-12">
    {{-- LEFT: Poster, Title, Genre, Buttons --}}
    <div class="flex flex-col items-center md:items-start md:w-1/2">
        {{-- Poster --}}
        @if($film->poster)
            <div class="relative group">
                <img src="{{ Str::startsWith($film->poster, ['http://', 'https://']) ? $film->poster : asset('storage/' . $film->poster) }}" 
                    alt="{{ $film->title }} poster" 
                    class="w-full max-w-[350px] h-[450px] object-cover rounded-xl shadow-2xl transition duration-300 group-hover:opacity-90">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 rounded-xl"></div>
            </div>
        @endif

        {{-- Title --}}
        <h1 class="mt-6 text-4xl font-bold leading-tight bg-gradient-to-r from-red-500 to-purple-500 bg-clip-text text-transparent">
            {{ $film->title }}
        </h1>

        {{-- Genre, Duration, Rating --}}
        <div class="mt-4 flex items-center gap-6">
            <div class="flex items-center gap-2 text-lg text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span class="text-white">{{ $film->genre }}</span>
            </div>
            <div class="flex items-center gap-2 text-lg text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-white">{{ $film->duration }} Menit</span>
            </div>
            <span class="px-3 py-1 rounded-full text-sm font-bold 
                {{ $film->age === 'dewasa' ? 'bg-red-900/50 text-red-400' : 'bg-blue-900/50 text-blue-400' }}">
                {{ $film->age }}+
            </span>
        </div>

        {{-- Buttons --}}
        <div class="mt-10 flex flex-col gap-4 w-full max-w-[350px]">
            <a href="{{ route('film.booking', $film->id)}}" 
                class="py-3 rounded-full text-black bg-gradient-to-r from-lime-400 to-lime-500 font-bold shadow-lg hover:from-lime-500 hover:to-lime-600 hover:shadow-xl transition duration-300 text-center transform hover:scale-105">
                🎟️ Pesan Sekarang
            </a>
        </div>
    </div>

    {{-- RIGHT: Trailer and Description --}}
    <div class="md:w-1/2">
        <h2 class="text-3xl font-bold mb-6 bg-gradient-to-r from-red-500 to-purple-500 bg-clip-text text-transparent">
            Trailer
        </h2>

        {{-- Trailer (if available) --}}
        @if($film->trailer_url)
            <div class="aspect-video mb-8 rounded-xl overflow-hidden shadow-2xl transform transition hover:scale-[1.01]">
                <iframe class="w-full h-full" src="{{ $film->trailer_url }}" 
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen></iframe>
            </div>
        @else
            <div class="mb-8 p-6 bg-gray-800/50 rounded-xl border border-gray-700 flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <h3 class="text-xl font-bold text-red-400">Trailer Tidak Tersedia</h3>
                    <p class="text-gray-400">
                        {{ $film->trailer_url ?? 'Maaf, trailer untuk film ini belum tersedia.'}}
                        </p>
                </div>
            </div>
        @endif

        {{-- Additional Description --}}
        <div class="bg-gray-800/30 p-6 rounded-xl border border-gray-700">
            <h3 class="text-2xl font-bold mb-4 text-lime-400">Sinopsis</h3>
            <p class="text-lg leading-relaxed text-gray-300">
                {{ $film->sinopsis ?? 'Deskripsi film tidak tersedia.' }}
            </p>
        </div>
    </div>
</div>
</body>
@endsection
