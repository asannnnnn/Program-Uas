@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 text-white">
    <h1 class="text-4xl font-bold mb-8 text-center bg-gradient-to-r from-red-600 to-purple-600 bg-clip-text text-transparent">🎬 Selamat Datang di CineTix</h1>

    <!-- Search + Filter Row -->
    <form method="GET" action="{{ route('user.dashboard') }}">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center w-full gap-3">
                <!-- Search Box -->
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z"></path>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul film..."
                        class="w-full bg-gray-800 text-white border border-gray-600 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200 hover:border-gray-500" />
                </div>

                <!-- Filter Tabs -->
                <div class="flex gap-2 whitespace-nowrap overflow-x-auto pb-2">
                    @php
                        $active = request('filter');
                        $tabs = [
                            'top_rated' => 'Rating Tertinggi',
                            'all' => 'Semua',
                        ];
                    @endphp

                    @foreach ($tabs as $value => $label)
                        <button type="submit" name="filter" value="{{ $value }}"
                            class="px-4 py-2 rounded-md text-sm font-medium transition
                                {{ $active == $value ? 'bg-red-600 text-white shadow-md' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </form>

    <!-- Daftar Film -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @forelse ($films as $film)
            <a href="{{ route('film.trailer', $film->id) }}" class="block bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:scale-105 hover:bg-gray-700 transition duration-300 hover:shadow-xl group">
                <div class="relative overflow-hidden">
                    @if ($film->poster)
                        <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}" class="w-full h-80 object-cover">
                    @else
                        <div class="w-full h-80 bg-gray-700 flex items-center justify-center text-gray-400">Tanpa Gambar</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                        <span class="text-white font-medium">Lihat Trailer →</span>
                    </div>
                </div>
                <div class="p-4">
                    <h2 class="text-lg font-semibold mb-1 truncate">{{ $film->title }}</h2>

                    <!-- Rating -->
                    <div class="flex items-center text-sm text-yellow-400 mb-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= floor($film->bintang ?? 0) ? 'text-yellow-400' : 'text-gray-500' }}">★</span>
                        @endfor
                        <span class="ml-1 text-sm text-gray-300">({{ number_format($film->rating ?? 0, 1) }})</span>
                    </div>

                    <!-- Genre & Durasi -->
                    <div class="flex items-center text-sm text-gray-400 mb-2">
                        <span>{{ $film->genre ?? '-' }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $film->duration ? $film->duration . ' menit' : '-' }}</span>
                    </div>

                    <!-- Usia -->
                    <span class="inline-block px-2 py-1 text-xs rounded-full 
                        {{ $film->age === 'dewasa' ? 'bg-red-900/50 text-red-400' : 'bg-blue-900/50 text-blue-400' }}">
                        {{ ucfirst($film->age ?? '-') }}
                    </span>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-xl text-gray-400">Tidak ada film ditemukan.</p>
                <p class="text-gray-500 mt-1">Coba kata kunci atau filter yang berbeda</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
