<div class="bg-white border-b border-sg-border px-7 h-[62px] flex items-center gap-3 sticky top-0 z-[1030]">
  <button id="hamburger" class="hidden p-0 mr-2 bg-transparent border-none" onclick="toggleSidebar()">
    <i class="bi bi-list text-2xl text-sg-text"></i>
  </button>
  
  <div>
    <span class="font-display text-[17px] font-bold" id="topbar-title">
      @if(($initPage ?? 'dashboard') === 'dashboard')
        Dashboard
      @elseif($initPage === 'antrian-jadwal')
        Antrian & Jadwal
      @elseif($initPage === 'pesanan')
        Kelola Pesanan
      @elseif($initPage === 'konfirmasi-booking')
        Kelola Booking
      @elseif($initPage === 'konfirmasi-pembayaran')
        Kelola Pembayaran
      @elseif($initPage === 'layanan')
        Layanan & Harga
      @elseif($initPage === 'pelanggan')
        Data Pelanggan
      @elseif($initPage === 'laporan')
        Laporan Pendapatan
      @elseif($initPage === 'chat')
        Pesan Pelanggan
      @elseif($initPage === 'pengaturan')
        Pengaturan Usaha
      @else
        Dashboard
      @endif
    </span>
    <span class="text-xs text-sg-sub ml-1" id="topbar-sub">
      @if(($initPage ?? 'dashboard') === 'dashboard')
        Selamat datang kembali, {{ Auth::user()->username ?? 'Admin' }}!
      @elseif($initPage === 'antrian-jadwal')
        Pantau dan kelola antrean kendaraan.
      @elseif($initPage === 'pesanan')
        Lihat semua riwayat pesanan masuk.
      @elseif($initPage === 'konfirmasi-booking')
        Setujui atau tolak booking dari pelanggan.
      @elseif($initPage === 'konfirmasi-pembayaran')
        Verifikasi bukti pembayaran pelanggan.
      @elseif($initPage === 'layanan')
        Atur paket layanan dan harga cuci.
      @elseif($initPage === 'pelanggan')
        Daftar akun dan tier member pelanggan.
      @elseif($initPage === 'laporan')
        Ringkasan pendapatan dan statistik usaha.
      @elseif($initPage === 'chat')
        Balas pesan dan pertanyaan pelanggan.
      @elseif($initPage === 'pengaturan')
        Konfigurasi informasi dan profil usaha.
      @else
        Selamat datang kembali, {{ Auth::user()->username ?? 'Admin' }}!
      @endif
    </span>
  </div>
  
  <div class="ml-auto flex items-center gap-2">
    <div class="hidden lg:block text-[13px] text-sg-sub font-medium" id="tb-date"></div>
  </div>
</div>