<div class="page {{ ($initPage ?? '') === 'laporan' ? 'active' : '' }}" id="page-laporan">
  
  <div class="rounded-2xl p-6 flex flex-wrap items-center justify-between gap-4 mb-4" style="background:linear-gradient(135deg,#0A1628,#1A2A45);">
    <div>
      <div class="text-xs font-bold text-white/50 uppercase tracking-wide">Total Pendapatan</div>
      <span class="stat-number-lg">Rp 24.750.000</span>
      <div class="text-[13px] text-sg-green mt-1 font-semibold">↑ 23% dibanding bulan lalu</div>
    </div>
    <div class="flex flex-col items-end gap-3">
      <div class="flex gap-2">
        <button class="text-sm font-semibold rounded-lg px-3 py-1.5 text-white/70 hover:bg-white/10 transition-colors" onclick="selPeriod(this)">Hari</button>
        <button class="text-sm font-semibold rounded-lg px-3 py-1.5 bg-sg-blue text-white" onclick="selPeriod(this)">Bulan</button>
        <button class="text-sm font-semibold rounded-lg px-3 py-1.5 text-white/70 hover:bg-white/10 transition-colors" onclick="selPeriod(this)">Tahun</button>
      </div>
      <div class="flex gap-2">
        <button onclick="exportCSV()" class="text-xs font-semibold rounded-lg px-3 py-1.5 border border-white/15 text-white/70 hover:bg-white/10 transition-colors">📥 Export CSV</button>
        <button onclick="exportPDF()" class="text-xs font-semibold rounded-lg px-3 py-1.5 bg-sg-blue text-white hover:bg-sg-bluedk transition-colors">📄 Export PDF</button>
      </div>
    </div>
  </div>
  <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 mb-4">
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm relative overflow-hidden"><div class="absolute right-4 top-4 w-10 h-10 rounded-xl bg-sg-bluelt flex items-center justify-center text-xl">📦</div><div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Total Pesanan</div><span class="stat-number">312</span><div class="text-xs font-semibold mt-2 text-sg-green">↑ 12% dari bulan lalu</div></div>
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm relative overflow-hidden"><div class="absolute right-4 top-4 w-10 h-10 rounded-xl bg-sg-greenlt flex items-center justify-center text-xl">🏍️</div><div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pesanan Motor</div><span class="stat-number">198</span><div class="text-xs font-semibold mt-2 text-sg-sub">63% dari total</div></div>
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm relative overflow-hidden"><div class="absolute right-4 top-4 w-10 h-10 rounded-xl bg-sg-orangelt flex items-center justify-center text-xl">🚗</div><div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pesanan Mobil</div><span class="stat-number">114</span><div class="text-xs font-semibold mt-2 text-sg-sub">37% dari total</div></div>
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm relative overflow-hidden"><div class="absolute right-4 top-4 w-10 h-10 rounded-xl bg-sg-yellowlt flex items-center justify-center text-xl">⭐</div><div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Rata-rata/Pesanan</div><span class="stat-number">Rp 79K</span><div class="text-xs font-semibold mt-2 text-sg-green">↑ dari Rp 65K</div></div>
  </div>
</div>