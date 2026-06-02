<div class="page {{ ($initPage ?? '') === 'laporan' ? 'active' : '' }}" id="page-laporan">
  
  <div class="rounded-3xl p-6 sm:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-6 shadow-md" style="background:linear-gradient(135deg,#0A1628,#1A2A45);">
    
    <div class="w-full md:w-auto">
      <div class="text-[11px] font-bold text-white/50 uppercase tracking-widest mb-1">Total Pendapatan</div>
      <span class="stat-number-lg text-4xl sm:text-[42px] break-all">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</span>
    </div>
    
    <div class="w-full md:w-auto flex flex-col sm:flex-row md:flex-col items-stretch sm:items-center md:items-end gap-3 sm:gap-4 md:gap-3">
      
      <div class="flex gap-1 w-full sm:w-auto bg-white/5 p-1.5 rounded-xl border border-white/10">
        <a href="?periode=hari" class="flex-1 sm:flex-none text-sm font-semibold rounded-lg px-4 py-2 sm:py-1.5 text-center transition-colors {{ request('periode') == 'hari' ? 'bg-sg-blue text-white shadow-sm' : 'text-white/70 hover:bg-white/10' }}">Hari</a>
        <a href="?periode=bulan" class="flex-1 sm:flex-none text-sm font-semibold rounded-lg px-4 py-2 sm:py-1.5 text-center transition-colors {{ request('periode') == 'bulan' || !request('periode') ? 'bg-sg-blue text-white shadow-sm' : 'text-white/70 hover:bg-white/10' }}">Bulan</a>
        <a href="?periode=tahun" class="flex-1 sm:flex-none text-sm font-semibold rounded-lg px-4 py-2 sm:py-1.5 text-center transition-colors {{ request('periode') == 'tahun' ? 'bg-sg-blue text-white shadow-sm' : 'text-white/70 hover:bg-white/10' }}">Tahun</a>
      </div>
      
      <div class="flex gap-2 w-full sm:w-auto">
        <button onclick="exportCSV()" class="flex-1 sm:flex-none flex items-center justify-center gap-1.5 text-xs font-semibold rounded-xl px-4 py-2.5 sm:py-2 border border-white/15 text-white/80 hover:bg-white/10 hover:text-white transition-colors">
          <i class="bi bi-download text-sm"></i> Export CSV
        </button>
        <button onclick="exportPDF()" class="flex-1 sm:flex-none flex items-center justify-center gap-1.5 text-xs font-semibold rounded-xl px-4 py-2.5 sm:py-2 bg-sg-blue text-white hover:bg-sg-bluedk shadow-sm transition-colors">
          <i class="bi bi-file-earmark-pdf-fill text-sm"></i> Export PDF
        </button>
      </div>
      
    </div>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-4">
    
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="absolute right-4 top-4 w-11 h-11 rounded-xl bg-sg-bluelt flex items-center justify-center text-xl shadow-sm">📦</div>
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide pr-12">Total Pesanan</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">{{ number_format($totalPesanan ?? 0, 0, ',', '.') }}</span>
    </div>
    
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="absolute right-4 top-4 w-11 h-11 rounded-xl bg-sg-greenlt flex items-center justify-center text-xl shadow-sm">🏍️</div>
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide pr-12">Pesanan Motor</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">{{ number_format($totalPesananMotor ?? 0, 0, ',', '.') }}</span>
    </div>
    
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="absolute right-4 top-4 w-11 h-11 rounded-xl bg-sg-orangelt flex items-center justify-center text-xl shadow-sm">🚗</div>
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide pr-12">Pesanan Mobil</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">{{ number_format($totalPesananMobil ?? 0, 0, ',', '.') }}</span>
    </div>
    
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="absolute right-4 top-4 w-11 h-11 rounded-xl bg-sg-yellowlt flex items-center justify-center text-xl shadow-sm">⭐</div>
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide pr-12">Rata-rata/Pesanan</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">Rp {{ number_format(floor(($rataRataPesanan ?? 0) / 1000), 0, ',', '.') }}K</span>
    </div>
  </div>

  <script>
    function exportCSV() {
        // Mengarahkan ke rute export CSV
        window.location.href = "{{ route('laporan.exportCsv') }}";
    }

    function exportPDF() {
        // Mengarahkan ke rute export PDF
        window.location.href = "{{ route('laporan.exportPdf') }}";
    }

    function selPeriod(btn) {
        // Logika untuk tab Hari/Bulan/Tahun (sudah dihandle via <a> di kode sebelumnya)
    }
  </script>
</div>