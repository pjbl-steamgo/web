<nav id="sidebar" class="w-64 h-screen bg-sg-navy fixed top-0 left-0 z-[1040] flex flex-col">
  
  <div class="px-5 py-6 border-b border-white/[0.07] flex-shrink-0">
    <div class="font-display text-[22px] font-black text-white">Steam<span class="text-sg-sky">Go</span></div>
    <div class="text-[10px] text-white/35 uppercase tracking-[0.6px] font-semibold mt-0.5">Admin Panel</div>
  </div>

  <div class="flex-1 overflow-y-auto pb-4 custom-scrollbar">
    
    {{-- MENU UTAMA --}}
    <div class="px-3 pt-4 pb-1">
      <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Utama</div>
      
      <a href="{{ url('/dashboard') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-medium transition-all mb-0.5 {{ request()->is('dashboard*') ? 'bg-sg-blue text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white' }}">
        <i class="bi bi-grid-1x2-fill w-5 text-center text-base flex-shrink-0"></i> Dashboard
      </a>
      
      <a href="{{ url('/antrian-jadwal') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-medium transition-all mb-0.5 {{ request()->is('antrian-jadwal*') ? 'bg-sg-blue text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white' }}">
        <i class="bi bi-list-ol w-5 text-center text-base flex-shrink-0"></i> Antrian & Jadwal
        @php $countAntrian = \App\Models\Pesanan::whereIn('status', ['Antri', 'Proses'])->count(); @endphp
        @if($countAntrian > 0)
          <span class="ml-auto bg-sg-red text-white text-[10px] font-bold px-1.5 py-px rounded-full">{{ $countAntrian }}</span>
        @endif
      </a>
      
      <a href="{{ url('/pesanan') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-medium transition-all mb-0.5 {{ request()->is('pesanan*') ? 'bg-sg-blue text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white' }}">
        <i class="bi bi-clipboard2-check w-5 text-center text-base flex-shrink-0"></i> Kelola Pesanan
      </a>

      <a href="{{ url('/konfirmasi-booking') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-medium transition-all mb-0.5 {{ request()->is('konfirmasi-booking*') ? 'bg-sg-blue text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white' }}">
        <i class="bi bi-calendar-check w-5 text-center text-base flex-shrink-0"></i> Kelola Booking
      </a>

      <a href="{{ url('/konfirmasi-pembayaran') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-medium transition-all mb-0.5 {{ request()->is('konfirmasi-pembayaran*') ? 'bg-sg-blue text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white' }}">
        <i class="bi bi-wallet2 w-5 text-center text-base flex-shrink-0"></i> Kelola Pembayaran
      </a>
    </div>

    {{-- MENU DATA --}}
    <div class="px-3 pt-4 pb-1">
      <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Data</div>
      
      <a href="{{ url('/layanan') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-medium transition-all mb-0.5 {{ request()->is('layanan*') ? 'bg-sg-blue text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white' }}">
        <i class="bi bi-droplet-half w-5 text-center text-base flex-shrink-0"></i> Layanan & Harga
      </a>
      
      <a href="{{ url('/pelanggan') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-medium transition-all mb-0.5 {{ request()->is('pelanggan*') ? 'bg-sg-blue text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white' }}">
        <i class="bi bi-people w-5 text-center text-base flex-shrink-0"></i> Data Pelanggan
      </a>
    </div>

    {{-- MENU KEUANGAN --}}
    <div class="px-3 pt-4 pb-1">
      <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Keuangan</div>
      <a href="{{ url('/laporan') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-medium transition-all mb-0.5 {{ request()->is('laporan*') ? 'bg-sg-blue text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white' }}">
        <i class="bi bi-bar-chart-line w-5 text-center text-base flex-shrink-0"></i> Laporan Pendapatan
      </a>
    </div>

    {{-- MENU KOMUNIKASI --}}
    <div class="px-3 pt-4 pb-1">
      <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Komunikasi</div>
      <a href="{{ url('/chat') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-medium transition-all mb-0.5 {{ request()->is('chat*') ? 'bg-sg-blue text-white' : 'text-white/55 hover:bg-white/[0.07] hover:text-white' }}">
        <i class="bi bi-chat-dots w-5 text-center text-base flex-shrink-0"></i> Chat
      </a>
    </div>
  </div> 
  
  {{-- FOOTER USER (DIPERBARUI) --}}
  <div class="mt-auto px-4 py-3.5 border-t border-white/[0.07] flex items-center gap-3 flex-shrink-0 bg-sg-navy">
    
    <img src="{{ asset('images/admin-avatar.png') }}" 
         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username ?? 'Admin') }}&background=38B6FF&color=fff'" 
         alt="Profil Admin" 
         class="w-9 h-9 rounded-full object-cover border border-white/20 shadow-sm flex-shrink-0 bg-white/5">
    
    <div class="text-[14px] font-semibold text-white flex-1 truncate capitalize">
      {{ Auth::user()->username ?? 'Admin' }}
    </div>
    
    <button type="button" onclick="toggleLogoutModal()" class="bg-transparent border-none p-0 focus:outline-none ml-auto" title="Keluar">
        <i class="bi bi-box-arrow-right text-white/30 hover:text-sg-red cursor-pointer text-lg transition-colors"></i>
    </button>
  </div>
</nav>

<div id="logoutModal" class="fixed inset-0 z-[2000] hidden">
    <div class="absolute inset-0 bg-sg-navy/60 backdrop-blur-sm transition-opacity" onclick="toggleLogoutModal()"></div>
    
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="relative bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-sm w-full p-6">
            
            <div class="flex justify-center mb-5">
                <div class="w-14 h-14 rounded-full bg-red-50 flex items-center justify-center border border-red-100">
                    <i class="bi bi-box-arrow-right text-2xl text-sg-red"></i>
                </div>
            </div>
            
            <div class="text-center mb-7">
                <h3 class="text-[17px] font-bold text-sg-text font-display mb-1.5">Konfirmasi Keluar</h3>
                <p class="text-[13px] text-sg-sub">Apakah Anda yakin ingin keluar dari Admin Panel SteamGo?</p>
            </div>
            
            <div class="flex gap-3">
                <button type="button" onclick="toggleLogoutModal()" class="flex-1 px-4 py-2.5 rounded-xl text-[13px] font-bold text-sg-sub bg-gray-100 hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                
                <form action="{{ url('/logout') }}" method="POST" class="flex-1 m-0">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2.5 rounded-xl text-[13px] font-bold text-white bg-sg-red hover:bg-red-600 transition-colors shadow-sm shadow-red-500/30">
                        Ya, Keluar
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function toggleLogoutModal() {
        const modal = document.getElementById('logoutModal');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }
</script>