<div class="page {{ ($initPage ?? '') === 'konfirmasi-booking' ? 'active' : 'hidden' }}" id="page-konfirmasi-booking">
    
    <div class="mb-6 flex justify-between items-end">
        <div class="hidden md:flex items-center bg-white border border-sg-border rounded-xl px-4 py-2.5 shadow-sm cursor-pointer hover:border-sg-blue transition-all">
            <span class="text-sm font-bold text-sg-text">Urutkan: Terlama (Prioritas)</span>
            <i class="bi bi-chevron-down ml-2 text-sg-sub text-sm"></i>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2 shadow-sm">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2 shadow-sm">
            <i class="bi bi-x-circle-fill"></i> {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse ($pesanans as $pesanan)
            <div class="bg-white rounded-2xl border border-sg-border shadow-sm relative overflow-hidden flex flex-col h-full">
                
                <div class="absolute top-0 right-0 bg-[#FFF7ED] text-[#F97316] text-[10px] font-bold px-4 py-1.5 rounded-bl-xl tracking-wider uppercase">
                    Perlu Respon
                </div>

                <div class="p-6 md:p-8 flex flex-col flex-grow">
                    <div class="flex items-center space-x-4 mb-8">
                        @if(isset($pesanan->user) && $pesanan->user->foto_profil)
                            <img src="{{ asset('storage/' . $pesanan->user->foto_profil) }}" alt="Foto Profil" class="w-12 h-12 rounded-full object-cover flex-shrink-0 border border-sg-border shadow-sm">
                        @else
                            <div class="w-12 h-12 bg-sg-bg rounded-full flex items-center justify-center text-sg-blue font-bold text-xl flex-shrink-0">
                                {{ strtoupper(substr($pesanan->nama_pelanggan ?? 'U', 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <p class="text-[12px] font-bold text-sg-sub uppercase tracking-wider">Kode Pesanan</p>
                            <p class="text-lg font-bold text-sg-text">{{ $pesanan->kode_pesanan ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-y-6 gap-x-4 flex-grow">
                        <div>
                            <p class="text-[10px] font-bold text-sg-sub tracking-wider mb-1.5 uppercase">Nama</p>
                            <p class="text-[13px] font-bold text-sg-text truncate">{{ $pesanan->nama_pelanggan ?? $pesanan->user_id ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-sg-sub tracking-wider mb-1.5 uppercase">No. Handphone</p>
                            <p class="text-[13px] font-bold text-sg-text">{{ $pesanan->no_hp ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-sg-sub tracking-wider mb-1.5 uppercase">Layanan</p>
                            <p class="text-[13px] font-bold text-sg-text">{{ $pesanan->layanan->nama_layanan ?? 'Steam Wash' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-sg-sub tracking-wider mb-1.5 uppercase">Kategori</p>
                            <p class="text-[13px] font-bold text-sg-text">{{ $pesanan->layanan->kategori ?? 'Motor' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-sg-sub tracking-wider mb-1.5 uppercase">Kendaraan</p>
                            <p class="text-[13px] font-bold text-sg-text">{{ $pesanan->kendaraan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-sg-sub tracking-wider mb-1.5 uppercase">Waktu Booking</p>
                            <p class="text-[13px] font-bold text-sg-text">{{ $pesanan->tanggal ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-sg-sub tracking-wider mb-1.5 uppercase">Metode Pembayaran</p>
                            <p class="text-[13px] font-bold text-sg-text">{{ $pesanan->metode_pembayaran ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-sg-sub tracking-wider mb-1.5 uppercase">Harga</p>
                            <p class="text-[13px] font-bold text-sg-text">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="mt-8 bg-sg-bg border border-sg-border rounded-xl px-5 py-4 flex justify-between items-center">
                        <span class="text-[11px] font-extrabold text-sg-sub tracking-wider uppercase">Total Tagihan</span>
                        <span class="text-xl font-black text-sg-blue">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</span>
                    </div>

                    <div class="mt-6">
                        <form action="{{ route('pesanan.konfirmasiBooking', $pesanan->id ?? $pesanan->_id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full bg-sg-blue hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-all shadow-sm flex justify-center items-center gap-2">
                                <i class="bi bi-check-circle text-lg"></i>
                                Konfirmasi Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-sg-border p-10 text-center">
                <p class="text-sg-sub text-sm">Belum ada booking yang menunggu konfirmasi.</p>
            </div>
        @endforelse
    </div>
</div>