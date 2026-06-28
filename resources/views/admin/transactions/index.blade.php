<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Transaksi Pembayaran') }}
        </h2>
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
                                <th class="px-6 py-4 font-semibold">Order ID</th>
                                <th class="px-6 py-4 font-semibold">Pelanggan</th>
                                <th class="px-6 py-4 font-semibold">Rute & Bus</th>
                                <th class="px-6 py-4 font-semibold">Total Bayar</th>
                                <th class="px-6 py-4 font-semibold">Status</th>
                                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse($transactions as $transaction)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-bold text-gray-900">#LKB-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-gray-800">{{ $transaction->user->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $transaction->user->email }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-gray-700">{{ $transaction->schedule->origin }} &rarr; {{ $transaction->schedule->destination }}</p>
                                        <p class="text-xs text-gray-500">{{ $transaction->schedule->bus->name }} (Kursi: {{ $transaction->seat_numbers }})</p>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900">
                                        Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                                            {{ $transaction->status == 'Unpaid' ? 'bg-red-100 text-red-700' : '' }}
                                            {{ $transaction->status == 'Pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                            {{ $transaction->status == 'Paid' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $transaction->status == 'Canceled' ? 'bg-gray-100 text-gray-600' : '' }}">
                                            {{ $transaction->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="text-blue-600 hover:text-blue-800 font-bold">
                                            Verifikasi &rarr;
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada transaksi pemesanan tiket yang masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($transactions->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>