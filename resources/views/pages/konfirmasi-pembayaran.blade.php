<div class="w-full">
    <div class="mb-6 flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Konfirmasi Pembayaran</h2>
            <p class="text-gray-500 text-sm mt-1">Periksa bukti transfer pelanggan dan validasi pembayaran untuk masuk ke antrean cuci.</p>
        </div>
        
        <div class="hidden md:flex items-center bg-white border border-gray-300 rounded-lg px-4 py-2 shadow-sm cursor-pointer hover:bg-gray-50">
            <span class="text-sm font-bold text-gray-800">Urutkan: Terlama (Prioritas)</span>
            <svg class="w-4 h-4 ml-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse ($pesanans as $pesanan)
            <div class="bg-white rounded-[20px] border border-gray-100 shadow-sm relative overflow-hidden flex flex-col h-full">
                
                <div class="absolute top-0 right-0 bg-[#E0E7FF] text-[#3B5BDB] text-[10px] font-bold px-4 py-1.5 rounded-bl-xl">
                    MENUNGGU VERIFIKASI
                </div>

                <div class="p-6 md:p-8 flex flex-col flex-grow">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-[#3B5BDB] font-bold text-xl flex-shrink-0">
                            {{ strtoupper(substr($pesanan->nama_pelanggan ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">
                                Kode Pesanan : <span class="font-bold text-black">{{ $pesanan->kode_pesanan ?? '-' }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-y-6 gap-x-4 mb-8">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 tracking-wider mb-1.5 uppercase">ID User / Nama</p>
                            <p class="text-sm font-bold text-gray-900 truncate">{{ $pesanan->nama_pelanggan ?? $pesanan->user_id ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 tracking-wider mb-1.5 uppercase">No. Handphone</p>
                            <p class="text-sm font-bold text-gray-900">{{ $pesanan->no_hp ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 tracking-wider mb-1.5 uppercase">Layanan Dipilih</p>
                            <p class="text-sm font-bold text-gray-900">{{ $pesanan->layanan->nama_layanan ?? 'Steam Wash' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 tracking-wider mb-1.5 uppercase">Kategori</p>
                            <p class="text-sm font-bold text-gray-900">{{ $pesanan->layanan->kategori ?? 'Motor' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 tracking-wider mb-1.5 uppercase">Kendaraan</p>
                            <p class="text-sm font-bold text-gray-900">{{ $pesanan->kendaraan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 tracking-wider mb-1.5 uppercase">Waktu Booking</p>
                            <p class="text-sm font-bold text-gray-900">{{ $pesanan->tanggal ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 tracking-wider mb-1.5 uppercase">Metode Pembayaran</p>
                            <p class="text-sm font-bold text-gray-900">{{ $pesanan->metode_pembayaran ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 tracking-wider mb-1.5 uppercase">Harga Layanan</p>
                            <p class="text-sm font-bold text-gray-900">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="mb-6 bg-[#FFF9E6] border border-[#FDE68A] rounded-xl px-5 py-4 flex justify-between items-center">
                        <span class="text-xs font-extrabold text-[#B45309] tracking-wider">TOTAL TAGIHAN</span>
                        <span class="text-xl font-black text-[#B45309]">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</span>
                    </div>

                    <div class="mt-auto border-t border-gray-100 pt-6">
                        <p class="text-[10px] font-bold text-gray-400 tracking-wider mb-3 uppercase">Bukti Transfer Pelanggan</p>
                        
                        @if($pesanan->bukti_pembayaran)
                            <a href="{{ asset($pesanan->bukti_pembayaran) }}" target="_blank" class="block w-full h-48 bg-gray-50 rounded-xl border border-gray-200 overflow-hidden relative group cursor-pointer mb-6">
                                <img src="{{ asset($pesanan->bukti_pembayaran) }}" alt="Bukti Transfer" class="w-full h-full object-contain bg-gray-100">
                                
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-white font-medium flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> 
                                        Klik untuk perbesar
                                    </span>
                                </div>
                            </a>
                        @else
                            <div class="w-full py-4 mb-6 bg-red-50 text-red-500 rounded-xl border border-red-100 text-center text-sm font-medium">
                                Pelanggan belum/gagal mengunggah bukti pembayaran.
                            </div>
                        @endif

                        <form action="{{ route('pesanan.konfirmasiPembayaran', $pesanan->id ?? $pesanan->_id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-xl transition-colors shadow-sm flex justify-center items-center group">
                                <svg class="w-5 h-5 mr-2 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Verifikasi & Masukkan Antrean
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-gray-100 p-10 text-center">
                <p class="text-gray-500">Tidak ada pembayaran tertunda yang menunggu verifikasi.</p>
            </div>
        @endforelse
    </div>
</div>