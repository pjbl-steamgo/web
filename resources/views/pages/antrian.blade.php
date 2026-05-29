<div class="page {{ ($initPage ?? '') === 'antrian' ? 'active' : '' }}" id="page-antrian">
  
  <style>
    @media (max-width: 767px) {
      /* Ubah struktur tabel bawaan menjadi blok */
      #page-antrian table, #page-antrian thead, #page-antrian tbody, #page-antrian th, #page-antrian td, #page-antrian tr {
        display: block !important;
        width: 100% !important;
        white-space: normal !important;
      }
      /* Sembunyikan header tabel di mobile */
      #page-antrian thead { display: none !important; }
      
      /* Styling untuk setiap baris (menjadi bentuk kartu) */
      #page-antrian tbody tr {
        margin-bottom: 16px;
        border: 1px solid #E2E7F0;
        border-radius: 12px;
        padding: 4px 16px;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      }
      
      /* Styling untuk setiap kolom (menjadi baris list di dalam kartu) */
      #page-antrian tbody td {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 12px 0 !important;
        border-bottom: 1px dashed #E2E7F0 !important;
        text-align: right !important;
        gap: 12px;
      }
      #page-antrian tbody td:last-child {
        border-bottom: none !important;
      }
      
      /* Inject Nama Kolom secara dinamis di sebelah kiri menggunakan pseudo-element */
      #page-antrian tbody td:before {
        font-weight: 700;
        font-size: 11px;
        color: #64748B;
        text-transform: uppercase;
        text-align: left;
      }
      #page-antrian tbody td:nth-child(1):before { content: "# ID"; }
      #page-antrian tbody td:nth-child(2):before { content: "Pelanggan"; }
      #page-antrian tbody td:nth-child(3):before { content: "Layanan"; }
      #page-antrian tbody td:nth-child(4):before { content: "Jam"; }
      #page-antrian tbody td:nth-child(5):before { content: "Status"; }
      #page-antrian tbody td:nth-child(6):before { content: "Aksi"; }
    }
  </style>

  <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-6">
    <div class="flex items-center gap-2 flex-grow">
      <input type="date" class="bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all w-full sm:w-auto shadow-sm" value="2025-02-20">
      <select id="antrian-filter-status" class="bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all w-full sm:w-auto shadow-sm" onchange="filterAntrian()">
        <option>Semua Status</option>
        <option>Proses</option>
        <option>Menunggu</option>
        <option>Terjadwal</option>
        <option>Selesai</option>
      </select>
    </div>
    <button class="w-full sm:w-auto sm:ml-auto bg-sg-blue text-white font-semibold rounded-xl px-5 py-2.5 text-sm hover:bg-sg-bluedk transition-all shadow-sm flex items-center justify-center" onclick="openModal('modal-tambah-antrian')">
      <i class="bi bi-plus-lg mr-2"></i> Tambah Antrian
    </button>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6">
    
    <div class="lg:col-span-2 bg-white rounded-2xl border border-sg-border shadow-sm hover:shadow-md transition-shadow flex flex-col overflow-hidden">
      <div class="bg-[#FAFBFD] px-5 py-4 border-b border-sg-border flex items-center justify-between">
        <span class="font-display font-bold text-[15px]">Antrian Aktif — 20 Feb 2025</span>
        <span class="inline-flex items-center gap-1.5 text-[11px] font-bold px-3 py-1 rounded-full bg-sg-orangelt text-sg-orange shadow-sm" id="antrian-count-badge">5 Antrian</span>
      </div>
      
      <div class="overflow-x-auto flex-1 p-3 md:p-0 bg-gray-50 md:bg-transparent">
        <table class="w-full text-left whitespace-normal md:whitespace-nowrap min-w-full md:min-w-[700px]">
          <thead class="bg-[#FAFBFD]">
            <tr>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">#</th>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Pelanggan</th>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Layanan</th>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Jam</th>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Status</th>
              <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody id="antrian-tbody" class="divide-y divide-sg-border">
          </tbody>
        </table>
      </div>
    </div>

    <div class="bg-white rounded-2xl border border-sg-border shadow-sm hover:shadow-md transition-shadow flex flex-col">
      <div class="px-5 py-4 border-b border-sg-border bg-[#FAFBFD] rounded-t-2xl">
        <span class="font-display font-bold text-[15px]">Slot Waktu</span>
      </div>
      
      <div class="p-5 flex flex-col gap-3">
        <div class="flex justify-between items-center p-3.5 rounded-xl border-l-4 bg-sg-redlt border-sg-red hover:brightness-95 transition-all cursor-default">
          <div>
            <div class="font-bold text-[13px] text-sg-red">08:00 – 09:00</div>
            <div class="text-xs text-sg-red/70 mt-0.5 font-medium">2 slot — Penuh</div>
          </div>
          <span class="inline-flex text-[11px] font-bold px-2.5 py-1 rounded-full bg-white/60 text-sg-red">Penuh</span>
        </div>
        
        <div class="flex justify-between items-center p-3.5 rounded-xl border-l-4 bg-sg-redlt border-sg-red hover:brightness-95 transition-all cursor-default">
          <div>
            <div class="font-bold text-[13px] text-sg-red">09:00 – 10:00</div>
            <div class="text-xs text-sg-red/70 mt-0.5 font-medium">2 slot — Penuh</div>
          </div>
          <span class="inline-flex text-[11px] font-bold px-2.5 py-1 rounded-full bg-white/60 text-sg-red">Penuh</span>
        </div>
        
        <div class="flex justify-between items-center p-3.5 rounded-xl border-l-4 bg-sg-orangelt border-sg-orange hover:brightness-95 transition-all cursor-default">
          <div>
            <div class="font-bold text-[13px] text-sg-orange">10:00 – 11:00</div>
            <div class="text-xs text-sg-orange/70 mt-0.5 font-medium">2/3 slot terisi</div>
          </div>
          <span class="inline-flex text-[11px] font-bold px-2.5 py-1 rounded-full bg-white/60 text-sg-orange">Hampir</span>
        </div>
        
        <div class="flex justify-between items-center p-3.5 rounded-xl border-l-4 bg-sg-greenlt border-sg-green hover:brightness-95 transition-all cursor-default">
          <div>
            <div class="font-bold text-[13px] text-sg-green">11:00 – 12:00</div>
            <div class="text-xs text-sg-green/70 mt-0.5 font-medium">1/3 slot terisi</div>
          </div>
          <span class="inline-flex text-[11px] font-bold px-2.5 py-1 rounded-full bg-white/60 text-sg-green">Tersedia</span>
        </div>
        
        <div class="flex justify-between items-center p-3.5 rounded-xl border-l-4 bg-sg-greenlt border-sg-green hover:brightness-95 transition-all cursor-default">
          <div>
            <div class="font-bold text-[13px] text-sg-green">13:00 – 14:00</div>
            <div class="text-xs text-sg-green/70 mt-0.5 font-medium">2/3 slot terisi</div>
          </div>
          <span class="inline-flex text-[11px] font-bold px-2.5 py-1 rounded-full bg-white/60 text-sg-green">Tersedia</span>
        </div>
        
        <div class="flex justify-between items-center p-3.5 rounded-xl border-l-4 bg-sg-greenlt border-sg-green hover:brightness-95 transition-all cursor-default">
          <div>
            <div class="font-bold text-[13px] text-sg-green">14:00 – 16:00</div>
            <div class="text-xs text-sg-green/70 mt-0.5 font-medium">0/3 slot terisi</div>
          </div>
          <span class="inline-flex text-[11px] font-bold px-2.5 py-1 rounded-full bg-white/60 text-sg-green">Kosong</span>
        </div>
      </div>
    </div>
    
  </div>
</div>