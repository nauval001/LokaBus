<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Jadwal & Rute') }}
            </h2>
            <a href="{{ route('admin.schedules.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-2 px-4 rounded-lg transition shadow-sm">
                + Tambah Jadwal
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg">
                    <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500">
                                <th class="px-6 py-4 font-semibold">Armada Bus</th>
                                <th class="px-6 py-4 font-semibold">Rute Perjalanan</th>
                                <th class="px-6 py-4 font-semibold">Waktu Berangkat & Tiba</th>
                                <th class="px-6 py-4 font-semibold">Harga Tiket</th>
                                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($schedules as $schedule)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-gray-900">{{ $schedule->bus->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $schedule->bus->class }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2 text-sm text-gray-700">
                                            <span class="font-semibold">{{ $schedule->origin }}</span>
                                            <span class="text-gray-400">&rarr;</span>
                                            <span class="font-semibold">{{ $schedule->destination }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <p class="text-green-600 font-medium">Berangkat: {{ $schedule->departure_time->format('d M Y, H:i') }}</p>
                                        <p class="text-blue-600 font-medium mt-1">Tiba: {{ $schedule->arrival_time->format('d M Y, H:i') }}</p>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900 text-sm">
                                        Rp {{ number_format($schedule->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 flex justify-center gap-3">
                                        <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Edit</a>
                                        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Yakin menghapus jadwal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada jadwal. <a href="{{ route('admin.schedules.create') }}" class="text-blue-600 hover:underline">Tambah sekarang</a>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($schedules->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $schedules->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>