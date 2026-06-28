<?php

use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/{transaction}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{transaction}/payment', [CheckoutController::class, 'uploadPayment'])->name('checkout.payment');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('tickets.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('buses', BusController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('transactions', TransactionController::class);
});

// Proses Pencarian Tiket Bus
Route::get('/search', [HomeController::class, 'search'])->name('tickets.search');

// Detail Jadwal & Peta Kursi (Tambahkan baris ini)
Route::get('/tickets/{id}', [HomeController::class, 'show'])->name('tickets.show');

require __DIR__.'/auth.php';
