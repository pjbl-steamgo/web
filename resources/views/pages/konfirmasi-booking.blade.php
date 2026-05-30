<div class="page {{ ($initPage ?? '') === 'konfirmasi-booking' ? 'active' : 'hidden' }}" id="page-konfirmasi-booking">
  
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
      <h2 class="text-xl font-display font-bold text-sg-text">Konfirmasi Booking Masuk</h2>
      <p class="text-sm text-sg-sub mt-1">Periksa kelengkapan data pesanan dan terima booking pelanggan.</p>
    </div>
    
    <select id="sort-booking" onchange="sortCards('grid-booking', this.value)" class="bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm font-bold text-sg-text focus:outline-none focus:border-sg-blue shadow-sm cursor-pointer w-full sm:w-auto">
      <option value="asc">Urutkan: Terlama (Prioritas)</option>
      <option value="desc">Urutkan: Terbaru Masuk</option>
    </select>
  </div>

  <div class="grid grid-cols-1 xl:grid-cols-2 gap-6" id="grid-booking">
    @forelse ($pesanans ?? [] as $pesanan)
      
      <div class="sortable-card bg-white border border-[#FDE68A] rounded-2xl shadow-sm p-6 relative overflow-hidden flex flex-col" data-time="{{ \Carbon\Carbon::parse($pesanan->tanggal)->timestamp }}">
        <div class="absolute top-0 right-0 bg-[#FEF3C7] text-[#D97706] text-[10px] font-bold px-4 py-1.5 rounded-bl-xl border-b border-l border-[#FDE68A]">PERLU RESPON</div>
        
        <div class="flex items-start gap-4 mb-5">
          <div class="w-12 h-12 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xl font-bold flex-shrink-0">
            {{ strtoupper(substr($pesanan->nama_pelanggan, 0, 1)) }}
          </div>
          <div>
            <h3 class="font-bold text-[18px] text-sg-text">{{ $pesanan->nama_pelanggan }}</h3>
            <div class="text-[13px] font-mono text-sg-sub mt-0.5"><span class="font-bold text-sg-text">Kode Pesanan:</span> {{ $pesanan->kode_pesanan }}</div>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-x-4 gap-y-3.5 bg-[#FAFBFD] p-5 rounded-xl border border-sg-border/70 flex-grow mb-6">
          
          <div>         
            <div class="text-[10px] text-sg-sub uppercase font-bold tracking-wider mb-0.5">ID User</div>
            <div class="text-[13px] font-bold text-sg-text">{{ $pesanan->user_id ?? '-' }}</div>
          </div>
          
          <div>
            <div class="text-[10px] text-sg-sub uppercase font-bold tracking-wider mb-0.5">No. Handphone</div>
            <div class="text-[13px] font-bold text-sg-text">{{ $pesanan->no_hp ?? '-' }}</div>
          </div>
          
          <div class="col-span-2 border-t border-sg-border/50 my-0.5"></div>
          
          <div>
            <div class="text-[10px] text-sg-sub uppercase font-bold tracking-wider mb-0.5">Layanan Dipilih</div>
            <div class="text-[13px] font-bold text-sg-text">{{ $pesanan->layanan->nama_layanan ?? '-' }}</div>
          </div>
          <div>
            <div class="text-[10px] text-sg-sub uppercase font-bold tracking-wider mb-0.5">Kategori</div>
            <div class="text-[13px] font-bold text-sg-text">{{ $pesanan->layanan->kategori ?? '-' }}</div>
          </div>
          
          <div>
            <div class="text-[10px] text-sg-sub uppercase font-bold tracking-wider mb-0.5">Kendaraan</div>
            <div class="text-[13px] font-bold text-sg-text">{{ $pesanan->kendaraan ?? '-' }}</div>
          </div>
          <div>
            <div class="text-[10px] text-sg-sub uppercase font-bold tracking-wider mb-0.5">Waktu Booking</div>
            <div class="text-[13px] font-bold text-sg-text">{{ \Carbon\Carbon::parse($pesanan->tanggal)->format('d M Y, H:i') }}</div>
          </div>

          <div class="col-span-2 border-t border-sg-border/50 my-0.5"></div>
          
          <div>
            <div class="text-[10px] text-sg-sub uppercase font-bold tracking-wider mb-0.5">Metode Pembayaran</div>
            <div class="text-[13px] font-bold text-sg-text uppercase">{{ $pesanan->metode_pembayaran ?? '-' }}</div>
          </div>
          <div>
            <div class="text-[10px] text-sg-sub uppercase font-bold tracking-wider mb-0.5">Harga Layanan</div>
            <div class="text-[13px] font-bold text-sg-text">Rp {{ number_format($pesanan->layanan->harga ?? 0, 0, ',', '.') }}</div>
          </div>

          <div class="col-span-2 flex justify-between items-center bg-[#FEF3C7] px-4 py-2.5 rounded-lg border border-[#FDE68A] mt-1">
            <span class="text-[11px] font-black text-[#D97706] uppercase tracking-wider">Total Tagihan</span>
            <span class="text-[16px] font-black text-[#D97706]">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
          </div>
        </div>

        <form action="{{ route('pesanan.konfirmasiBooking', $pesanan->id) }}" method="POST" class="w-full mt-auto" onsubmit="return confirm('Data sudah benar? Lanjut terima booking ini?')">
          @csrf @method('PATCH')
          <button type="submit" class="w-full bg-[#FEF3C7] hover:bg-[#FDE68A] text-[#D97706] border border-[#FDE68A] rounded-xl px-4 py-3.5 text-[14px] font-bold transition-colors flex items-center justify-center gap-2 shadow-sm">
            <i class="bi bi-calendar-check text-lg"></i> Terima Booking Pelanggan
          </button>
        </form>
      </div>
    @empty
      <div class="col-span-full bg-white border border-sg-border rounded-2xl p-12 text-center shadow-sm">
        <div class="text-sg-sub text-5xl mb-4"><i class="bi bi-inbox"></i></div>
        <p class="text-sg-text font-bold text-lg mb-1">Tidak ada booking baru</p>
        <p class="text-sg-sub text-sm">Semua antrian booking sudah tertangani.</p>
      </div>
    @endforelse
  </div>
</div>

<script>
  function sortCards(gridId, order) {
    const grid = document.getElementById(gridId);
    const cards = Array.from(grid.querySelectorAll('.sortable-card'));
    
    if(cards.length === 0) return;

    cards.sort((a, b) => {
      const timeA = parseInt(a.getAttribute('data-time'));
      const timeB = parseInt(b.getAttribute('data-time'));
      return order === 'asc' ? timeA - timeB : timeB - timeA;
    });

    cards.forEach(card => grid.appendChild(card));
  }
</script>