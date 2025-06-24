@extends('layouts.admin')

@section('title', 'Tambah Studio')

@section('breadcrumb')
    <a href="{{ route('admin.managestudio') }}">Manajemen Studio</a> / Tambah Studio
@endsection

@section('content')
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Tambah Studio</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.store.studio') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium mb-1">Nama Studio</label>
                <input type="text" id="nama" name="nama"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600"
                       value="{{ old('nama') }}" required>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.managestudio') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg mr-2">
                    Batal
                </a>
                <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg shadow">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
