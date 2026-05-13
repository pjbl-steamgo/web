<div class="page active" id="page-dashboard">

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 mb-4">
        <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm relative overflow-hidden">
            <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pendapatan Hari Ini</div>
            <span class="stat-number">Rp 1,24jt</span>
            <div class="text-xs font-semibold mt-2 text-sg-green"><i class="bi bi-arrow-up-short"></i> 18% dari kemarin</div>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm relative overflow-hidden">
            <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pesanan Selesai</div>
            <span class="stat-number">28</span>
            <div class="text-xs font-semibold mt-2 text-sg-green"><i class="bi bi-arrow-up-short"></i> 5 dari kemarin</div>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm relative overflow-hidden">
            <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Antrian Aktif</div>
            <span class="stat-number">5</span>
            <div class="text-xs font-semibold mt-2 text-sg-red">Estimasi 2 jam</div>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm relative overflow-hidden">
            <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pelanggan Baru</div>
            <span class="stat-number">12</span>
            <div class="text-xs font-semibold mt-2 text-sg-green"><i class="bi bi-arrow-up-short"></i> 3 hari ini</div>
        </div>
    </div>

    {{-- Pesanan Terbaru + Antrian --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 mb-4">
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-2">
                <span class="font-display font-bold text-[15px]">Pesanan Terbaru</span>
                <a class="text-xs font-semibold text-sg-blue cursor-pointer" onclick="showPage('pesanan',null)">Lihat semua →</a>
            </div>
            <div class="bg-white rounded-2xl border border-sg-border overflow-hidden shadow-sm">
                <table class="w-full">
                    <thead class="bg-[#FAFBFD]">
                        <tr>
                            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left">#</th>
                            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left">Pelanggan</th>
                            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left">Layanan</th>
                            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left">Kendaraan</th>
                            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left">Status</th>
                            <th class="text-[11px] font-bold text-sg-sub uppercase tracking-wide border-b border-sg-border px-4 py-3 text-left">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-[#FAFBFD]">
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border font-bold text-sg-sub">#007</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">Raditya H.</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">Snow Wash Motor</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">Honda Beat</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border"><span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-bluelt text-sg-blue">⟳ Proses</span></td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border font-bold">Rp 35.000</td>
                        </tr>
                        <tr class="hover:bg-[#FAFBFD]">
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border font-bold text-sg-sub">#006</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">Rizal M.</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">Detailing Mobil</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">Avanza</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border"><span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-greenlt text-sg-green">✓ Selesai</span></td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border font-bold">Rp 350.000</td>
                        </tr>
                        <tr class="hover:bg-[#FAFBFD]">
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border font-bold text-sg-sub">#005</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">Faza I.</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">Steam Biasa Motor</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">NMAX</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border"><span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-greenlt text-sg-green">✓ Selesai</span></td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border font-bold">Rp 25.000</td>
                        </tr>
                        <tr class="hover:bg-[#FAFBFD]">
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border font-bold text-sg-sub">#004</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">Rifal D.</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">Snow Wash Mobil</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border">HRV</td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border"><span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-orangelt text-sg-orange">◷ Antri</span></td>
                            <td class="px-4 py-3.5 text-[13.5px] border-b border-sg-border font-bold">Rp 85.000</td>
                        </tr>
                        <tr class="hover:bg-[#FAFBFD]">
                            <td class="px-4 py-3.5 text-[13.5px] font-bold text-sg-sub">#003</td>
                            <td class="px-4 py-3.5 text-[13.5px]">Budi S.</td>
                            <td class="px-4 py-3.5 text-[13.5px]">Detailing Motor</td>
                            <td class="px-4 py-3.5 text-[13.5px]">Vario 150</td>
                            <td class="px-4 py-3.5 text-[13.5px]"><span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-greenlt text-sg-green">✓ Selesai</span></td>
                            <td class="px-4 py-3.5 text-[13.5px] font-bold">Rp 120.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Antrian Sekarang --}}
        <div>
            <div class="flex items-center justify-between mb-2">
                <span class="font-display font-bold text-[15px]">Antrian Sekarang</span>
                <a class="text-xs font-semibold text-sg-blue cursor-pointer" onclick="showPage('antrian',null)">Kelola →</a>
            </div>
            <div class="bg-white rounded-2xl border border-sg-border shadow-sm">
                <div class="flex items-center gap-3 px-4 py-3 border-b border-sg-border">
                    <div class="w-[42px] h-[42px] rounded-xl bg-sg-blue text-white flex items-center justify-center font-display text-lg font-extrabold flex-shrink-0">05</div>
                    <div class="flex-grow"><div class="font-semibold text-sm">Raditya H. — Beat</div><div class="text-xs text-sg-sub">Snow Wash Motor</div></div>
                    <div class="text-right"><div class="text-xs text-sg-sub">10:12</div><div class="text-xs font-semibold text-sg-blue">Sedang proses</div></div>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 border-b border-sg-border">
                    <div class="w-[42px] h-[42px] rounded-xl bg-sg-bluelt text-sg-blue flex items-center justify-center font-display text-lg font-extrabold flex-shrink-0">06</div>
                    <div class="flex-grow"><div class="font-semibold text-sm">Rifal D. — HRV</div><div class="text-xs text-sg-sub">Snow Wash Mobil</div></div>
                    <div class="text-right"><div class="text-xs text-sg-sub">10:30</div><div class="text-xs font-semibold text-sg-orange">~25 menit</div></div>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 border-b border-sg-border">
                    <div class="w-[42px] h-[42px] rounded-xl bg-sg-bluelt text-sg-blue flex items-center justify-center font-display text-lg font-extrabold flex-shrink-0">07</div>
                    <div class="flex-grow"><div class="font-semibold text-sm">Sinta A. — Aerox</div><div class="text-xs text-sg-sub">Steam Biasa Motor</div></div>
                    <div class="text-right"><div class="text-xs text-sg-sub">11:00</div><div class="text-xs font-semibold text-sg-orange">~55 menit</div></div>
                </div>
                <div class="flex items-center gap-3 px-4 py-3">
                    <div class="w-[42px] h-[42px] rounded-xl bg-sg-bluelt text-sg-blue flex items-center justify-center font-display text-lg font-extrabold flex-shrink-0">08</div>
                    <div class="flex-grow"><div class="font-semibold text-sm">Doni K. — Innova</div><div class="text-xs text-sg-sub">Detailing Mobil</div></div>
                    <div class="text-right"><div class="text-xs text-sg-sub">13:00</div><div class="text-xs text-sg-sub">Terjadwal</div></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart + Donut --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-3">
        <div class="lg:col-span-3 bg-white rounded-2xl border border-sg-border shadow-sm">
            <div class="px-5 py-4 border-b border-sg-border flex items-center justify-between">
                <span class="font-display font-bold text-sm">Pendapatan 7 Hari Terakhir</span>
                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-bluelt text-sg-blue">Minggu ini</span>
            </div>
            <div class="p-5">
                <div class="flex items-end gap-1.5 h-36 mb-2">
                    <div class="flex-1 flex flex-col items-center gap-1"><div class="text-[10px] text-sg-sub font-semibold">820K</div><div class="bar w-full bg-sg-bluelt" style="height:68%;"></div><div class="text-[10px] text-sg-sub font-semibold">Sen</div></div>
                    <div class="flex-1 flex flex-col items-center gap-1"><div class="text-[10px] text-sg-sub font-semibold">950K</div><div class="bar w-full bg-sg-bluelt" style="height:79%;"></div><div class="text-[10px] text-sg-sub font-semibold">Sel</div></div>
                    <div class="flex-1 flex flex-col items-center gap-1"><div class="text-[10px] text-sg-sub font-semibold">680K</div><div class="bar w-full bg-sg-bluelt" style="height:56%;"></div><div class="text-[10px] text-sg-sub font-semibold">Rab</div></div>
                    <div class="flex-1 flex flex-col items-center gap-1"><div class="text-[10px] text-sg-sub font-semibold">1,1jt</div><div class="bar w-full bg-sg-bluelt" style="height:91%;"></div><div class="text-[10px] text-sg-sub font-semibold">Kam</div></div>
                    <div class="flex-1 flex flex-col items-center gap-1"><div class="text-[10px] text-sg-sub font-semibold">1,3jt</div><div class="bar w-full bg-sg-blue" style="height:100%;"></div><div class="text-[10px] text-sg-sub font-semibold">Jum</div></div>
                    <div class="flex-1 flex flex-col items-center gap-1"><div class="text-[10px] text-sg-sub font-semibold">1,5jt</div><div class="bar w-full bg-sg-blue" style="height:100%;"></div><div class="text-[10px] text-sg-sub font-semibold">Sab</div></div>
                    <div class="flex-1 flex flex-col items-center gap-1"><div class="text-[10px] font-semibold text-sg-blue">1,24jt</div><div class="bar w-full bg-sg-sky" style="height:85%;"></div><div class="text-[10px] font-bold text-sg-blue">Hari ini</div></div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2 bg-white rounded-2xl border border-sg-border shadow-sm">
            <div class="px-5 py-4 border-b border-sg-border"><span class="font-display font-bold text-sm">Distribusi Layanan</span></div>
            <div class="p-5 flex items-center gap-4">
                <div class="donut flex-shrink-0">
                    <div class="donut-center"><div class="font-display text-[18px] font-black">156</div><div class="text-[9px] text-sg-sub font-semibold">Pesanan</div></div>
                </div>
                <div class="flex-grow flex flex-col gap-2">
                    <div class="flex justify-between"><div class="flex items-center gap-2 text-xs text-sg-sub"><div class="w-2 h-2 rounded-sm bg-sg-blue flex-shrink-0"></div>Snow Wash</div><div class="font-bold text-xs">45%</div></div>
                    <div class="flex justify-between"><div class="flex items-center gap-2 text-xs text-sg-sub"><div class="w-2 h-2 rounded-sm bg-sg-sky flex-shrink-0"></div>Steam Biasa</div><div class="font-bold text-xs">27%</div></div>
                    <div class="flex justify-between"><div class="flex items-center gap-2 text-xs text-sg-sub"><div class="w-2 h-2 rounded-sm bg-sg-green flex-shrink-0"></div>Detailing</div><div class="font-bold text-xs">13%</div></div>
                    <div class="flex justify-between"><div class="flex items-center gap-2 text-xs text-sg-sub"><div class="w-2 h-2 rounded-sm bg-sg-orange flex-shrink-0"></div>Lainnya</div><div class="font-bold text-xs">15%</div></div>
                </div>
            </div>
        </div>
    </div>

</div>{{-- /dashboard --}}
