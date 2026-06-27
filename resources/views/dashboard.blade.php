<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Kendali LokaBus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 overflow-hidden shadow-lg sm:rounded-2xl mb-8 border border-blue-500">
                <div class="p-8 text-white">
                    <h3 class="text-2xl sm:text-3xl font-extrabold mb-2 tracking-tight">Selamat bertugas, Administrator Nauval PDR! 👋</h3>
                    <p class="text-blue-100 text-sm sm:text-base">Pantau transaksi, kelola armada bus, dan atur jadwal keberangkatan LokaBus hari ini dengan mudah.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl">🎫</div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Transaksi Baru</p>
                        <p class="text-2xl font-bold text-gray-900">0</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center text-xl">🚌</div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Total Armada</p>
                        <p class="text-2xl font-bold text-gray-900">0</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-50 text-green-500 rounded-full flex items-center justify-center text-xl">🛣️</div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Jadwal Aktif</p>
                        <p class="text-2xl font-bold text-gray-900">0</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center text-xl">📝</div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Artikel Blog</p>
                        <p class="text-2xl font-bold text-gray-900">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6">
                <h4 class="font-bold text-gray-900 text-lg mb-4">Pintasan Kelola Data</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-center">
                    
                    <a href="{{ route('admin.buses.index') }}" class="block p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition group">
                        <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">🚌</div>
                        <h5 class="font-bold text-gray-800">Kelola Bus</h5>
                        <p class="text-xs text-gray-500 mt-1">Tambah/Edit Armada</p>
                    </a>

                    <a href="{{ route('admin.schedules.index') }}" class="block p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition group">
                        <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛣️</div>
                        <h5 class="font-bold text-gray-800">Kelola Jadwal</h5>
                        <p class="text-xs text-gray-500 mt-1">Rute & Harga Tiket</p>
                    </a>

                    <a href="{{ route('admin.transactions.index') }}" class="block p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition group">
                        <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">💳</div>
                        <h5 class="font-bold text-gray-800">Transaksi</h5>
                        <p class="text-xs text-gray-500 mt-1">Verifikasi Pembayaran</p>
                    </a>

                    <a href="{{ route('admin.articles.index') }}" class="block p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition group">
                        <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">✍️</div>
                        <h5 class="font-bold text-gray-800">Artikel Blog</h5>
                        <p class="text-xs text-gray-500 mt-1">Tulis Tips Perjalanan</p>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>