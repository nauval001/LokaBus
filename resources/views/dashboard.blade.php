<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->role === 'admin' ? __('Panel Kendali LokaBus') : __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(auth()->user()->role === 'admin')
                
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 overflow-hidden shadow-lg sm:rounded-2xl mb-8 border border-blue-500">
                    <div class="p-8 text-white">
                        <h3 class="text-2xl sm:text-3xl font-extrabold mb-2 tracking-tight">Selamat bertugas, Administrator {{ auth()->user()->name }}! 👋</h3>
                        <p class="text-blue-100 text-sm sm:text-base">Pantau transaksi, kelola armada bus, dan atur jadwal keberangkatan LokaBus hari ini dengan mudah.</p>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6">
                    <h4 class="font-bold text-gray-900 text-lg mb-4">Pintasan Kelola Data</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-center">
                        <a href="{{ route('admin.buses.index') }}" class="block p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition group">
                            <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">🚌</div>
                            <h5 class="font-bold text-gray-800">Kelola Bus</h5>
                        </a>
                        <a href="{{ route('admin.schedules.index') }}" class="block p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition group">
                            <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛣️</div>
                            <h5 class="font-bold text-gray-800">Kelola Jadwal</h5>
                        </a>
                        <a href="{{ route('admin.transactions.index') }}" class="block p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition group">
                            <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">💳</div>
                            <h5 class="font-bold text-gray-800">Transaksi</h5>
                        </a>
                        <a href="{{ route('admin.articles.index') }}" class="block p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition group">
                            <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">✍️</div>
                            <h5 class="font-bold text-gray-800">Artikel Blog</h5>
                        </a>
                    </div>
                </div>

            @else

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8 text-center">
                    <div class="text-6xl mb-4">🎫</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Selamat datang di LokaBus, {{ auth()->user()->name }}!</h3>
                    <p class="text-gray-500 mb-8 max-w-lg mx-auto">Mulai perjalanan Anda sekarang. Cari rute, pilih kursi favorit, dan nikmati perjalanan aman serta nyaman bersama kami.</p>
                    
                    <a href="{{ route('home') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-md transition">
                        Cari Tiket Perjalanan &rarr;
                    </a>
                </div>

            @endif

        </div>
    </div>
</x-app-layout>