<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('admin.transactions.index') }}" class="text-gray-500 hover:text-blue-600">&larr; Kembali</a>
            <span class="mx-2 text-gray-300">|</span>
            {{ __('Verifikasi Bukti Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-900 text-base mb-4 border-b border-gray-100 pb-3">Rincian Pemesanan</h3>
                    
                    <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Order ID</p>
                            <p class="font-bold text-gray-900">#LKB-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Status Saat Ini</p>
                            <span class="inline-block mt-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">{{ $transaction->status }}</span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Nama Penumpang</p>
                            <p class="font-semibold text-gray-900">{{ $transaction->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Nomor Kursi Pilihan</p>
                            <p class="font-bold text-blue-600">{{ $transaction->seat_numbers }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl space-y-3 text-sm">
                        <p class="font-bold text-gray-800 border-b border-gray-200 pb-2">Detail Rute Armada</p>
                        <p class="text-gray-700"><strong>Bus:</strong> {{ $transaction->schedule->bus->name }} ({{ $transaction->schedule->bus->class }})</p>
                        <p class="text-gray-700"><strong>Rute Keberangkatan:</strong> {{ $transaction->schedule->origin }} &rarr; {{ $transaction->schedule->destination }}</p>
                        <p class="text-gray-700"><strong>Jadwal Berangkat:</strong> {{ $transaction->schedule->departure_time->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="mt-6 flex justify-between items-center bg-blue-50 p-4 rounded-xl border border-blue-100">
                        <span class="font-bold text-blue-900 text-sm">Jumlah Nominal Transfer:</span>
                        <span class="text-xl font-extrabold text-blue-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="md:col-span-1 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-gray-900 text-base mb-4 border-b border-gray-100 pb-3">Gambar Bukti Transfer</h3>
                        
                        @if($transaction->payment_proof)
                            <div class="rounded-xl overflow-hidden border border-gray-200 bg-gray-50 mb-4 h-64 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $transaction->payment_proof) }}" alt="Bukti Pembayaran" class="w-full h-full object-contain">
                            </div>
                            <a href="{{ asset('storage/' . $transaction->payment_proof) }}" target="_blank" class="text-xs text-blue-600 hover:underline block text-center mb-4">🔍 Perbesar Gambar</a>
                        @else
                            <div class="rounded-xl border-2 border-dashed border-gray-200 py-16 text-center text-gray-400 text-sm mb-4">
                                📁 Pelanggan belum mengunggah foto bukti bayar.
                            </div>
                        @endif
                    </div>

                    @if($transaction->status == 'Pending' || $transaction->status == 'Unpaid')
                        <div class="space-y-3 border-t border-gray-100 pt-4">
                            <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Paid">
                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 px-4 rounded-xl transition text-sm shadow-sm">
                                    ✓ Konfirmasi Lunas
                                </button>
                            </form>

                            <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Canceled">
                                <button type="submit" onclick="return confirm('Membatalkan transaksi akan mengosongkan kembali nomor kursi terkait rute ini. Lanjutkan pembatalan?')" class="w-full bg-white border border-red-200 hover:bg-red-50 text-red-600 font-semibold py-2.5 px-4 rounded-xl transition text-sm">
                                    ✕ Tolak Pembayaran
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-gray-100 p-3 rounded-xl text-center text-xs text-gray-500 font-medium">
                            Status order telah ditutup sebagai {{ strtoupper($transaction->status) }}.
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>