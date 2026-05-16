<div class="page {{ ($initPage ?? '') === 'pelanggan' ? 'active' : '' }}" id="page-pelanggan">
  
  <div class="flex flex-wrap items-center gap-2 mb-4">
    <input class="bg-sg-bg border border-sg-border rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-sg-blue" placeholder="🔍 Cari nama / nomor HP..." oninput="searchPelanggan(this.value)">
    <select class="bg-sg-bg border border-sg-border rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-sg-blue" onchange="filterPelangganMember(this.value)">
      <option>Semua Member</option><option>Silver</option><option>Gold</option><option>Baru</option>
    </select>
    <button class="ml-auto bg-sg-blue text-white font-semibold rounded-xl px-4 py-2 text-sm hover:bg-sg-bluedk transition-colors" onclick="openModal('modal-tambah-pelanggan')">
      <i class="bi bi-plus-lg mr-1"></i> Tambah Pelanggan
    </button>
  </div>
  <div class="bg-white rounded-2xl border border-sg-border overflow-hidden shadow-sm overflow-x-auto">
    <table class="w-full">
      <thead class="bg-[#FAFBFD]">
        <tr>
          <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Pelanggan</th>
          <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Nomor HP</th>
          <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Member</th>
          <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Total Steam</th>
          <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Total Bayar</th>
          <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Terakhir Steam</th>
          <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Aksi</th>
        </tr>
      </thead>
      <tbody id="pelanggan-tbody">
      </tbody>
    </table>
  </div>
</div>