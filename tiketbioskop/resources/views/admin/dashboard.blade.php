@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Dashboard Admin Cinetix</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-2">Kelola jadwal dan penjualan tiket bioskop</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-lg shadow-lg p-6 text-white">
            <h3 class="text-sm font-medium uppercase tracking-wider">Total Penjualan Hari Ini</h3>
        </div>
        <div class="bg-gradient-to-r from-amber-600 to-amber-700 rounded-lg shadow-lg p-6 text-white">
            <h3 class="text-sm font-medium uppercase tracking-wider">Film Paling Laris</h3>
        </div>
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-lg p-6 text-white">
            <h3 class="text-sm font-medium uppercase tracking-wider">Studio Tersibuk</h3>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Jadwal Tayang</h2>
            <div class="flex items-center space-x-4">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari film..." 
                        value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>
                <a href="{{ route('admin.create.jadwal') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Jadwal
                </a>
            </div>
        </div>

        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">Tanggal</th>
                    <th class="px-6 py-4 text-left">Film</th>
                    <th class="px-6 py-4 text-left">Jam Tayang</th>
                    <th class="px-6 py-4 text-left">Studio</th>
                    <th class="px-6 py-4 text-left">Tiket Terjual</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($jadwals as $key => $group)
                    @php
                        [$tanggal, $filmId, $studioId] = explode('|', $key);
                        $film = $group->first()->filmDetail;
                        $studio = \App\Models\Studio::find($studioId);
                    @endphp
                    <tr>
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($tanggal)->format('Y-m-d') }}</td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $film->title ?? '-' }}</div>

                            @if ($film?->poster)
                                <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}" class="w-5 h-5 object-cover rounded mt-1">
                            @else
                                <span class="text-gray-500 italic">Poster tidak tersedia</span>
                            @endif

                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Genre: {{ $film->genre ?? '-' }} menit
                                | {{ $film->rating ?? '-' }}
                            </div>

                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                @for ($i = 0; $i < ($film->bintang ?? 0); $i++)
                                    <i class="fas fa-star text-yellow-400"></i>
                                @endfor
                            </div>

                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                @if ($film->trailer_url)
                                    <a href="{{ $film->trailer_url }}" target="_blank" class="text-blue-500 hover:underline">Lihat Trailer</a>
                                @else
                                    <span class="text-gray-500 italic">Trailer tidak tersedia</span>
                                @endif
                            </div>

                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                @if ($film->sinopsis)
                                    {{ $film->sinopsis }}
                                @else
                                    <span class="text-gray-500 italic">Sinopsis tidak tersedia</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @foreach ($group as $jadwal)
                                <div>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</div>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">{{ $studio->nama ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs font-medium">
                                {{ rand(20, 100) }} tiket
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.edit.jadwal', $group->first()->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.destroy.jadwal', $group->first()->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex items-center justify-between">
            <div class="flex space-x-2">
                <button class="px-3 py-1 border rounded-md text-gray-600 dark:text-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-600 disabled:opacity-50" disabled>
                    Sebelumnya
                </button>
                <button class="px-3 py-1 border rounded-md text-gray-600 dark:text-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-600">
                    Selanjutnya
                </button>
            </div>
        </div>
    </div>
@endsection
