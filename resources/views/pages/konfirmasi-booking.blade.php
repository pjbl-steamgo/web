<div class="w-full">
    <div class="mb-6 flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Konfirmasi Booking Masuk</h2>
            <p class="text-gray-500 text-sm mt-1">Periksa kelengkapan data pesanan dan terima booking pelanggan.</p>
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
                
                <div class="absolute top-0 right-0 bg-[#FFF3CD] text-[#B78103] text-[10px] font-bold px-4 py-1.5 rounded-bl-xl">
                    PERLU RESPON
                </div>

                <div class="p-6 md:p-8 flex flex-col flex-grow">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-500 font-bold text-xl flex-shrink-0">
                            {{ strtoupper(substr($pesanan->nama_pelanggan ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">
                                Kode Pesanan : <span class="font-bold text-black">{{ $pesanan->kode_pesanan ?? '-' }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-y-6 gap-x-4 flex-grow">
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

                    <div class="mt-8 bg-[#FFF9E6] border border-[#FDE68A] rounded-xl px-5 py-4 flex justify-between items-center">
                        <span class="text-xs font-extrabold text-[#B45309] tracking-wider">TOTAL TAGIHAN</span>
                        <span class="text-xl font-black text-[#B45309]">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</span>
                    </div>

                    <div class="mt-6">
                        <form action="{{ route('pesanan.konfirmasiBooking', $pesanan->id ?? $pesanan->_id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-colors shadow-sm flex justify-center items-center group">
                                <svg class="w-5 h-5 mr-2 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Konfirmasi Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-gray-100 p-10 text-center">
                <p class="text-gray-500">Belum ada booking yang menunggu konfirmasi.</p>
            </div>
        @endforelse
    </div>
</div>