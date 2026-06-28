<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pembayaran (Invoice)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg">
                    <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6">
                    <div class="flex justify-between items-center border-b border-gray-100 pb-4 mb-4">
                        <h3 class="font-bold text-gray-900">Order ID: #LKB-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</h3>
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                            {{ $transaction->status == 'Unpaid' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $transaction->status == 'Pending' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ $transaction->status == 'Paid' ? 'bg-green-100 text-green-700' : '' }}">
                            {{ strtoupper($transaction->status) }}
                        </span>
                    </div>

                    <div class="space-y-4 text-sm text-gray-600">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Rute</p>
                            <p class="font-bold text-gray-900">{{ $transaction->schedule->origin }} &rarr; {{ $transaction->schedule->destination }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Waktu Berangkat</p>
                            <p class="font-bold text-gray-900">{{ $transaction->schedule->departure_time->translatedFormat('l, d F Y - H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Armada & Nomor Kursi</p>
                            <p class="font-bold text-gray-900">{{ $transaction->schedule->bus->name }} (Kursi: {{ $transaction->seat_numbers }})</p>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-end">
                        <span class="font-bold text-gray-900">Total Tagihan</span>
                        <span class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6">
                    @if($transaction->status == 'Unpaid')
                        <h3 class="font-bold text-gray-900 mb-4">Instruksi Pembayaran</h3>
                        <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl mb-6 text-sm text-blue-800">
                            Silakan transfer tepat <strong>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</strong> ke rekening berikut:
                            <div class="mt-3 bg-white p-3 rounded-lg border border-blue-100">
                                <p class="text-xs text-gray-500 uppercase">Bank BRI / ShopeePay Top-Up</p>
                                <p class="font-bold text-lg text-gray-900 tracking-wider">112-233-4455</p>
                                <p class="text-xs text-gray-500">a.n. LokaBus Indonesia</p>
                            </div>
                        </div>

                        <form action="{{ route('checkout.payment', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Unggah Bukti Transfer</label>
                                <input type="file" name="payment_proof" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm" accept="image/*" required>
                                @error('payment_proof') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-sm">
                                Konfirmasi Pembayaran
                            </button>
                        </form>
                    @elseif($transaction->status == 'Pending')
                        <div class="text-center py-8">
                            <div class="text-5xl mb-4">⏳</div>
                            <h3 class="font-bold text-gray-900 text-lg mb-2">Menunggu Verifikasi</h3>
                            <p class="text-gray-500 text-sm">Bukti pembayaran Anda sedang dicek oleh Admin. Halaman ini akan diperbarui setelah lunas.</p>
                        </div>
                    @elseif($transaction->status == 'Paid')
                        <div class="text-center py-8">
                            <div class="text-5xl mb-4 text-green-500">✅</div>
                            <h3 class="font-bold text-gray-900 text-lg mb-2">Pembayaran Lunas!</h3>
                            <p class="text-gray-500 text-sm mb-6">Terima kasih, kursi Anda telah resmi diamankan.</p>
                            <a href="#" class="inline-block w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-sm">
                                ⬇️ Unduh E-Tiket (PDF)
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>