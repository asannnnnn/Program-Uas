@extends('layouts.admin')

@section('title', 'Manajemen Studio')

@section('breadcrumb')
    Manajemen Studio
@endsection

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manajemen Studio</h2>
        <a href="{{route('admin.create.studio')}}"
           class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg shadow text-sm">
            <i class="fas fa-plus mr-2"></i> Tambah Studio
        </a>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 dark:bg-gray-700 text-sm text-left">
                <tr>
                    <th class="px-4 py-3">Nama Studio</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
           <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm">
    @forelse ($studios as $studio)
        <tr>
            <td class="px-4 py-3 font-medium">{{ $studio->nama }}</td>
            <td class="px-4 py-3 text-center space-x-2">
                <form action="{{ route('admin.destroy.studio', $studio->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin ingin menghapus studio ini?')" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="2" class="px-4 py-3 text-center text-gray-500">
                Belum ada data studio.
            </td>
        </tr>
    @endforelse
</tbody>

        </table>
    </div>
@endsection
