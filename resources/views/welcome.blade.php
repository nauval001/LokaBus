<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LokaBus - Pemesanan Tiket Bus Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">

    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <span class="text-2xl font-bold text-blue-600 tracking-tight">Loka<span class="text-amber-500">Bus</span></span>
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <header class="bg-gradient-to-r bg-blue-700 py-20 px-4 text-center text-white relative overflow-hidden">
        <div class="relative max-w-3xl mx-auto z-10">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4">Perjalanan Aman, Nyaman, & Mudah</h1>
            <p class="text-lg text-blue-100 mb-8">Pesan tiket LokaBus ke berbagai destinasi impianmu langsung dari genggaman.</p>
        </div>
    </header>

    <section class="max-w-5xl mx-auto px-4 -mt-10 relative z-20">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 sm:p-8">
            <form action="{{ route('tickets.search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Kota Asal</label>
                    <select name="origin" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        <option value="">Pilih Asal...</option>
                        <option value="Surabaya">Surabaya</option>
                        <option value="Jombang">Jombang</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Kota Tujuan</label>
                    <select name="destination" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        <option value="">Pilih Tujuan...</option>
                        <option value="Surabaya">Surabaya</option>
                        <option value="Jombang">Jombang</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Tanggal</label>
                    <input type="date" name="departure_date" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3.5 px-4 rounded-xl shadow-md transition">
                        Cari Jadwal Bus
                    </button>
                </div>
            </form>
        </div>
    </section>
    
<section class="max-w-7xl mx-auto px-4 py-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Kabar LokaBus Terbaru</h2>
            <p class="text-gray-500 mt-2">Dapatkan info rute baru, tips perjalanan, dan promo menarik dari kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($latestArticles as $article)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">Gambar Tidak Tersedia</div>
                    @endif
                    <div class="p-6">
                        <p class="text-xs text-blue-600 font-bold uppercase mb-2">{{ $article->created_at->format('d M Y') }}</p>
                        <h3 class="font-bold text-gray-900 text-lg mb-3 line-clamp-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($article->content, 100) }}</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Baca selengkapnya &rarr;</a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-8">
                    Belum ada artikel terbaru.
                </div>
            @endforelse
        </div>
    </section>
</body>
</html>