<div class="page {{ ($initPage ?? 'dashboard') === 'dashboard' ? 'active' : '' }}" id="page-dashboard">
  
  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-6">
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pendapatan Hari Ini</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">Rp 1,24jt</span>
      <div class="text-xs font-semibold mt-3 text-sg-green flex items-center gap-0.5">
        <i class="bi bi-arrow-up-short text-lg leading-none"></i> 18% dari kemarin
      </div>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pesanan Selesai</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">28</span>
      <div class="text-xs font-semibold mt-3 text-sg-green flex items-center gap-0.5">
        <i class="bi bi-arrow-up-short text-lg leading-none"></i> 5 dari kemarin
      </div>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Antrian Aktif</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">5</span>
      <div class="text-xs font-semibold mt-3 text-sg-red">Estimasi 2 jam</div>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
      <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pelanggan Baru</div>
      <span class="stat-number text-2xl md:text-[30px] mt-2">12</span>
      <div class="text-xs font-semibold mt-3 text-sg-green flex items-center gap-0.5">
        <i class="bi bi-arrow-up-short text-lg leading-none"></i> 3 hari ini
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 mb-6">
    <div class="lg:col-span-2 flex flex-col">
      <div class="flex items-center justify-between mb-3">
        <span class="font-display font-bold text-[16px]">Pesanan Terbaru</span>
        <a class="text-xs font-semibold text-sg-blue hover:underline cursor-pointer transition-all" onclick="showPage('pesanan',null)">Lihat semua &rarr;</a>
      </div>
      
      <div class="bg-white rounded-2xl border border-sg-border shadow-sm flex-1 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left whitespace-nowrap min-w-[600px]">
            <thead class="bg-[#FAFBFD]">
              <tr>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">#</th>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Pelanggan</th>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Layanan</th>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Kendaraan</th>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Status</th>
                <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr class="hover:bg-sg-bluelt/30 transition-colors">
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-bold text-sg-sub">#007</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-medium">Raditya H.</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border">Snow Wash Motor</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border">Honda Beat</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border"><span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-1 rounded-full bg-sg-bluelt text-sg-blue">⟳ Proses</span></td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-bold">Rp 35.000</td>
              </tr>
              <tr class="hover:bg-sg-bluelt/30 transition-colors">
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-bold text-sg-sub">#006</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-medium">Rizal M.</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border">Detailing Mobil</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border">Avanza</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border"><span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-1 rounded-full bg-sg-greenlt text-sg-green">✓ Selesai</span></td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-bold">Rp 350.000</td>
              </tr>
              <tr class="hover:bg-sg-bluelt/30 transition-colors">
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-bold text-sg-sub">#005</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-medium">Faza I.</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border">Steam Biasa Motor</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border">NMAX</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border"><span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-1 rounded-full bg-sg-greenlt text-sg-green">✓ Selesai</span></td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-bold">Rp 25.000</td>
              </tr>
              <tr class="hover:bg-sg-bluelt/30 transition-colors">
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-bold text-sg-sub">#004</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-medium">Rifal D.</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border">Snow Wash Mobil</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border">HRV</td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border"><span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-1 rounded-full bg-sg-orangelt text-sg-orange">◷ Antri</span></td>
                <td class="px-5 py-3.5 text-[13.5px] border-b border-sg-border font-bold">Rp 85.000</td>
              </tr>
              <tr class="hover:bg-sg-bluelt/30 transition-colors">
                <td class="px-5 py-3.5 text-[13.5px] font-bold text-sg-sub">#003</td>
                <td class="px-5 py-3.5 text-[13.5px] font-medium">Budi S.</td>
                <td class="px-5 py-3.5 text-[13.5px]">Detailing Motor</td>
                <td class="px-5 py-3.5 text-[13.5px]">Vario 150</td>
                <td class="px-5 py-3.5 text-[13.5px]"><span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-1 rounded-full bg-sg-greenlt text-sg-green">✓ Selesai</span></td>
                <td class="px-5 py-3.5 text-[13.5px] font-bold">Rp 120.000</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="flex flex-col">
      <div class="flex items-center justify-between mb-3">
        <span class="font-display font-bold text-[16px]">Antrian Sekarang</span>
        <a class="text-xs font-semibold text-sg-blue hover:underline cursor-pointer transition-all" onclick="showPage('antrian',null)">Kelola &rarr;</a>
      </div>
      <div class="bg-white rounded-2xl border border-sg-border shadow-sm flex-1">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-sg-border hover:bg-gray-50 transition-colors cursor-pointer">
          <div class="w-[42px] h-[42px] rounded-xl bg-sg-blue text-white flex items-center justify-center font-display text-lg font-extrabold flex-shrink-0 shadow-sm">05</div>
          <div class="flex-grow"><div class="font-semibold text-sm text-sg-text">Raditya H. — Beat</div><div class="text-xs text-sg-sub mt-0.5">Snow Wash Motor</div></div>
          <div class="text-right"><div class="text-xs text-sg-sub">10:12</div><div class="text-[11px] font-bold text-sg-blue mt-1">Sedang proses</div></div>
        </div>
        <div class="flex items-center gap-3 px-5 py-4 border-b border-sg-border hover:bg-gray-50 transition-colors cursor-pointer">
          <div class="w-[42px] h-[42px] rounded-xl bg-sg-bluelt text-sg-blue flex items-center justify-center font-display text-lg font-extrabold flex-shrink-0">06</div>
          <div class="flex-grow"><div class="font-semibold text-sm text-sg-text">Rifal D. — HRV</div><div class="text-xs text-sg-sub mt-0.5">Snow Wash Mobil</div></div>
          <div class="text-right"><div class="text-xs text-sg-sub">10:30</div><div class="text-[11px] font-bold text-sg-orange mt-1">~25 menit</div></div>
        </div>
        <div class="flex items-center gap-3 px-5 py-4 border-b border-sg-border hover:bg-gray-50 transition-colors cursor-pointer">
          <div class="w-[42px] h-[42px] rounded-xl bg-sg-bluelt text-sg-blue flex items-center justify-center font-display text-lg font-extrabold flex-shrink-0">07</div>
          <div class="flex-grow"><div class="font-semibold text-sm text-sg-text">Sinta A. — Aerox</div><div class="text-xs text-sg-sub mt-0.5">Steam Biasa Motor</div></div>
          <div class="text-right"><div class="text-xs text-sg-sub">11:00</div><div class="text-[11px] font-bold text-sg-orange mt-1">~55 menit</div></div>
        </div>
        <div class="flex items-center gap-3 px-5 py-4 hover:bg-gray-50 transition-colors cursor-pointer rounded-b-2xl">
          <div class="w-[42px] h-[42px] rounded-xl bg-sg-bluelt text-sg-blue flex items-center justify-center font-display text-lg font-extrabold flex-shrink-0">08</div>
          <div class="flex-grow"><div class="font-semibold text-sm text-sg-text">Doni K. — Innova</div><div class="text-xs text-sg-sub mt-0.5">Detailing Mobil</div></div>
          <div class="text-right"><div class="text-xs text-sg-sub">13:00</div><div class="text-[11px] font-medium text-sg-sub mt-1">Terjadwal</div></div>
        </div>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 lg:gap-6">
    <div class="lg:col-span-3 bg-white rounded-2xl border border-sg-border shadow-sm flex flex-col">
      <div class="px-5 py-4 border-b border-sg-border flex items-center justify-between">
        <span class="font-display font-bold text-[15px]">Pendapatan 7 Hari Terakhir</span>
        <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-1 rounded-full bg-sg-bluelt text-sg-blue">Minggu ini</span>
      </div>
      <div class="p-6 flex-1 flex flex-col justify-end">
        <div class="flex items-end justify-between gap-1.5 md:gap-3 h-40">
          <div class="flex-1 flex flex-col items-center gap-2"><div class="text-[10px] text-sg-sub font-semibold">820K</div><div class="bar w-full bg-sg-bluelt" style="height:68%;"></div><div class="text-[10px] text-sg-sub font-medium">Sen</div></div>
          <div class="flex-1 flex flex-col items-center gap-2"><div class="text-[10px] text-sg-sub font-semibold">950K</div><div class="bar w-full bg-sg-bluelt" style="height:79%;"></div><div class="text-[10px] text-sg-sub font-medium">Sel</div></div>
          <div class="flex-1 flex flex-col items-center gap-2"><div class="text-[10px] text-sg-sub font-semibold">680K</div><div class="bar w-full bg-sg-bluelt" style="height:56%;"></div><div class="text-[10px] text-sg-sub font-medium">Rab</div></div>
          <div class="flex-1 flex flex-col items-center gap-2"><div class="text-[10px] text-sg-sub font-semibold">1,1jt</div><div class="bar w-full bg-sg-bluelt" style="height:91%;"></div><div class="text-[10px] text-sg-sub font-medium">Kam</div></div>
          <div class="flex-1 flex flex-col items-center gap-2"><div class="text-[10px] text-sg-sub font-semibold">1,3jt</div><div class="bar w-full bg-sg-blue" style="height:100%;"></div><div class="text-[10px] text-sg-sub font-medium">Jum</div></div>
          <div class="flex-1 flex flex-col items-center gap-2"><div class="text-[10px] text-sg-sub font-semibold">1,5jt</div><div class="bar w-full bg-sg-blue" style="height:100%;"></div><div class="text-[10px] text-sg-sub font-medium">Sab</div></div>
          <div class="flex-1 flex flex-col items-center gap-2"><div class="text-[10px] font-bold text-sg-blue">1,24jt</div><div class="bar w-full bg-sg-sky shadow-[0_-4px_10px_rgba(56,182,255,0.3)]" style="height:85%;"></div><div class="text-[10px] font-bold text-sg-blue">Hari ini</div></div>
        </div>
      </div>
    </div>
    
    <div class="lg:col-span-2 bg-white rounded-2xl border border-sg-border shadow-sm flex flex-col">
      <div class="px-5 py-4 border-b border-sg-border">
        <span class="font-display font-bold text-[15px]">Distribusi Layanan</span>
      </div>
      <div class="p-6 flex-1 flex flex-col sm:flex-row items-center justify-center sm:justify-start gap-6 sm:gap-8">
        <div class="donut flex-shrink-0 mx-auto sm:mx-0">
          <div class="donut-center">
            <div class="font-display text-xl font-black text-sg-text">156</div>
            <div class="text-[10px] text-sg-sub font-bold uppercase tracking-wider">Pesanan</div>
          </div>
        </div>
        <div class="flex-grow w-full flex flex-col gap-3">
          <div class="flex justify-between items-center"><div class="flex items-center gap-2.5 text-[13px] font-medium text-sg-text"><div class="w-3 h-3 rounded-sm bg-sg-blue flex-shrink-0 shadow-sm"></div>Snow Wash</div><div class="font-bold text-[13px]">45%</div></div>
          <div class="flex justify-between items-center"><div class="flex items-center gap-2.5 text-[13px] font-medium text-sg-text"><div class="w-3 h-3 rounded-sm bg-sg-sky flex-shrink-0 shadow-sm"></div>Steam Biasa</div><div class="font-bold text-[13px]">27%</div></div>
          <div class="flex justify-between items-center"><div class="flex items-center gap-2.5 text-[13px] font-medium text-sg-text"><div class="w-3 h-3 rounded-sm bg-sg-green flex-shrink-0 shadow-sm"></div>Detailing</div><div class="font-bold text-[13px]">13%</div></div>
          <div class="flex justify-between items-center"><div class="flex items-center gap-2.5 text-[13px] font-medium text-sg-text"><div class="w-3 h-3 rounded-sm bg-sg-orange flex-shrink-0 shadow-sm"></div>Lainnya</div><div class="font-bold text-[13px]">15%</div></div>
        </div>
      </div>
    </div>
  </div>
</div>  