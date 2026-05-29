<div class="page {{ ($initPage ?? '') === 'laporan' ? 'active' : '' }}" id="page-laporan">
  
  <div class="rounded-3xl p-6 sm:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-6 shadow-md" style="background:linear-gradient(135deg,#0A1628,#1A2A45);">
    
    <div class="w-full md:w-auto">
      <div class="text-[11px] font-bold text-white/50 uppercase tracking-widest mb-1">Total Pendapatan</div>
      <span class="stat-number-lg text-4xl sm:text-[42px] break-all">Rp 24.750.000</span>
      <div class="text-[13px] text-sg-green mt-2 font-semibold flex items-center gap-1.5">
        <i class="bi bi-arrow-up-right-circle-fill"></i> 23% dibanding bulan lalu
      </div>
    </div>
    
    <div class="w-full md:w-auto flex flex-col sm:flex-row md:flex-col items-stretch sm:items-center md:items-end gap-3 sm:gap-4 md:gap-3">
      
      <div class="flex gap-1 w-full sm:w-auto bg-white/5 p-1.5 rounded-xl border border-white/10">
        <button class="flex-1 sm:flex-none text-sm font-semibold rounded-lg px-4 py-2 sm:py-1.5 text-white/70 hover:bg-white/10 transition-colors" onclick="selPeriod(this)">Hari</button>
        <button class="flex-1 sm:flex-none text-sm font-semibold rounded-lg px-4 py-2 sm:py-1.5 bg-sg-blue text-white shadow-sm" onclick="selPeriod(this)">Bulan</button>
        <button class="flex-1 sm:flex-none text-sm font-semibold rounded-lg px-4 py-2 sm:py-1.5 text-white/70 hover:bg-white/10 transition-colors" onclick="selPeriod(this)">Tahun</button>
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
      <span class="stat-number text-2xl md:text-[30px] mt-2">312</span>
      <div class="text-xs font-semibold mt-3 text-sg-green flex items-center gap-0.5">
        <i class="bi bi-arrow-up-short text-lg leading-none"></i> 12% dari bulan lalu
      </div>
    </div>
    
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="absolute right-4 top-4 w-11 h-11 rounded-xl bg-sg-greenlt flex items-center justify-center text-xl shadow-sm">🏍️</div>
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide pr-12">Pesanan Motor</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">198</span>
      <div class="text-xs font-medium mt-3 text-sg-sub flex items-center gap-1.5">
        <div class="w-2 h-2 rounded-full bg-sg-green"></div> 63% dari total
      </div>
    </div>
    
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="absolute right-4 top-4 w-11 h-11 rounded-xl bg-sg-orangelt flex items-center justify-center text-xl shadow-sm">🚗</div>
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide pr-12">Pesanan Mobil</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">114</span>
      <div class="text-xs font-medium mt-3 text-sg-sub flex items-center gap-1.5">
        <div class="w-2 h-2 rounded-full bg-sg-orange"></div> 37% dari total
      </div>
    </div>
    
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="absolute right-4 top-4 w-11 h-11 rounded-xl bg-sg-yellowlt flex items-center justify-center text-xl shadow-sm">⭐</div>
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide pr-12">Rata-rata/Pesanan</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">Rp 79K</span>
      <div class="text-xs font-semibold mt-3 text-sg-green flex items-center gap-0.5">
        <i class="bi bi-arrow-up-short text-lg leading-none"></i> dari Rp 65K
      </div>
    </div>
    
  </div>

</div>