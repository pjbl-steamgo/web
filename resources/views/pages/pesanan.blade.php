<div class="page {{ ($initPage ?? '') === 'pesanan' ? 'active' : '' }}" id="page-pesanan">
  
  <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-6">
    <div class="flex-1 w-full sm:max-w-xs">
      <input id="pesanan-search" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all shadow-sm" placeholder="🔍 Cari pesanan atau pelanggan...">
    </div>
  </div>

  <div class="bg-white border border-sg-border rounded-2xl shadow-sm overflow-hidden">
    
    <div class="hidden md:block overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-[#FAFBFD] border-b border-sg-border text-[11px] font-bold text-sg-sub uppercase tracking-wider">
            <th class="px-6 py-4">Kode & Tanggal</th>
            <th class="px-6 py-4">Pelanggan & Kendaraan</th>
            <th class="px-6 py-4">Layanan</th>
            <th class="px-6 py-4">Total & Pembayaran</th>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-sg-border">
          @forelse ($pesanans ?? [] as $pesanan)
            <tr class="hover:bg-gray-50 transition-colors group">
              
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="font-bold text-sg-text text-[14px]">{{ $pesanan->kode_pesanan }}</div>
                <div class="text-[12px] text-sg-sub mt-0.5">
                  {{ date('d M Y, H:i', strtotime($pesanan->tanggal)) }}
                </div>
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="font-semibold text-sg-text text-[14px]">{{ $pesanan->nama_pelanggan }}</div>
                <div class="text-[12px] text-sg-sub mt-0.5">
                  {{ $pesanan->kendaraan }}
                </div>
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="inline-flex items-center gap-1.5 text-[11px] font-bold px-2.5 py-1 rounded-full bg-sg-bluelt text-sg-blue uppercase tracking-wider">
                  {{ $pesanan->layanan->nama_layanan ?? 'Layanan Dihapus' }}
                </div>
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="font-bold text-sg-text text-[14px]">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</div>
                <div class="text-[12px] text-sg-sub mt-0.5">{{ $pesanan->metode_pembayaran }}</div>
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap">
                @php
                    $status = strtolower($pesanan->status);
                    if ($status === 'antri') {
                        $badgeClass = 'bg-orange-100 text-orange-600';
                        $icon = 'bi-hourglass-split';
                    } elseif ($status === 'proses') {
                        $badgeClass = 'bg-sg-bluelt text-sg-blue';
                        $icon = 'bi-arrow-repeat spin-icon'; 
                    } else {
                        $badgeClass = 'bg-sg-greenlt text-sg-green';
                        $icon = 'bi-check-circle-fill';
                    }
                @endphp
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-[12px] font-bold {{ $badgeClass }}">
                  <i class="bi {{ $icon }}"></i> {{ ucfirst($pesanan->status) }}
                </span>
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap text-right">
                <div class="flex gap-2 justify-end">
                  
                  @if(strtolower($pesanan->status) === 'proses')
                      <button type="button" class="w-9 h-9 rounded-xl bg-sg-greenlt text-sg-green border border-sg-greenlt hover:bg-sg-green hover:text-white flex items-center justify-center transition-colors" title="Selesaikan Pesanan & Lanjut Antrian"
                              data-url="{{ route('pesanan.selesai', $pesanan->id) }}"
                              data-kode="{{ $pesanan->kode_pesanan }}"
                              onclick="openSelesaiPesananModal(this)">
                          <i class="bi bi-check-lg text-lg"></i>
                      </button>
                  @endif
                  
                  <button type="button" class="w-9 h-9 rounded-xl bg-white border border-sg-border text-sg-sub hover:text-sg-blue hover:border-sg-blue flex items-center justify-center transition-colors" title="Chat Pelanggan">
                      <i class="bi bi-chat-dots"></i>
                  </button>

                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-12 text-center">
                <div class="text-sg-sub text-3xl mb-3">📭</div>
                <h3 class="text-sg-text font-semibold text-[15px] mb-1">Belum Ada Pesanan</h3>
                <p class="text-sg-sub text-sm">Pesanan dari pelanggan akan muncul di sini.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="block md:hidden divide-y divide-sg-border">
      @forelse ($pesanans ?? [] as $pesanan)
        @php
            $status = strtolower($pesanan->status);
            if ($status === 'antri') {
                $badgeClass = 'bg-orange-100 text-orange-600';
                $icon = 'bi-hourglass-split';
            } elseif ($status === 'proses') {
                $badgeClass = 'bg-sg-bluelt text-sg-blue';
                $icon = 'bi-arrow-repeat spin-icon'; 
            } else {
                $badgeClass = 'bg-sg-greenlt text-sg-green';
                $icon = 'bi-check-circle-fill';
            }
        @endphp

        <div class="p-4 bg-white hover:bg-gray-50 transition-colors">
          <div class="flex justify-between items-center mb-3">
            <div>
              <div class="font-bold text-sg-text text-[15px]">{{ $pesanan->kode_pesanan }}</div>
              <div class="text-[11px] text-sg-sub">{{ date('d M Y, H:i', strtotime($pesanan->tanggal)) }}</div>
            </div>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl text-[11px] font-bold {{ $badgeClass }}">
              <i class="bi {{ $icon }}"></i> {{ ucfirst($pesanan->status) }}
            </span>
          </div>

          <div class="space-y-2 mb-4 bg-[#FAFBFD] p-3 rounded-xl border border-sg-border/50">
            <div class="flex justify-between text-[13px]">
              <span class="text-sg-sub font-medium">Pelanggan</span>
              <span class="font-semibold text-sg-text">{{ $pesanan->nama_pelanggan }}</span>
            </div>
            <div class="flex justify-between text-[13px]">
              <span class="text-sg-sub font-medium">Kendaraan</span>
              <span class="font-semibold text-sg-text">{{ $pesanan->kendaraan }}</span>
            </div>
            <div class="flex justify-between text-[13px]">
              <span class="text-sg-sub font-medium">Layanan</span>
              <span class="font-bold text-sg-blue">{{ $pesanan->layanan->nama_layanan ?? 'Dihapus' }}</span>
            </div>
            <div class="flex justify-between text-[13px]">
              <span class="text-sg-sub font-medium">Total ({{ $pesanan->metode_pembayaran }})</span>
              <span class="font-bold text-sg-text">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
            </div>
          </div>

          <div class="flex justify-end gap-2">
            
            @if(strtolower($pesanan->status) === 'proses')
                <button type="button" class="w-full sm:w-auto px-4 py-2 rounded-xl bg-sg-greenlt text-sg-green border border-sg-greenlt hover:bg-sg-green hover:text-white flex items-center justify-center gap-2 text-sm font-bold transition-colors flex-1 sm:flex-none"
                        data-url="{{ route('pesanan.selesai', $pesanan->id) }}"
                        data-kode="{{ $pesanan->kode_pesanan }}"
                        onclick="openSelesaiPesananModal(this)">
                    <i class="bi bi-check-lg text-lg"></i> Selesaikan
                </button>
            @endif
            
            <button type="button" class="w-10 h-10 rounded-xl bg-white border border-sg-border text-sg-sub hover:text-sg-blue hover:border-sg-blue flex items-center justify-center transition-colors">
                <i class="bi bi-chat-dots"></i>
            </button>
            
          </div>
        </div>
      @empty
        <div class="p-8 text-center">
          <div class="text-sg-sub text-3xl mb-3">📭</div>
          <h3 class="text-sg-text font-semibold text-[15px] mb-1">Belum Ada Pesanan</h3>
        </div>
      @endforelse
    </div>

  </div>
</div>

<script>
  function openSelesaiPesananModal(button) {
      const url = button.getAttribute('data-url');
      const kode = button.getAttribute('data-kode');

      document.getElementById('form-selesai-pesanan').action = url;
      document.getElementById('selesai-kode-pesanan').innerText = kode;

      openModal('modal-selesai-pesanan');
  }
</script>