<div class="page {{ ($initPage ?? '') === 'pesanan' ? 'active' : '' }}" id="page-pesanan">
  
  <style>
    @media (max-width: 767px) {
      /* Ubah struktur tabel bawaan menjadi blok */
      #page-pesanan table, #page-pesanan thead, #page-pesanan tbody, #page-pesanan th, #page-pesanan td, #page-pesanan tr {
        display: block !important;
        width: 100% !important;
        white-space: normal !important;
      }
      /* Sembunyikan header tabel di mobile */
      #page-pesanan thead { display: none !important; }
      
      /* Styling untuk setiap baris (menjadi bentuk kartu) */
      #page-pesanan tbody tr {
        margin-bottom: 16px;
        border: 1px solid #E2E7F0;
        border-radius: 12px;
        padding: 4px 16px;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      }
      
      /* Styling untuk setiap kolom (menjadi baris list di dalam kartu) */
      #page-pesanan tbody td {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 12px 0 !important;
        border-bottom: 1px dashed #E2E7F0 !important;
        text-align: right !important;
        gap: 12px;
      }
      #page-pesanan tbody td:last-child {
        border-bottom: none !important;
      }
      
      /* Inject Nama Kolom secara dinamis di sebelah kiri menggunakan pseudo-element */
      #page-pesanan tbody td:before {
        font-weight: 700;
        font-size: 11px;
        color: #64748B;
        text-transform: uppercase;
        text-align: left;
        flex-shrink: 0;
      }
      /* Sesuai dengan 9 kolom yang ada di tabel Pesanan */
      #page-pesanan tbody td:nth-child(1):before { content: "Kode"; }
      #page-pesanan tbody td:nth-child(2):before { content: "Tanggal"; }
      #page-pesanan tbody td:nth-child(3):before { content: "Pelanggan"; }
      #page-pesanan tbody td:nth-child(4):before { content: "Layanan"; }
      #page-pesanan tbody td:nth-child(5):before { content: "Kendaraan"; }
      #page-pesanan tbody td:nth-child(6):before { content: "Metode Bayar"; }
      #page-pesanan tbody td:nth-child(7):before { content: "Total"; }
      #page-pesanan tbody td:nth-child(8):before { content: "Status"; }
      #page-pesanan tbody td:nth-child(9):before { content: "Aksi"; }
    }
  </style>

  <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 mb-6">
    <div class="flex-1">
      <input id="pesanan-search" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all shadow-sm" placeholder="🔍 Cari nama / kode pesanan..." oninput="searchPesanan()">
    </div>
    
    <div class="flex flex-col sm:flex-row items-stretch gap-3">
      <select id="pesanan-filter-status" class="bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all shadow-sm w-full sm:w-auto" onchange="searchPesanan()">
        <option>Semua Status</option>
        <option>Proses</option>
        <option>Selesai</option>
        <option>Dibatal</option>
        <option>Antri</option>
      </select>
      
      <select id="pesanan-filter-layanan" class="bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all shadow-sm w-full sm:w-auto" onchange="searchPesanan()">
        <option>Semua Layanan</option>
        <option>Steam Biasa</option>
        <option>Snow Wash</option>
        <option>Detailing</option>
      </select>
      
      <input class="bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all shadow-sm w-full sm:w-auto" type="date" value="2025-02-20">
    </div>
  </div>

  <div class="bg-transparent md:bg-white md:rounded-2xl md:border md:border-sg-border md:shadow-sm overflow-hidden flex flex-col">
    <div class="overflow-x-auto p-1 md:p-0">
      <table class="w-full text-left whitespace-normal md:whitespace-nowrap min-w-full md:min-w-[1000px]">
        <thead class="bg-[#FAFBFD]">
          <tr>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Kode</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Tanggal</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Pelanggan</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Layanan</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Kendaraan</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Bayar</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Total</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4">Status</th>
            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-5 py-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody id="pesanan-tbody" class="divide-y divide-sg-border">
          
          <tr class="hover:bg-sg-bluelt/30 transition-colors border-b border-sg-border">
            <td class="px-5 py-3.5 text-[13.5px] font-bold text-sg-sub">#INV-001</td>
            <td class="px-5 py-3.5 text-[13.5px] text-sg-sub">20 Feb 2025</td>
            <td class="px-5 py-3.5 text-[13.5px] font-medium text-sg-text">Faza I.</td>
            <td class="px-5 py-3.5 text-[13.5px]">Steam Biasa Motor</td>
            <td class="px-5 py-3.5 text-[13.5px] text-sg-sub">NMAX</td>
            <td class="px-5 py-3.5 text-[13.5px]">Qris</td>
            <td class="px-5 py-3.5 text-[13.5px] font-bold text-sg-text">Rp 25.000</td>
            <td class="px-5 py-3.5 text-[13.5px]">
              <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-1 rounded-full bg-sg-greenlt text-sg-green">
                ✓ Selesai
              </span>
            </td>
            <td class="px-5 py-3.5 text-[13.5px] text-center">
              <div class="flex items-center justify-end md:justify-center gap-2">
                <button class="w-7 h-7 rounded-lg bg-sg-bluelt text-sg-blue hover:bg-sg-blue hover:text-white transition-colors flex items-center justify-center shadow-sm" title="Lihat Detail">
                  <i class="bi bi-eye text-xs"></i>
                </button>
                <button class="w-7 h-7 rounded-lg bg-sg-redlt text-sg-red hover:bg-sg-red hover:text-white transition-colors flex items-center justify-center shadow-sm" title="Hapus">
                  <i class="bi bi-trash text-xs"></i>
                </button>
              </div>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>