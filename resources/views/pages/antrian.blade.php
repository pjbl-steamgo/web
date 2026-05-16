<div class="page {{ ($initPage ?? '') === 'antrian' ? 'active' : '' }}" id="page-antrian">
  <div class="flex flex-wrap items-center gap-2 mb-4">
    <input type="date" class="bg-sg-bg border border-sg-border rounded-xl px-3 py-2 text-sm text-sg-text focus:outline-none focus:border-sg-blue" value="2025-02-20">
    <select id="antrian-filter-status" class="bg-sg-bg border border-sg-border rounded-xl px-3 py-2 text-sm text-sg-text focus:outline-none focus:border-sg-blue" onchange="filterAntrian()">
      <option>Semua Status</option><option>Proses</option><option>Menunggu</option><option>Terjadwal</option><option>Selesai</option>
    </select>
    <button class="ml-auto bg-sg-blue text-white font-semibold rounded-xl px-4 py-2 text-sm hover:bg-sg-bluedk transition-colors" onclick="openModal('modal-tambah-antrian')">
      <i class="bi bi-plus-lg mr-1"></i> Tambah Antrian
    </button>
  </div>
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
    <div class="lg:col-span-2 bg-white rounded-2xl border border-sg-border overflow-hidden shadow-sm">
      <div class="bg-[#FAFBFD] px-5 py-4 border-b border-sg-border flex items-center justify-between rounded-t-2xl">
        <span class="font-display font-bold text-sm">Antrian Aktif — 20 Feb 2025</span>
        <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-orangelt text-sg-orange" id="antrian-count-badge">5 Antrian</span>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-[#FAFBFD]">
            <tr>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">#</th>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Pelanggan</th>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Layanan</th>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Jam</th>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Status</th>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Aksi</th>
            </tr>
          </thead>
          <tbody id="antrian-tbody">
          </tbody>
        </table>
      </div>
    </div>
    <div class="bg-white rounded-2xl border border-sg-border shadow-sm">
      <div class="px-5 py-4 border-b border-sg-border"><span class="font-display font-bold text-sm">Slot Waktu</span></div>
      <div class="p-5 flex flex-col gap-2">
        <div class="flex justify-between items-center p-3 rounded-xl border-l-[3px] bg-sg-redlt border-sg-red"><div><div class="font-bold text-[13px] text-sg-red">08:00 – 09:00</div><div class="text-xs text-sg-sub">2 slot — Penuh</div></div><span class="inline-flex text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-redlt text-sg-red">Penuh</span></div>
        <div class="flex justify-between items-center p-3 rounded-xl border-l-[3px] bg-sg-redlt border-sg-red"><div><div class="font-bold text-[13px] text-sg-red">09:00 – 10:00</div><div class="text-xs text-sg-sub">2 slot — Penuh</div></div><span class="inline-flex text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-redlt text-sg-red">Penuh</span></div>
        <div class="flex justify-between items-center p-3 rounded-xl border-l-[3px] bg-sg-orangelt border-sg-orange"><div><div class="font-bold text-[13px] text-sg-orange">10:00 – 11:00</div><div class="text-xs text-sg-sub">2/3 slot terisi</div></div><span class="inline-flex text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-orangelt text-sg-orange">Hampir</span></div>
        <div class="flex justify-between items-center p-3 rounded-xl border-l-[3px] bg-sg-greenlt border-sg-green"><div><div class="font-bold text-[13px] text-sg-green">11:00 – 12:00</div><div class="text-xs text-sg-sub">1/3 slot terisi</div></div><span class="inline-flex text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-greenlt text-sg-green">Tersedia</span></div>
        <div class="flex justify-between items-center p-3 rounded-xl border-l-[3px] bg-sg-greenlt border-sg-green"><div><div class="font-bold text-[13px] text-sg-green">13:00 – 14:00</div><div class="text-xs text-sg-sub">2/3 slot terisi</div></div><span class="inline-flex text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-greenlt text-sg-green">Tersedia</span></div>
        <div class="flex justify-between items-center p-3 rounded-xl border-l-[3px] bg-sg-greenlt border-sg-green"><div><div class="font-bold text-[13px] text-sg-green">14:00 – 16:00</div><div class="text-xs text-sg-sub">0/3 slot terisi</div></div><span class="inline-flex text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-greenlt text-sg-green">Kosong</span></div>
      </div>
    </div>
  </div>
</div>