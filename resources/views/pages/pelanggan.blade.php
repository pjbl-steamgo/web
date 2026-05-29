<div class="page {{ ($initPage ?? '') === 'pelanggan' ? 'active' : '' }}" id="page-pelanggan">
  
  <style>
    @media (max-width: 767px) {
      #page-pelanggan table, #page-pelanggan thead, #page-pelanggan tbody, #page-pelanggan th, #page-pelanggan td, #page-pelanggan tr {
        display: block !important;
        width: 100% !important;
        white-space: normal !important;
      }
      #page-pelanggan thead { display: none !important; }
      
      #page-pelanggan tbody tr {
        margin-bottom: 16px;
        border: 1px solid #E2E7F0;
        border-radius: 12px;
        padding: 4px 16px;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      }
      
      #page-pelanggan tbody td {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 12px 0 !important;
        border-bottom: 1px dashed #E2E7F0 !important;
        text-align: right !important;
        gap: 12px;
      }
      #page-pelanggan tbody td:last-child {
        border-bottom: none !important;
      }
      
      #page-pelanggan tbody td:before {
        font-weight: 700;
        font-size: 11px;
        color: #64748B;
        text-transform: uppercase;
        text-align: left;
        flex-shrink: 0;
      }
      
      /* Mapping 7 Kolom Tabel Pelanggan */
      #page-pelanggan tbody td:nth-child(1):before { content: "Pelanggan"; }
      #page-pelanggan tbody td:nth-child(2):before { content: "Nomor HP"; }
      #page-pelanggan tbody td:nth-child(3):before { content: "Member"; }
      #page-pelanggan tbody td:nth-child(4):before { content: "Total Steam"; }
      #page-pelanggan tbody td:nth-child(5):before { content: "Total Bayar"; }
      #page-pelanggan tbody td:nth-child(6):before { content: "Terakhir Steam"; }
      #page-pelanggan tbody td:nth-child(7):before { content: "Aksi"; }
    }
  </style>

  <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 mb-6">
    <div class="flex-1 w-full">
      <input class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all shadow-sm" placeholder="🔍 Cari nama / nomor HP..." oninput="searchPelanggan(this.value)">
    </div>
    
    <select class="bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all shadow-sm w-full md:w-auto" onchange="filterPelangganMember(this.value)">
      <option>Semua Member</option>
      <option>Silver</option>
      <option>Gold</option>
      <option>Baru</option>
    </select>
    
    <button class="w-full md:w-auto bg-sg-blue text-white font-semibold rounded-xl px-5 py-2.5 text-sm hover:bg-sg-bluedk transition-all shadow-sm flex items-center justify-center" onclick="openModal('modal-tambah-pelanggan')">
      <i class="bi bi-plus-lg mr-2"></i> Tambah Pelanggan
    </button>
  </div>

  <div class="bg-transparent md:bg-white md:rounded-2xl md:border md:border-sg-border md:shadow-sm overflow-hidden flex flex-col">
    <div class="overflow-x-auto p-1 md:p-0">
      <table class="w-full text-left whitespace-normal md:whitespace-nowrap min-w-full md:min-w-[900px]">
        <thead class="bg-[#FAFBFD]">
          <tr>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Pelanggan</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Nomor HP</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Member</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Total Steam</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Total Bayar</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Terakhir Steam</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody id="pelanggan-tbody" class="divide-y divide-sg-border">
          <tr class="hover:bg-sg-bluelt/30 transition-colors border-b border-sg-border">
            <td class="px-5 py-4">
              <div class="font-bold text-[13.5px] text-sg-text">Faza Izzaturrafi</div>
            </td>
            <td class="px-5 py-4 text-[13.5px] text-sg-sub">0812-3456-7890</td>
            <td class="px-5 py-4">
              <span class="inline-flex items-center gap-1.5 text-[11px] font-bold px-2.5 py-1 rounded-full bg-sg-yellowlt text-sg-yellow border border-sg-yellow/20">
                <i class="bi bi-star-fill text-[10px]"></i> Gold
              </span>
            </td>
            <td class="px-5 py-4 text-[13.5px] font-bold text-sg-text">15x</td>
            <td class="px-5 py-4 text-[13.5px] font-bold text-sg-text">Rp 750.000</td>
            <td class="px-5 py-4 text-[13.5px] text-sg-sub">2 Hari yang lalu</td>
            <td class="px-5 py-4 text-center">
              <div class="flex items-center justify-end md:justify-center gap-2">
                <button class="w-7 h-7 rounded-lg bg-sg-bluelt text-sg-blue hover:bg-sg-blue hover:text-white transition-colors flex items-center justify-center shadow-sm" title="Lihat Profil" onclick="openModal('modal-detail-pelanggan')">
                  <i class="bi bi-person-lines-fill text-xs"></i>
                </button>
                <button class="w-7 h-7 rounded-lg bg-sg-greenlt text-sg-green hover:bg-sg-green hover:text-white transition-colors flex items-center justify-center shadow-sm" title="Chat WhatsApp">
                  <i class="bi bi-whatsapp text-xs"></i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>  