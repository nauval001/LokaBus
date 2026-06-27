<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        // Menampilkan daftar bus dengan pagination
        $buses = Bus::latest()->paginate(10);
        return view('admin.buses.index', compact('buses'));
    }

    public function create()
    {
        return view('admin.buses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|in:Ekonomi,VIP',
            'facilities' => 'nullable|string',
        ]);

        Bus::create($request->all());

        return redirect()->route('admin.buses.index')->with('success', 'Data armada bus berhasil ditambahkan!');
    }

    public function edit(Bus $bus)
    {
        return view('admin.buses.edit', compact('bus'));
    }

    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|in:Ekonomi,VIP',
            'facilities' => 'nullable|string',
        ]);

        $bus->update($request->all());

        return redirect()->route('admin.buses.index')->with('success', 'Data armada bus berhasil diperbarui!');
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();

        return redirect()->route('admin.buses.index')->with('success', 'Data armada bus berhasil dihapus!');
    }
}