<nav id="sidebar" class="w-60 min-h-screen bg-sg-navy fixed top-0 left-0 z-[1040] flex flex-col overflow-y-auto">
  <div class="px-5 py-6 border-b border-white/[0.07]">
    <div class="font-display text-[22px] font-black text-white">Steam<span class="text-sg-sky">Go</span></div>
    <div class="text-[10px] text-white/35 uppercase tracking-[0.6px] font-semibold mt-0.5">Admin Panel</div>
  </div>

  <div class="px-3 pt-4 pb-1">
    <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Utama</div>
    
    <a href="{{ url('/dashboard') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium transition-all mb-0.5 {{ ($initPage ?? 'dashboard') === 'dashboard' ? 'bg-sg-blue text-white font-semibold' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/85' }}">
      <i class="bi bi-grid-1x2-fill w-5 text-center text-base flex-shrink-0"></i> Dashboard
    </a>
    
    <a href="{{ url('/antrian-jadwal') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium transition-all mb-0.5 {{ ($initPage ?? '') === 'antrian' ? 'bg-sg-blue text-white font-semibold' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/85' }}">
      <i class="bi bi-list-ol w-5 text-center text-base flex-shrink-0"></i> Antrian & Jadwal
      <span class="ml-auto bg-sg-red text-white text-[10px] font-bold px-1.5 py-px rounded-full">5</span>
    </a>
    
    <a href="{{ url('/pesanan') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium transition-all mb-0.5 {{ ($initPage ?? '') === 'pesanan' ? 'bg-sg-blue text-white font-semibold' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/85' }}">
      <i class="bi bi-clipboard2-check w-5 text-center text-base flex-shrink-0"></i> Kelola Pesanan
      <span class="ml-auto bg-sg-red text-white text-[10px] font-bold px-1.5 py-px rounded-full">3</span>
    </a>
  </div>

  <div class="px-3 pt-4 pb-1">
    <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Data</div>
    
    <a href="{{ url('/layanan') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium transition-all mb-0.5 {{ ($initPage ?? '') === 'layanan' ? 'bg-sg-blue text-white font-semibold' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/85' }}">
      <i class="bi bi-droplet-half w-5 text-center text-base flex-shrink-0"></i> Layanan & Harga
    </a>
    
    <a href="{{ url('/pelanggan') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium transition-all mb-0.5 {{ ($initPage ?? '') === 'pelanggan' ? 'bg-sg-blue text-white font-semibold' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/85' }}">
      <i class="bi bi-people w-5 text-center text-base flex-shrink-0"></i> Data Pelanggan
    </a>
  </div>

  <div class="px-3 pt-4 pb-1">
    <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Keuangan</div>
    <a href="{{ url('/laporan') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium transition-all mb-0.5 {{ ($initPage ?? '') === 'laporan' ? 'bg-sg-blue text-white font-semibold' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/85' }}">
      <i class="bi bi-bar-chart-line w-5 text-center text-base flex-shrink-0"></i> Laporan Pendapatan
    </a>
  </div>

  <div class="px-3 pt-4 pb-1">
    <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Komunikasi</div>
    <a href="{{ url('/chat') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium transition-all mb-0.5 {{ ($initPage ?? '') === 'chat' ? 'bg-sg-blue text-white font-semibold' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/85' }}" id="sb-chat">
      <i class="bi bi-chat-dots w-5 text-center text-base flex-shrink-0"></i> Pesan Pelanggan
      <span class="ml-auto bg-sg-red text-white text-[10px] font-bold px-1.5 py-px rounded-full" id="chat-badge">4</span>
    </a>
  </div>

  <div class="px-3 pt-4 pb-1">
    <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Sistem</div>
    <a href="{{ url('/pengaturan') }}" class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium transition-all mb-0.5 {{ ($initPage ?? '') === 'pengaturan' ? 'bg-sg-blue text-white font-semibold' : 'text-white/55 hover:bg-white/[0.07] hover:text-white/85' }}">
      <i class="bi bi-gear w-5 text-center text-base flex-shrink-0"></i> Pengaturan
    </a>
  </div>

  <div class="mt-auto px-4 py-3.5 border-t border-white/[0.07] flex items-center gap-2.5">
    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-sg-blue to-sg-sky flex items-center justify-center text-lg flex-shrink-0">👤</div>
    <div>
      <div class="text-[13px] font-semibold text-white">Admin SteamGo</div>
      <div class="text-[11px] text-white/40">Pemilik Usaha</div>
    </div>
    <i class="bi bi-box-arrow-right ml-auto text-white/30 hover:text-sg-red cursor-pointer text-lg transition-colors"></i>
  </div>
</nav>