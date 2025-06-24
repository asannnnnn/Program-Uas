<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Booking;
use App\Models\JamTayang;

class BookingController extends Controller
{
    /**
     * Tampilkan halaman pemesanan film.
     */
    public function show($id)
    {
        $film = Film::findOrFail($id);
        $group = JamTayang::where('film_id', $id)->get();

        return view('user.booking', compact('film', 'group'));
    }

    /**
     * Simpan ringkasan pemesanan ke database via AJAX.
     */
    public function saveSummary(Request $request)
    {
        try {
            $validated = $request->validate([
                'film_id' => 'required|exists:films,id',
                'bioskop' => 'required|string',
                'jam' => 'required|exists:jam_tayangs,id', // validasi ID jam tayang
                'kursi' => 'required|string',
            ]);

            $booking = Booking::create([
                'film_id' => $validated['film_id'],
                'bioskop' => $validated['bioskop'],
                'jam_tayang_id' => $validated['jam'], // simpan ID jam tayang
                'kursi' => $validated['kursi'],
            ]);

            return response()->json([
                'message' => 'Booking berhasil disimpan.',
                'booking_id' => $booking->id,
            ]);
        } catch (\Exception $e) {
            \Log::error("Gagal simpan booking: " . $e->getMessage());

            return response()->json([
                'error' => true,
                'message' => 'Terjadi kesalahan saat menyimpan booking.',
            ], 500);
        }
    }

    /**
     * Tampilkan halaman pembayaran.
     */
    public function bayar(Request $request, $id)
    {
        $film = Film::findOrFail($id);
        $booking_id = $request->query('booking_id');

        // Pastikan relasi jadwal dimuat
        $booking = Booking::with('jadwal')->findOrFail($booking_id);

        return view('user.bayar', [
            'film' => $film,
            'booking' => $booking,
        ]);
    }
    public function processPayment(Request $request)
{
    $request->validate([
        'booking_id' => 'required|exists:bookings,id',
        'payment_method' => 'required|string',
    ]);

    $booking = Booking::findOrFail($request->booking_id);
    $booking->payment_method = $request->payment_method;
    $booking->payment_status = 'pending'; // atau 'paid' tergantung flow kamu
    $booking->save();

    return redirect()->route('booking.show', ['id' => $booking->film_id])
        ->with('success', 'Metode pembayaran berhasil dipilih.');
}
}
