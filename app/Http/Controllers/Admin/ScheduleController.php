<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Bus;
use App\Models\Seat;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('bus')->latest()->paginate(10);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        // Mengambil semua data bus untuk pilihan di form
        $buses = Bus::all();
        return view('admin.schedules.create', compact('buses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
        ]);

        $schedule = Schedule::create($request->all());

        // Otomatisasi pembuatan 40 kursi (10 baris x 4 kolom: A, B, C, D)
        $seats = [];
        $columns = ['A', 'B', 'C', 'D'];
        for ($i = 1; $i <= 10; $i++) {
            foreach ($columns as $col) {
                $seats[] = [
                    'schedule_id' => $schedule->id,
                    'seat_number' => $i . $col,
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        Seat::insert($seats);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal dan 40 kursi berhasil dibuat!');
    }

    public function edit(Schedule $schedule)
    {
        $buses = Bus::all();
        return view('admin.schedules.edit', compact('schedule', 'buses'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
        ]);

        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Data jadwal berhasil diperbarui!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}