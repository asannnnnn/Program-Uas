@extends('layouts.admin')

@section('title', 'Tambah Jadwal Tayang')

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Tambah Jadwal Tayang</h2>

    <form action="{{ route('admin.store.jadwal') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Tayang</label>
            <input type="date" name="tanggal" id="tanggal" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white" required>
        </div>

        <div class="mb-4">
            <label for="film_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Film</label>
            <select name="film_id" id="film_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white" required>
                <option value="">-- Pilih Film --</option>
                @foreach($films as $film)
                    <option value="{{ $film->id }}">{{ $film->title }}</option>
                @endforeach
            </select>
        </div>

        {{-- 5x Jam Mulai --}}
        @for ($i = 1; $i <= 5; $i++)
            <div class="mb-4">
                <label for="jam_mulai_{{ $i }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jam Mulai {{ $i }}</label>
                <input type="time" name="jam_mulai[]" id="jam_mulai_{{ $i }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white">
            </div>
        @endfor

        <div class="mb-4">
            <label for="studio_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Studio</label>
            <select name="studio_id" id="studio_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white" required>
                <option value="">-- Pilih Studio --</option>
                @foreach($studios as $studio)
                    <option value="{{ $studio->id }}">{{ $studio->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.dashboard') }}" class="inline-block mr-3 px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 text-sm font-medium rounded-md">Batal</a>
            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">Simpan Jadwal</button>
        </div>
    </form>
</div>
@endsection
