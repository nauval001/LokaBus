<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('admin.buses.index') }}" class="text-gray-500 hover:text-blue-600">&larr; Kembali</a>
            <span class="mx-2 text-gray-300">|</span>
            {{ __('Edit Armada Bus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6 sm:p-8">
                
                <form action="{{ route('admin.buses.update', $bus->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Bus / Perusahaan Otobus</label>
                        <input type="text" name="name" value="{{ old('name', $bus->name) }}" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas Bus</label>
                        <select name="class" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                            <option value="VIP" {{ old('class', $bus->class) == 'VIP' ? 'selected' : '' }}>VIP</option>
                            <option value="Ekonomi" {{ old('class', $bus->class) == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                        </select>
                        @error('class') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas (Opsional)</label>
                        <textarea name="facilities" rows="3" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm">{{ old('facilities', $bus->facilities) }}</textarea>
                        @error('facilities') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.buses.index') }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold text-sm py-2 px-6 rounded-lg transition shadow-sm">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-2 px-6 rounded-lg transition shadow-sm">Perbarui Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>