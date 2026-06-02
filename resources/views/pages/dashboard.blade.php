<div class="page {{ ($initPage ?? 'dashboard') === 'dashboard' ? 'active' : '' }}" id="page-dashboard">
  
  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-6">
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pendapatan Hari Ini</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}</span>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pesanan Selesai</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">{{ $pesananSelesaiHariIni ?? 0 }}</span>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Antrian Aktif</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">{{ $antrianAktif ?? 0 }}</span>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pelanggan Baru</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">{{ $pelangganBaruHariIni ?? 0 }}</span>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 mb-6">
    <div class="lg:col-span-2 flex flex-col">
      <div class="flex items-center justify-between mb-3">
        <span class="font-display font-bold text-[16px]">Pesanan Terbaru</span>
        <a href="/pesanan" class="text-xs font-semibold text-sg-blue hover:underline cursor-pointer transition-all">Lihat semua &rarr;</a>
      </div>
      
      <div class="bg-white rounded-2xl border border-sg-border shadow-sm flex-1 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left whitespace-nowrap min-w-[600px]">
            <thead class="bg-[#FAFBFD]">
              <tr>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">TANGGAL</th>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Pelanggan</th>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Layanan</th>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Kendaraan</th>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Status</th>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pesanansTerbaru as $p)
              <tr class="hover:bg-sg-bluelt/30 transition-colors">
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-bold text-sg-sub">
                    {{ \Carbon\Carbon::parse($p->created_at)->format('d M') }}
                </td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-medium">{{ $p->nama_pelanggan }}</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border">{{ $p->layanan->nama_layanan ?? '-' }}</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border">{{ $p->kendaraan }}</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border">
                    <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-1 rounded-full 
                        {{ $p->status == 'Selesai' ? 'bg-sg-greenlt text-sg-green' : ($p->status == 'Proses' ? 'bg-sg-bluelt text-sg-blue' : 'bg-sg-orangelt text-sg-orange') }}">
                        {{ $p->status }}
                    </span>
                </td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-bold">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="flex flex-col">
      <div class="flex items-center justify-between mb-3">
        <span class="font-display font-bold text-[16px]">Antrian Sekarang</span>
        <a href="/antrian-jadwal" class="text-xs font-semibold text-sg-blue hover:underline cursor-pointer transition-all">Kelola &rarr;</a>
      </div>
      <div class="bg-white rounded-2xl border border-sg-border shadow-sm flex-1 min-h-[300px] flex flex-col overflow-hidden">
        @forelse($antrianSidebar as $index => $a)
          <div class="flex items-center gap-3 px-5 py-4 border-b border-sg-border hover:bg-gray-50 transition-colors cursor-pointer">
            <div class="w-[42px] h-[42px] rounded-xl bg-sg-blue text-white flex items-center justify-center font-display text-lg font-extrabold flex-shrink-0 shadow-sm">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
            <div class="flex-grow">
                <div class="font-semibold text-sm text-sg-text">{{ $a->nama_pelanggan }} — {{ $a->kendaraan }}</div>
                <div class="text-xs text-sg-sub mt-0.5">{{ $a->layanan->nama_layanan ?? '-' }}</div>
            </div>
            <div class="text-right">
                <div class="text-[11px] font-bold text-sg-blue mt-1">{{ $a->status }}</div>
            </div>
          </div>
        @empty
          <div class="flex flex-col items-center justify-center flex-1 p-8 text-center bg-gray-50/50">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-3 text-sg-sub shadow-sm border border-gray-100">
                <i class="bi bi-calendar-check text-2xl text-sg-blue/40"></i>
            </div>
            <p class="text-sm font-semibold text-sg-text">Antrian Kosong</p>
            <p class="text-xs text-sg-sub mt-1 max-w-[200px]">Saat ini tidak ada kendaraan dalam proses pencucian.</p>
          </div>
        @endforelse
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 lg:gap-6">
    <div class="lg:col-span-3 bg-white rounded-2xl border border-sg-border shadow-sm flex flex-col">
      <div class="px-5 py-4 border-b border-sg-border flex items-center justify-between">
        <span class="font-display font-bold text-[15px]">Pendapatan 7 Hari Terakhir</span>
      </div>
      <div class="p-6 flex-1 flex flex-col justify-end">
        <div class="flex items-end justify-between gap-1.5 md:gap-3 h-64">
          @foreach($pendapatan7Hari as $data)
            @php 
                $height = $maxPendapatan > 0 ? ($data['jumlah'] / $maxPendapatan) * 100 : 0; 
            @endphp
            <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
              <div class="text-[10px] text-sg-sub font-semibold whitespace-nowrap">{{ $data['label'] }}</div>
              
              <div class="bar w-full bg-sg-blue {{ $loop->last ? 'shadow-[0_-4px_10px_rgba(56,182,255,0.3)]' : '' }}" 
                   style="height:{{ $height }}%; min-height: 4px;">
              </div>
              
              <div class="text-[10px] text-sg-sub font-medium">{{ $data['hari'] }}</div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    
    <div class="lg:col-span-2 bg-white rounded-2xl border border-sg-border shadow-sm flex flex-col">
      <div class="px-5 py-4 border-b border-sg-border">
        <span class="font-display font-bold text-[15px]">Distribusi Layanan (Bulan Ini)</span>
      </div>
      <div class="p-6 flex-1 flex flex-col sm:flex-row items-center justify-center gap-6">
        <div class="w-32 h-32 relative">
          <canvas id="layananChart"></canvas>
        </div>
        <div class="flex-grow w-full flex flex-col gap-3">
          @forelse($distribusiLayanan as $data)
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2.5 text-[13px] font-medium text-sg-text">
                    <div class="w-3 h-3 rounded-sm shadow-sm" style="background-color: {{ ['#3B5BDB', '#38B6FF', '#16A34A', '#F59E0B'][$loop->index % 4] }}"></div>
                    {{ $data['nama'] }}
                </div>
                <div class="font-bold text-[13px]">{{ $data['persen'] }}%</div>
            </div>
          @empty
            <div class="text-sm text-sg-sub text-center">Belum ada data pesanan bulan ini.</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('layananChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! $labelsDistribusi !!},
                datasets: [{
                    data: {!! $valuesDistribusi !!},
                    backgroundColor: ['#3B5BDB', '#38B6FF', '#16A34A', '#F59E0B'],
                    borderWidth: 0,
                    cutout: '75%'
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>