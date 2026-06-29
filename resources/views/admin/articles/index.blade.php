<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Artikel Blog') }}
            </h2>
            <a href="{{ route('admin.articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-2 px-4 rounded-lg transition shadow-sm">
                + Tulis Artikel
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
                                <th class="px-6 py-4 font-semibold w-16">Gambar</th>
                                <th class="px-6 py-4 font-semibold">Judul Artikel</th>
                                <th class="px-6 py-4 font-semibold">Penulis</th>
                                <th class="px-6 py-4 font-semibold">Tanggal Dibuat</th>
                                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($articles as $article)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        @if($article->image)
                                            <img src="{{ asset('storage/' . $article->image) }}" class="w-12 h-12 rounded-lg object-cover border border-gray-200">
                                        @else
                                            <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 text-xs border border-gray-200">No Img</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $article->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $article->author->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $article->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 flex justify-center gap-3">
                                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm mt-3">Edit</a>
                                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Yakin menghapus artikel ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm mt-3">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada artikel. <a href="{{ route('admin.articles.create') }}" class="text-blue-600 hover:underline">Buat sekarang</a>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($articles->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $articles->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>