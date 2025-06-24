@extends('layouts.admin')

@section('title', 'Manajemen Film')

@section('breadcrumb')
    Manajemen Film
@endsection

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manajemen Film</h2>
        <a href="{{ route('admin.create.film') }}"
           class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg shadow text-sm">
            <i class="fas fa-plus mr-2"></i> Tambah Film
        </a>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 dark:bg-gray-700 text-sm text-left">
                <tr>
                    <th class="px-4 py-3">Poster</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Genre</th>
                    <th class="px-4 py-3">Durasi</th>
                    <th class="px-4 py-3">Sinopsis</th>
                    <th class="px-4 py-3">Rating</th>
                    <th class="px-4 py-3">⭐ Bintang</th>
                    <th class="px-4 py-3">Usia</th>
                    <th class="px-4 py-3">Trailer</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                @foreach ($films as $film)
                    <tr>
                        <td class="px-4 py-3">
                            @if ($film->poster)
                                <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}" class="w-16 h-20 object-cover rounded">
                            @else
                                <span class="text-gray-500 italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $film->title }}</td>
                        <td class="px-4 py-3">{{ $film->genre ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $film->duration ? $film->duration . ' menit' : '-' }}</td>
                        <td class="px-4 py-3">{{ Str::limit($film->sinopsis, 100) }}</td>
                        <td class="px-4 py-3">{{ $film->rating }}</td>
                        <td class="px-4 py-3">
                            @for ($i = 0; $i < $film->bintang; $i++)
                                <i class="fas fa-star text-yellow-400"></i>
                            @endfor
                        </td>
                        <td class="px-4 py-3">{{ $film->age }}</td>
                        <td class="px-4 py-3">
                            @if ($film->trailer_url)
                                <a href="{{ $film->trailer_url }}" target="_blank" class="text-blue-500 hover:underline">
                                    Lihat Trailer
                                </a>
                            @else
                                <span class="text-gray-500 italic">Tidak tersedia</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center space-x-2">
                           <a href="{{ route('admin.edit.film', $film->id) }}" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.destroy.film', $film->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus film ini?')" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        </td>
                    </tr>
                @endforeach

                @if ($films->isEmpty())
                    <tr>
                        <td colspan="10" class="text-center text-gray-500 py-6">Tidak ada data film.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
