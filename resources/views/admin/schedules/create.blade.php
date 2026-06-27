<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('admin.schedules.index') }}" class="text-gray-500 hover:text-blue-600">&larr; Kembali</a>
            <span class="mx-2 text-gray-300">|</span>
            {{ __('Tambah Jadwal Rute') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6 sm:p-8">
                
                <form action="{{ route('admin.schedules.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Armada Bus</label>
                        <select name="bus_id" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                            <option value="">-- Pilih Bus --</option>
                            @foreach($buses as $bus)
                                <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                                    {{ $bus->name }} ({{ $bus->class }})
                                </option>
                            @endforeach
                        </select>
                        @error('bus_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kota Asal</label>
                            <input type="text" name="origin" value="{{ old('origin') }}" placeholder="Contoh: Surabaya" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                            @error('origin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kota Tujuan</label>
                            <input type="text" name="destination" value="{{ old('destination') }}" placeholder="Contoh: Jombang" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                            @error('destination') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Berangkat</label>
                            <input type="datetime-local" name="departure_time" value="{{ old('departure_time') }}" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                            @error('departure_time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Kedatangan</label>
                            <input type="datetime-local" name="arrival_time" value="{{ old('arrival_time') }}" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                            @error('arrival_time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga Tiket (Rp)</label>
                        <input type="number" name="price" value="{{ old('price') }}" placeholder="Contoh: 150000" min="0" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                        @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.schedules.index') }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold text-sm py-2 px-6 rounded-lg transition shadow-sm">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-2 px-6 rounded-lg transition shadow-sm">Simpan Jadwal</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>