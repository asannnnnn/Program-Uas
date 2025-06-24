<div class="bg-black text-white px-4 py-6 rounded-lg shadow-lg border border-green-800 glow max-w-md mx-auto">
    <h2 class="text-center text-xl font-bold mb-4">Pilih Kursi</h2>

    {{-- Layar --}}
    <div class="text-center text-gray-300 text-sm mb-6">Layar</div>
    <div class="h-1 w-full bg-gray-600 mb-8"></div>

    {{-- Kursi --}}
    <div class="grid grid-cols-7 gap-3 justify-center">
        @for($row = 'A'; $row <= 'E'; $row++)
            @php
                // ASCII math: if row is 'E', next char is 'F' which is false
                if ($row === 'F') break;
            @endphp

            {{-- Kiri 3 kursi --}}
            <div class="col-span-3 flex justify-between">
                @for($col = 1; $col <= 3; $col++)
                    <div class="cursor-pointer seat bg-gray-800 w-10 h-10 rounded text-center leading-10 hover:bg-green-600 transition" 
                         data-seat="{{ $row.$col }}">
                        {{ $row.$col }}
                    </div>
                @endfor
            </div>

            {{-- Jalan (spacer) --}}
            <div class="w-2"></div>

            {{-- Kanan 3 kursi --}}
            <div class="col-span-3 flex justify-between">
                @for($col = 4; $col <= 6; $col++)
                    <div class="cursor-pointer seat bg-gray-800 w-10 h-10 rounded text-center leading-10 hover:bg-green-600 transition" 
                         data-seat="{{ $row.$col }}">
                        {{ $row.$col }}
                    </div>
                @endfor
            </div>
        @endfor
    </div>

    {{-- Info pilihan --}}
    <div id="selected-seats" class="mt-6 text-sm text-center text-gray-300">
        Kursi dipilih: <span id="seat-list" class="text-lime-400">-</span>
    </div>
</div>

{{-- Styles + Glow --}}
<style>
    .glow {
        box-shadow: 0 0 10px #1f4f1f;
    }

    .seat.selected {
        background-color: #84cc16 !important;
        color: black;
        font-weight: bold;
    }
</style>

{{-- Script Kursi Toggle --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const seats = document.querySelectorAll('.seat');
        const seatList = document.getElementById('seat-list');
        let selectedSeats = [];

        function updateSelectedSeats() {
            seatList.textContent = selectedSeats.length ? selectedSeats.join(', ') : '-';

            // Kirim event ke parent
            const event = new CustomEvent('seatsUpdated', {
                detail: selectedSeats
            });
            window.dispatchEvent(event);
        }

        seats.forEach(seat => {
            seat.addEventListener('click', () => {
                const seatId = seat.dataset.seat;

                if (seat.classList.contains('selected')) {
                    seat.classList.remove('selected');
                    selectedSeats = selectedSeats.filter(s => s !== seatId);
                } else {
                    seat.classList.add('selected');
                    selectedSeats.push(seatId);
                }

                updateSelectedSeats();
            });
        });
    });
</script>

