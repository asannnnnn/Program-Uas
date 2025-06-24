@extends('layouts.app')

@section('content')
<div class="bg-gray-900 min-h-screen font-sans text-white">
    <div class="max-w-6xl mx-auto px-4 py-12 flex flex-col lg:flex-row gap-12">
        {{-- LEFT: Movie Info --}}
        <div class="flex flex-col items-center lg:items-start lg:w-1/2">
            @if($film->poster)
            <div class="relative group">
                <img src="{{ Str::startsWith($film->poster, ['http://', 'https://']) ? $film->poster : asset('storage/' . $film->poster) }}" 
                    alt="{{ $film->title }} poster" 
                    class="w-full max-w-[350px] h-[450px] object-cover rounded-xl shadow-2xl transition duration-300 group-hover:opacity-90">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 rounded-xl"></div>
            </div>
        @endif

            <h1 class="mt-6 text-3xl md:text-4xl font-bold bg-gradient-to-r from-green-400 to-blue-500 bg-clip-text text-transparent">
                {{ $film->title }}
            </h1>

            <div class="mt-4 flex flex-wrap items-center justify-center gap-4 text-lg">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                    {{ $film->genre }}
                </span>
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $film->duration }} Menit
                </span>
                <span class="px-3 py-1 rounded-full text-sm font-bold 
                    {{ $film->age === 'dewasa' ? 'bg-red-900/50 text-red-400' : 'bg-blue-900/50 text-blue-400' }}">
                    {{ $film->age }}+
                </span>
            </div>

            {{-- Booking Summary --}}
            <div class="mt-8 w-full max-w-md">
                <div class="bg-gray-800/50 border border-gray-700 rounded-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-900/70 to-green-800/70 px-6 py-3">
                        <h3 class="font-bold text-lg">Ringkasan Pemesanan</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div>
                                <p class="text-sm text-gray-400">Bioskop</p>
                                <p class="font-semibold" id="selected-bioskop">-</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Jam Tayang</p>
                                <p class="font-semibold" id="selected-jam">-</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Kursi</p>
                                <p class="font-semibold truncate" id="selected-seats-text">-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-8 flex flex-col gap-4 w-full max-w-md">
                <button id="btnBayar" 
                    class="py-3 px-6 rounded-xl text-black bg-gradient-to-r from-green-400 to-green-500 font-bold shadow-lg hover:from-green-500 hover:to-green-600 hover:shadow-xl transition duration-300 text-center transform hover:scale-[1.02] flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                    </svg>
                    Bayar Sekarang
                </button>
            </div>
        </div>

        {{-- RIGHT: Booking Form --}}
        <div class="w-full lg:w-1/2">
            <div class="bg-gray-800/30 backdrop-blur-sm border border-gray-700 rounded-2xl p-6 shadow-2xl">
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-gray-900/50 border border-green-600/30 rounded-xl p-4 transition hover:border-green-500/50 hover:shadow-lg">
                        <h2 class="font-bold text-lg mb-3 text-green-400">Pilih Studio</h2>
                        <select id="bioskop-select" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Pilih Bioskop</option>
                            <option value="XXI Bandung">XXI Bandung</option>
                            <option value="CGV PVJ">CGV PVJ</option>
                            <option value="Cinepolis Grand Indonesia">Cinepolis Grand Indonesia</option>
                        </select>
                    </div>
                   <div class="bg-gray-900/50 border border-green-600/30 rounded-xl p-4 transition hover:border-green-500/50 hover:shadow-lg">
                    <h2 class="font-bold text-lg mb-3 text-green-400">Pilih Jadwal</h2>
                    <select id="jam-select" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">Pilih Jam</option>
                        @foreach ($group as $jadwal)
                           <option value="{{ $jadwal->id }}" data-jam="{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}">
                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="flex justify-center mt-8">
                    <button id="toggleSeats" class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition duration-300 transform hover:scale-105 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 6a3 3 0 00-3 3v8a3 3 0 003 3h8a3 3 0 003-3V9a3 3 0 00-3-3H6zm3 5a1 1 0 100-2 1 1 0 000 2zm4-1a1 1 0 11-2 0 1 1 0 012 0zm-5 5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        Pilih Kursi
                    </button>
                </div>

                <div id="seatLayout" class="mt-10 hidden animate-fadeIn">
                    @include('user.seats')
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script --}}
<script>
document.getElementById('btnBayar').addEventListener('click', () => {
    const bioskop = document.getElementById('bioskop-select').value;
    const jam = document.getElementById('jam-select').value;
    const kursi = window.selectedSeats?.join(',') || '';
    const film_id = {{ $film->id }};

    if (!bioskop || !jam || !kursi) {
        alert('Pilih bioskop, jam, dan kursi dulu ya!');
        return;
    }

    fetch("{{ route('booking.saveSummary') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
        },
        body: JSON.stringify({ film_id, bioskop, jam, kursi }),
    })
    .then(res => res.json())
    .then(data => {
     console.log('DATA:', data);
        window.location.href = `/film/${film_id}/bayar?booking_id=${data.booking_id}`;
    })
    .catch(() => alert('Gagal menyimpan data ringkasan. Silakan coba lagi.'));
});

document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggleSeats');
    const seatLayout = document.getElementById('seatLayout');
    const seatListText = document.getElementById('selected-seats-text');
    const bioskopSelect = document.getElementById('bioskop-select');
    const jamSelect = document.getElementById('jam-select');
    const bioskopOutput = document.getElementById('selected-bioskop');
    const jamOutput = document.getElementById('selected-jam');

    window.selectedSeats = [];

    function updateSummary() {
    seatListText.textContent = window.selectedSeats.length ? window.selectedSeats.join(', ') : '-';
    bioskopOutput.textContent = bioskopSelect.value || '-';

    const selectedJamOption = jamSelect.options[jamSelect.selectedIndex];
    jamOutput.textContent = selectedJamOption?.dataset.jam || '-';
}


    toggleBtn.addEventListener('click', () => {
        seatLayout.classList.toggle('hidden');
        if (!seatLayout.classList.contains('hidden')) {
            seatLayout.scrollIntoView({ behavior: 'smooth' });
        }
        updateSummary();
    });

    window.addEventListener('seatsUpdated', function(e) {
        window.selectedSeats = e.detail;
        updateSummary();
    });

    bioskopSelect.addEventListener('change', updateSummary);
    jamSelect.addEventListener('change', updateSummary);
});
</script>

<style>
    .seat.selected {
        background-color: #84cc16 !important;
        color: black;
        font-weight: bold;
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(132, 204, 22, 0.5);
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out forwards;
    }
</style>
@endsection
