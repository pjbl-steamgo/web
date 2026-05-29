<div class="bg-white border-b border-sg-border px-7 h-[62px] flex items-center gap-3 sticky top-0 z-[1030]">
  <button id="hamburger" class="hidden p-0 mr-2 bg-transparent border-none" onclick="toggleSidebar()">
    <i class="bi bi-list text-2xl text-sg-text"></i>
  </button>
  
  <div>
    <span class="font-display text-[17px] font-bold" id="topbar-title">
      @if(($initPage ?? 'dashboard') === 'antrian')
        Antrian & Jadwal
      @elseif(($initPage ?? '') === 'pesanan')
        Kelola Pesanan
      @elseif(($initPage ?? '') === 'layanan')
        Layanan & Harga
      @elseif(($initPage ?? '') === 'pelanggan')
        Data Pelanggan
      @elseif(($initPage ?? '') === 'laporan')
        Laporan Pendapatan
      @elseif(($initPage ?? '') === 'chat')
        Pesan Pelanggan
      @elseif(($initPage ?? '') === 'pengaturan')
        Pengaturan Usaha
      @else
        Dashboard
      @endif
    </span>
    <span class="text-xs text-sg-sub ml-1" id="topbar-sub">Selamat datang, Admin!</span>
  </div>
  
  <div class="ml-auto flex items-center gap-2">
    <div class="hidden md:flex items-center gap-2 bg-sg-bg border border-sg-border rounded-xl px-3.5 py-2 text-[13px] text-sg-sub cursor-pointer hover:border-sg-blue transition-colors" onclick="openTopbarSearch()">
      <i class="bi bi-search"></i> Cari pesanan...
    </div>
    <div class="w-[38px] h-[38px] bg-sg-bg border border-sg-border rounded-xl flex items-center justify-center text-lg cursor-pointer relative">
      <i class="bi bi-bell"></i>
      <div class="absolute top-2 right-2 w-[7px] h-[7px] bg-sg-red rounded-full border-2 border-white"></div>
    </div>
    <div class="hidden lg:block text-[13px] text-sg-sub font-medium" id="tb-date"></div>
  </div>
</div>