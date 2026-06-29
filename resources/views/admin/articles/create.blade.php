<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('admin.articles.index') }}" class="text-gray-500 hover:text-blue-600">&larr; Kembali</a>
            <span class="mx-2 text-gray-300">|</span>
            {{ __('Tulis Artikel Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6 sm:p-8">
                
                <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Sampul (Opsional)</label>
                        <input type="file" name="image" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm" accept="image/*">
                        @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Konten</label>
                        <textarea name="content" rows="8" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>{{ old('content') }}</textarea>
                        @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.articles.index') }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold text-sm py-2 px-6 rounded-lg transition shadow-sm">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-2 px-6 rounded-lg transition shadow-sm">Terbitkan Artikel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>