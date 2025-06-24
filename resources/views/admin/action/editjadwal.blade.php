@extends('layouts.admin')

@section('title', 'Edit Jadwal Tayang')

@section('content')
 @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Edit Jadwal Tayang</h2>

    <form action="{{ route('admin.update.jadwal', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Tayang</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $jadwal->tanggal) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white" required>
        </div>

        <div class="mb-4">
            <label for="film_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Film</label>
            <select name="film_id" id="film_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white" required>
                <option value="">-- Pilih Film --</option>
                @foreach($films as $film)
                <option value="{{ $film->id }}" {{ $film->id == $selectedFilmId ? 'selected' : '' }}>
                {{ $film->title }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Menampilkan jam tayang yang sudah ada --}}
        @for ($i = 0; $i < 5; $i++)
            <div class="mb-4">
                <label for="jam_mulai_{{ $i+1 }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jam Mulai {{ $i+1 }}</label>
                <input type="time" name="jam_mulai[]" id="jam_mulai_{{ $i+1 }}" value="{{ old('jam_mulai.' . $i, $jamMulaiList[$i] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white">
            </div>
        @endfor

        <div class="mb-4">
            <label for="studio_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Studio</label>
            <select name="studio_id" id="studio_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white" required>
                <option value="">-- Pilih Studio --</option>
                @foreach($studios as $studio)
                <option value="{{ $studio->id }}" {{ $studio->id == $selectedStudioId ? 'selected' : '' }}>
                {{ $studio->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.dashboard') }}" class="inline-block mr-3 px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 text-sm font-medium rounded-md">Batal</a>
            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">Update Jadwal</button>
        </div>
    </form>
</div>
@endsection
