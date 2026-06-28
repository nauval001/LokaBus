<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Seat;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // Mengambil seluruh riwayat transaksi masuk beserta relasi user dan jadwal bus
        $transactions = Transaction::with(['user', 'schedule.bus'])->latest()->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        // Menampilkan halaman detail untuk memverifikasi foto bukti transfer
        return view('admin.transactions.show', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:Paid,Canceled',
        ]);

        $transaction->update([
            'status' => $request->status
        ]);

        // Otomatisasi: Jika admin menolak/membatalkan pesanan, kembalikan status kursi menjadi Tersedia
        if ($request->status == 'Canceled') {
            $seatNumbers = explode(',', $transaction->seat_numbers);
            Seat::where('schedule_id', $transaction->schedule_id)
                ->whereIn('seat_number', $seatNumbers)
                ->update(['status' => 'Tersedia']);
        }

        return redirect()->route('admin.transactions.index')->with('success', 'Status validasi transaksi berhasil diperbarui.');
    }
}