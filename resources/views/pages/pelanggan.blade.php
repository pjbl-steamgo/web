<div class="page {{ ($initPage ?? '') === 'pelanggan' ? 'active' : 'hidden' }}" id="page-pelanggan">
  
  <div class="mb-6">
    <h2 class="text-xl font-display font-bold text-sg-text">Manajemen Akun Pelanggan</h2>
    <p class="text-sm text-sg-sub mt-1">Daftar pelanggan terdaftar dan tingkatan member pelanggan.</p>
  </div>

  @if(session('success'))
    <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2 shadow-sm">
      <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    </div>
  @endif

  <div class="bg-white border border-sg-border rounded-2xl shadow-sm p-4 sm:p-5 flex flex-col">
    <h3 class="text-sm font-bold text-sg-text uppercase tracking-wider mb-4 pb-2 border-b border-sg-border flex items-center gap-2">
      <i class="bi bi-people text-base text-sg-blue"></i> Data Pelanggan
    </h3>

    <div class="hidden lg:block overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="text-[11px] font-bold text-sg-sub uppercase tracking-wider border-b border-sg-border bg-[#FAFBFD]">
            <th class="px-4 py-3">User</th>
            <th class="px-4 py-3">Kontak & Email</th>
            <th class="px-4 py-3 text-center">Total Order</th>
            <th class="px-4 py-3 text-right">Tier Member</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-sg-border">
          @forelse ($pelanggans ?? [] as $pelanggan)
            @php
              $totalPesanan = $pelanggan->jumlah_pesanan ?? 0;
              $tier = $totalPesanan >= 40 ? 'Diamond' : ($totalPesanan >= 10 ? 'Gold' : 'Silver');
              $badgeStyle = $totalPesanan >= 40 ? 'bg-cyan-50 text-cyan-600 border-cyan-200' : ($totalPesanan >= 10 ? 'bg-amber-50 text-amber-600 border-amber-200' : 'bg-slate-100 text-slate-600 border-slate-200');
              // Fallback ID untuk memastikan tidak muncul N/A
              $displayId = $pelanggan->id_user ?? $pelanggan->_id ?? $pelanggan->id ?? 'ID Kosong';
            @endphp
            <tr class="hover:bg-gray-50 transition-colors text-sm">
              <td class="px-4 py-4">
                <div class="font-bold text-sg-text">{{ $pelanggan->username }}</div>
                <div class="text-[11px] font-mono text-sg-sub mt-0.5">{{ $displayId }}</div>
              </td>
              <td class="px-4 py-4">
                <div class="text-sg-text font-medium">{{ $pelanggan->no_hp }}</div>
                <div class="text-[12px] text-sg-sub mt-0.5">{{ $pelanggan->email }}</div>
              </td>
              <td class="px-4 py-4 text-center font-bold text-sg-text">{{ $totalPesanan }} kali</td>
              <td class="px-4 py-4 text-right">
                <span class="inline-flex px-2.5 py-1 rounded-full text-[11px] font-black uppercase border tracking-wider {{ $badgeStyle }}">
                  <i class="bi bi-gem mr-1"></i> {{ $tier }}
                </span>
              </td>
            </tr>
          @empty
            <tr><td colspan="4" class="px-4 py-10 text-center text-sg-sub text-xs">Belum ada data.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="block lg:hidden divide-y divide-sg-border">
        @forelse ($pelanggans ?? [] as $pelanggan)
            @php
              $totalPesanan = $pelanggan->jumlah_pesanan ?? 0;
              $tier = $totalPesanan >= 40 ? 'Diamond' : ($totalPesanan >= 10 ? 'Gold' : 'Silver');
              $badgeStyle = $totalPesanan >= 40 ? 'bg-cyan-50 text-cyan-600 border-cyan-200' : ($totalPesanan >= 10 ? 'bg-amber-50 text-amber-600 border-amber-200' : 'bg-slate-100 text-slate-600 border-slate-200');
              $displayId = $pelanggan->id_user ?? $pelanggan->_id ?? $pelanggan->id ?? 'ID Kosong';
            @endphp
            <div class="py-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <div class="font-bold text-[14px] text-sg-text">{{ $pelanggan->username }}</div>
                        <div class="text-[11px] font-mono text-sg-sub">{{ $displayId }}</div>
                    </div>
                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold uppercase border {{ $badgeStyle }}">
                         {{ $tier }}
                    </span>
                </div>
                <div class="flex justify-between text-[12px] text-sg-sub">
                    <div>{{ $pelanggan->no_hp }}</div>
                    <div class="font-bold text-sg-text">{{ $totalPesanan }} Order</div>
                </div>
            </div>
        @empty
            <div class="py-10 text-center text-sg-sub text-xs">Belum ada data pelanggan.</div>
        @endforelse
    </div>
  </div>
</div>