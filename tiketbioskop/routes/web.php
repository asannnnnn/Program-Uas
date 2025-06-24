<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\FilmManajemenController;
use App\Http\Controllers\Admin\StudioManajemenController;
use App\Http\Controllers\Admin\JadwalManajemenController;
use App\Http\Controllers\Admin\TransaksiManajemenController;
use App\Http\Middleware\AdminMiddleware;

// -----------------------------
// PUBLIC
// -----------------------------
Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__.'/auth.php';

// -----------------------------
// AUTH + VERIFIED USER
// -----------------------------
Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/user/dashboard', [FilmController::class, 'userDashboard'])->name('user.dashboard');
});

// -----------------------------
// ADMIN PANEL
// -----------------------------
Route::prefix('admin')
    ->middleware(['auth', 'verified', AdminMiddleware::class])
    ->name('admin.')
    ->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('jadwal/create', [AdminDashboardController::class, 'create'])->name('create.jadwal');
    Route::Post('jadwal/store', [AdminDashboardController::class, 'store'])->name('store.jadwal');
    Route::get('jadwal/edit/{id}', [AdminDashboardController::class, 'edit'])->name('edit.jadwal');
    Route::put('jadwal/update/{id}', [AdminDashboardController::class, 'update'])->name('update.jadwal');
    Route::delete('delete{id}', [AdminDashboardController::class, 'destroy'])->name('destroy.jadwal');

    // ---------------------
    // Manajemen Film
    // ---------------------
    Route::get('film/manage', [FilmManajemenController::class, 'index'])->name('managefilm');
    Route::get('film/create', [FilmManajemenController::class, 'create'])->name('create.film');
    Route::get('film/edit/{id}', [FilmManajemenController::class, 'edit'])->name('edit.film');
    Route::put('film/update/{id}', [FilmManajemenController::class, 'update'])->name('update.film');  
    Route::post('film/store', [FilmManajemenController::class, 'store'])->name('store.film');
    Route::delete('film/{id}', [FilmManajemenController::class, 'destroy'])->name('destroy.film');

    // ---------------------
    // Manajemen Studio 
    // ---------------------
    Route::get('studio/managestudio', [StudioManajemenController::class, 'index'])->name('managestudio');
    Route::get('studio/create', [StudioManajemenController::class, 'create'])->name('create.studio');
    Route::Post('studio/store', [StudioManajemenController::class, 'store'])->name('store.studio');
    Route::delete('studio/{id}', [StudioManajemenController::class, 'destroy'])->name('destroy.studio');

    // ---------------------
    // Manajemen Transaksi
    // ---------------------
    Route::get('/managetransaksi', [TransaksiManajemenController::class, 'index'])->name('managetransaksi');
});

// -----------------------------
// USER - AUTH (TANPA VERIFIED)
// -----------------------------
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Trailer & Booking
    Route::get('/film/{id}/trailer', [FilmController::class, 'showTrailer'])->name('film.trailer');
    Route::get('/film/{id}/booking', [FilmController::class, 'booking'])->name('film.booking');

    // Booking Process
    Route::post('/booking/save-summary', [BookingController::class, 'saveSummary'])->name('booking.saveSummary');
    Route::get('/film/{id}/bayar', [BookingController::class, 'bayar'])->name('booking.bayar');
    Route::get('/film/{id}/booking-summary', [BookingController::class, 'show'])->name('booking.show');
    Route::post('/booking/process-payment', [BookingController::class, 'processPayment'])->name('booking.processPayment');

});
