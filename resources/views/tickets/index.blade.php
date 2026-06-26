<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Pencarian Tiket - LokaBus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">

    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-600 transition font-medium">&larr; Kembali</a>
                <span class="text-xl font-bold text-blue-600 tracking-tight ml-4">Loka<span class="text-amber-500">Bus</span></span>
            </div>
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Masuk</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <header class="bg-blue-700 py-8 px-4 text-white">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold mb-2">Hasil Pencarian Jadwal Bus</h1>
            <div class="flex items-center gap-2 text-blue-100 text-sm">
                <span class="font-semibold text-white">{{ request('origin') ?: 'Semua Kota' }}</span>
                <span>&rarr;</span>
                <span class="font-semibold text-white">{{ request('destination') ?: 'Semua Kota' }}</span>
                @if(request('departure_date'))
                    <span class="mx-2">&bull;</span>
                    <span>{{ \Carbon\Carbon::parse(request('departure_date'))->translatedFormat('d F Y') }}</span>
                @endif
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-8">
        @if($schedules->isEmpty())
            <div class="bg-white p-12 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div class="text-gray-400 mb-4 text-5xl">🚌</div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Jadwal Tidak Ditemukan</h3>
                <p class="text-gray-500 text-sm mb-6">Maaf, tidak ada jadwal bus yang tersedia untuk pencarian Anda saat ini.</p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-2.5 px-6 rounded-xl transition shadow-sm">
                    Ubah Pencarian
                </a>
            </div>
        @else
            <p class="text-sm text-gray-500 mb-4">Ditemukan <strong>{{ $schedules->count() }}</strong> jadwal keberangkatan.</p>
            
            <div class="space-y-4">
                @foreach($schedules as $schedule)
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition flex flex-col sm:flex-row items-center justify-between gap-6">
                        
                        <div class="flex-1 w-full flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 font-bold text-xl shrink-0">🚍</div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">{{ $schedule->bus->name ?? 'Armada LokaBus' }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="inline-block px-2 py-1 bg-amber-100 text-amber-800 text-xs font-semibold rounded-md">
                                        {{ $schedule->bus->class ?? 'VIP' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 text-center shrink-0 w-full sm:w-auto justify-between sm:justify-center border-y sm:border-y-0 border-gray-100 py-4 sm:py-0">
                            <div>
                                <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }}</p>
                                <p class="text-xs text-gray-500">{{ $schedule->origin }}</p>
                            </div>
                            <div class="text-gray-300 text-sm flex flex-col items-center">
                                &rarr;
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($schedule->arrival_time)->format('H:i') }}</p>
                                <p class="text-xs text-gray-500">{{ $schedule->destination }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-end shrink-0 w-full sm:w-auto">
                            <p class="text-lg font-extrabold text-blue-600 mb-3">
                                Rp {{ number_format($schedule->price, 0, ',', '.') }}
                            </p>
                            <a href="#" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-2 px-6 rounded-xl transition text-center shadow-sm">
                                Pilih Kursi
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

</body>
</html>