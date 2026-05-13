<div class="page" id="page-pesanan">
    <div class="flex flex-wrap items-center gap-2 mb-4">
        <input id="pesanan-search" class="bg-sg-bg border border-sg-border rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-sg-blue" placeholder="🔍 Cari nama / kode pesanan..." oninput="searchPesanan()">
        <select id="pesanan-filter-status" class="bg-sg-bg border border-sg-border rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-sg-blue" onchange="searchPesanan()">
            <option>Semua Status</option>
            <option>Proses</option>
            <option>Selesai</option>
            <option>Dibatal</option>
            <option>Antri</option>
        </select>
        <select id="pesanan-filter-layanan" class="bg-sg-bg border border-sg-border rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-sg-blue" onchange="searchPesanan()">
            <option>Semua Layanan</option>
            <option>Steam Biasa</option>
            <option>Snow Wash</option>
            <option>Detailing</option>
        </select>
        <input class="bg-sg-bg border border-sg-border rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-sg-blue" type="date" value="2025-02-20">
    </div>
    <div class="bg-white rounded-2xl border border-sg-border overflow-hidden shadow-sm overflow-x-auto">
        <table class="w-full">
            <thead class="bg-[#FAFBFD]">
                <tr>
                    <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Kode</th>
                    <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Tanggal</th>
                    <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Pelanggan</th>
                    <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Layanan</th>
                    <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Kendaraan</th>
                    <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Bayar</th>
                    <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Total</th>
                    <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Status</th>
                    <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody id="pesanan-tbody"></tbody>
        </table>
    </div>
</div>{{-- /pesanan --}}
