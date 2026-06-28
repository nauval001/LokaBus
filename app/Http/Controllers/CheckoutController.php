<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Transaction;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'selected_seats' => 'required|string',
        ]);

        $schedule = Schedule::findOrFail($request->schedule_id);
        $seatNumbers = explode(',', $request->selected_seats);
        $totalPrice = count($seatNumbers) * $schedule->price;

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'seat_numbers' => $request->selected_seats,
            'total_price' => $totalPrice,
            'status' => 'Unpaid',
        ]);

        Seat::where('schedule_id', $schedule->id)
            ->whereIn('seat_number', $seatNumbers)
            ->update(['status' => 'Terisi']);

        return redirect()->route('checkout.show', $transaction->id)
                         ->with('success', 'Berhasil mengunci kursi! Silakan selesaikan pembayaran.');
    }

    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('checkout.show', compact('transaction'));
    }

    public function uploadPayment(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('payment_proof')->store('payments', 'public');

        $transaction->update([
            'payment_proof' => $path,
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diunggah! Mohon tunggu verifikasi dari Admin.');
    }
}