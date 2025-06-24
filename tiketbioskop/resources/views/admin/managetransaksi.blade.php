@extends('layouts.admin')

@section('title', 'Manajemen Transaksi')

@section('breadcrumb')
    Manajemen Transaksi
@endsection

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manajemen Transaksi</h2>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 dark:bg-gray-700 text-sm text-left">
                <tr>
                    <th class="px-4 py-3">ID Transaksi</th>
                    <th class="px-4 py-3">Nama Pengguna</th>
                    <th class="px-4 py-3">Judul Film</th>
                    <th class="px-4 py-3">Studio</th>
                    <th class="px-4 py-3">Hari & Jam</th>
                    <th class="px-4 py-3">Jumlah Tiket</th>
                    <th class="px-4 py-3">Total Harga</th>
                    <th class="px-4 py-3">Metode Pembayaran</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                {{-- Contoh Baris Transaksi --}}
                <tr>
                    <td class="px-4 py-3 font-medium">TRX123456</td>
                    <td class="px-4 py-3">Budi Santoso</td>
                    <td class="px-4 py-3">Avengers: Endgame</td>
                    <td class="px-4 py-3">Studio 1</td>
                    <td class="px-4 py-3">Senin, 19:00</td>
                    <td class="px-4 py-3">2</td>
                    <td class="px-4 py-3">Rp100.000</td>
                    <td class="px-4 py-3">Transfer Bank</td>
                    <td class="px-4 py-3 text-green-600">Berhasil</td>
                    <td class="px-4 py-3 text-center space-x-2">
                        <a href="#" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button onclick="confirm('Yakin ingin membatalkan transaksi ini?')" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </td>
                </tr>
                {{-- Tambahkan data lainnya di sini --}}
            </tbody>
        </table>
    </div>
@endsection
