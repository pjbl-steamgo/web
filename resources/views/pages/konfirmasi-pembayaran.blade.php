<div class="page {{ ($initPage ?? '') === 'konfirmasi-pembayaran' ? 'active' : 'hidden' }}" id="page-konfirmasi-pembayaran">
  
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
      <h2 class="text-xl font-display font-bold text-sg-text">Konfirmasi Pembayaran</h2>
      <p class="text-sm text-sg-sub mt-1">Periksa bukti transfer pelanggan dan validasi pembayaran untuk masuk ke antrian cuci.</p>
    </div>
    
    <select id="sort-pembayaran" onchange="sortCards('grid-pembayaran', this.value)" class="bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm font-bold text-sg-text focus:outline-none focus:border-sg-blue shadow-sm cursor-pointer w-full sm:w-auto">
      <option value="asc">Urutkan: Terlama (Prioritas)</option>
      <option value="desc">Urutkan: Terbaru Masuk</option>
    </select>
  </div>

  @if(session('success'))
    <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2 shadow-sm">
      <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    </div>
  @endif

  <div class="grid grid-cols-1 xl:grid-cols-2 gap-6" id="grid-pembayaran">
    @forelse ($pesanans ?? [] as $pesanan)
      
      <div class="sortable-card bg-white border border-purple-200 rounded-2xl shadow-sm p-6 relative overflow-hidden flex flex-col" data-time="{{ \Carbon\Carbon::parse($pesanan->tanggal)->timestamp }}">
        <div class="absolute top-0 right-0 bg-purple-50 text-purple-600 text-[10px] font-bold px-4 py-1.5 rounded-bl-xl border-b border-l border-purple-200">BUTUH VALIDASI</div>
        
        <div class="flex items-start gap-4 mb-5">
          <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xl font-bold flex-shrink-0">
            {{ strtoupper(substr($pesanan->nama_pelanggan, 0, 1)) }}
          </div>
          <div>
            <h3 class="font-bold text-[18px] text-sg-text">{{ $pesanan->nama_pelanggan }}</h3>
            <div class="text-[13px] font-mono text-sg-sub mt-0.5"><span class="font-bold text-sg-text">Kode Pesanan:</span> {{ $pesanan->kode_pesanan }}</div>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-x-4 gap-y-3.5 bg-[#FAFBFD] p-5 rounded-xl border border-sg-border/70 flex-grow mb-4">
          
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
            <div class="text-[10px] text-sg-sub uppercase font-bold tracking-wider mb-0.5">Status Pembayaran</div>
            <div class="text-[13px] font-bold text-purple-600 uppercase flex items-center gap-1">
              <i class="bi bi-hourglass-split"></i> {{ $pesanan->status ?? 'Menunggu Pembayaran' }}
            </div>
          </div>

          <div class="col-span-2 flex justify-between items-center bg-purple-50 px-4 py-2.5 rounded-lg border border-purple-100 mt-1">
            <span class="text-[11px] font-black text-purple-700 uppercase tracking-wider">Total Tagihan</span>
            <span class="text-[16px] font-black text-purple-700">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
          </div>
        </div>

        <div class="mb-5">
          <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wider mb-2 flex items-center gap-1">
            <i class="bi bi-image text-purple-600"></i> Lampiran Bukti Transfer
          </div>
          @if(!empty($pesanan->gambar))
            <a href="{{ $pesanan->gambar }}" target="_blank" class="group relative block w-full h-24 rounded-xl overflow-hidden border border-sg-border bg-gray-50 hover:border-purple-300 transition-colors">
              <img src="{{ $pesanan->gambar }}" alt="Struk Transfer" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
              <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold gap-1">
                <i class="bi bi-zoom-in"></i> Lihat Struk Ukuran Penuh
              </div>
            </a>
          @else
            <div class="w-full py-4 px-4 bg-gray-50 border border-dashed border-sg-border rounded-xl text-center text-xs text-sg-sub">
              <i class="bi bi-exclamation-triangle mr-1"></i> Pelanggan belum mengunggah foto bukti transfer.
            </div>
          @endif
        </div>

        <form action="{{ route('pesanan.konfirmasiPembayaran', $pesanan->id) }}" method="POST" class="w-full mt-auto" onsubmit="return confirm('Apakah kamu sudah memeriksa struk dan ingin mengonfirmasi pembayaran lunas?')">
          @csrf @method('PATCH')
          <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white rounded-xl px-4 py-3.5 text-[14px] font-bold transition-colors flex items-center justify-center gap-2 shadow-sm">
            <i class="bi bi-shield-check text-base"></i> Sahkan Pembayaran & Lanjutkan
          </button>
        </form>
      </div>
    @empty
      <div class="col-span-full bg-white border border-sg-border rounded-2xl p-12 text-center shadow-sm">
        <div class="text-sg-sub text-5xl mb-4"><i class="bi bi-credit-card-2-back"></i></div>
        <p class="text-sg-text font-bold text-lg mb-1">Tidak ada pembayaran tertunda</p>
        <p class="text-sg-sub text-sm">Semua transaksi transfer bank atau QRIS sudah diverifikasi bersih.</p>
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