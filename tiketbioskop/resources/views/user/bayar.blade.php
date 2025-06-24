@extends('layouts.app')

@section('content')
<div class="bg-gray-900 min-h-screen text-white font-sans py-12 px-4">
    <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">

        {{-- LEFT: Informasi Film & Ringkasan Pemesanan --}}
        <div class="bg-gray-800/60 p-6 rounded-2xl border border-gray-700 shadow-lg">
            <h2 class="text-2xl font-bold mb-4 text-green-400">Ringkasan Pemesanan</h2>
            <div class="flex flex-col items-center lg:items-start">
                @if($film->poster)
                    <img src="{{ Str::startsWith($film->poster, ['http://', 'https://']) ? $film->poster : asset('storage/' . $film->poster) }}" 
                        alt="{{ $film->title }} poster" 
                        class="w-full max-w-[250px] h-[350px] object-cover rounded-xl shadow-md mb-4">
                @endif
                <h3 class="text-xl font-semibold text-white">{{ $film->title }}</h3>
                <p class="text-gray-400 mt-1">{{ $film->genre }} &bull; {{ $film->duration }} Menit</p>
            </div>

            <div class="mt-6 space-y-4 text-base">
                <div class="flex justify-between">
                    <span class="text-gray-400">Bioskop</span>
                    <span class="font-medium text-white">{{ $booking->bioskop }}</span>
                </div>
                <div class="flex justify-between">
    <span class="text-gray-400">Jadwal</span>
    @if ($booking->jadwal)
        <span class="font-medium text-white">{{ $booking->jadwal->tanggal }} - {{ $booking->jadwal->jam }}</span>
    @else
        <span class="font-medium text-red-500">[Jam tayang tidak ditemukan]</span>
    @endif
</div>


                <div class="flex justify-between">
                    <span class="text-gray-400">Kursi</span>
                    <span class="font-medium text-white">{{ $booking->kursi }}</span>
                </div>
            </div>
        </div>

        {{-- RIGHT: Pilihan Metode Pembayaran --}}
        <div class="bg-gray-800/60 p-6 rounded-2xl border border-gray-700 shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-green-400">Pilih Metode Pembayaran</h2>

            <form action="{{ route('booking.processPayment') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                <div class="space-y-4">
                    <label class="flex items-center gap-4 bg-gray-700/40 p-4 rounded-xl cursor-pointer hover:bg-gray-700/60 transition">
                        <input type="radio" name="payment_method" value="transfer_bank" required class="form-radio text-green-500">
                        <span class="text-white font-medium">Transfer Bank</span>
                    </label>

                    <label class="flex items-center gap-4 bg-gray-700/40 p-4 rounded-xl cursor-pointer hover:bg-gray-700/60 transition">
                        <input type="radio" name="payment_method" value="e-wallet" required class="form-radio text-green-500">
                        <span class="text-white font-medium">E-Wallet (OVO, DANA, GoPay)</span>
                    </label>

                    <label class="flex items-center gap-4 bg-gray-700/40 p-4 rounded-xl cursor-pointer hover:bg-gray-700/60 transition">
                        <input type="radio" name="payment_method" value="kartu_kredit" required class="form-radio text-green-500">
                        <span class="text-white font-medium">Kartu Kredit/Debit</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-black font-bold py-3 px-6 rounded-xl shadow-lg transition transform hover:scale-[1.02]">
                    Bayar Sekarang
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
