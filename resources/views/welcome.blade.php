<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>SteamGo — Admin Dashboard</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        sg: {
          blue:     '#1A6BFF',
          bluedk:   '#0D4FCC',
          bluelt:   '#EEF4FF',
          sky:      '#38B6FF',
          navy:     '#0A1628',
          navy2:    '#111E35',
          navy3:    '#1A2A45',
          green:    '#00C48C',
          greenlt:  '#E6FBF4',
          orange:   '#FF7A00',
          orangelt: '#FFF4E6',
          red:      '#FF4444',
          redlt:    '#FFE8E8',
          yellow:   '#FFB830',
          yellowlt: '#FFF8E6',
          bg:       '#F0F3FA',
          border:   '#E2E7F0',
          text:     '#0F172A',
          sub:      '#64748B',
        }
      },
      fontFamily: {
        sans: ['Poppins', 'sans-serif'],
        display: ['Poppins', 'serif'],
      },
      keyframes: {
        fadeIn: { from: { opacity: 0, transform: 'translateY(8px)' }, to: { opacity: 1, transform: 'translateY(0)' } },
        typing: { '0%,60%,100%': { transform: 'translateY(0)' }, '30%': { transform: 'translateY(-5px)' } },
      },
      animation: {
        fadeIn: 'fadeIn .2s ease',
        typing: 'typing 1.2s infinite',
      }
    }
  }
}
</script>

<style>
  body { font-family: 'Poppins', sans-serif; letter-spacing: -0.01em; }
  .font-display { font-family: 'Poppins', sans-serif; }
  .stat-number { font-family: 'Poppins', sans-serif; font-size: 30px; font-weight: 700; line-height: 1; letter-spacing: -0.01em; color: #0F172A; margin-top: 8px; display: block; }
  .stat-number-lg { font-family: 'Poppins', sans-serif; font-size: 38px; font-weight: 700; line-height: 1; letter-spacing: -0.01em; color: #fff; margin-top: 6px; display: block; }
  #sidebar { transition: transform .3s ease; }
  #sidebar::-webkit-scrollbar { display: none; }
  ::-webkit-scrollbar { width: 5px; height: 5px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: #E2E7F0; border-radius: 10px; }
  .page { display: none; }
  .page.active { display: block; animation: fadeIn .2s ease; }
  .typing-dot { animation: typing 1.2s infinite; }
  .typing-dot:nth-child(2) { animation-delay: .2s; }
  .typing-dot:nth-child(3) { animation-delay: .4s; }
  .bar { border-radius: 6px 6px 0 0; transition: all .3s; cursor: pointer; }
  .bar:hover { filter: brightness(1.12); }
  .donut { width: 110px; height: 110px; border-radius: 50%; flex-shrink: 0; background: conic-gradient(#1A6BFF 0% 45%, #38B6FF 45% 72%, #00C48C 72% 85%, #FF7A00 85% 100%); display: flex; align-items: center; justify-content: center; position: relative; }
  .donut::after { content:''; position: absolute; width: 68px; height: 68px; border-radius: 50%; background: #fff; }
  .donut-center { position: absolute; z-index: 1; text-align: center; }
  .chat-contact { display:flex; align-items:flex-start; gap:10px; padding:12px 16px; cursor:pointer; border-bottom:1px solid #E2E7F0; transition:background .15s; }
  .chat-contact:hover, .chat-contact.active { background:#F0F4FF; }
  .cc-avatar { width:40px; height:40px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:16px; color:#fff; flex-shrink:0; }
  .cc-info { flex:1; min-width:0; }
  .cc-name { font-size:14px; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
  .cc-preview { font-size:12px; color:#64748B; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-top:2px; max-width:160px; }
  .cc-time { font-size:11px; color:#64748B; white-space:nowrap; }
  .cc-unread { background:#FF4444; color:#fff; font-size:10px; font-weight:700; border-radius:99px; min-width:18px; height:18px; display:flex; align-items:center; justify-content:center; padding:0 5px; }
  .msg-row { display:flex; align-items:flex-end; gap:8px; margin-bottom:8px; }
  .msg-row.admin { flex-direction:row-reverse; }
  .msg-avatar { width:28px; height:28px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:12px; color:#fff; flex-shrink:0; }
  .msg-bubble { background:#fff; border:1px solid #E2E7F0; border-radius:16px 16px 16px 4px; padding:8px 12px; font-size:13.5px; max-width:420px; box-shadow:0 1px 3px rgba(0,0,0,.05); }
  .msg-row.admin .msg-bubble { background:#1A6BFF; color:#fff; border:none; border-radius:16px 16px 4px 16px; }
  .msg-time { font-size:10px; color:#94A3B8; margin-top:3px; text-align:right; }
  .msg-row.admin .msg-time { text-align:left; }
  .msg-date-divider { text-align:center; margin:12px 0; }
  .msg-date-divider span { background:#E2E7F0; color:#64748B; font-size:11px; font-weight:600; padding:3px 12px; border-radius:99px; }
  .typing-indicator { display:flex; gap:4px; padding:10px 14px; background:#fff; border:1px solid #E2E7F0; border-radius:16px; }
  .typing-dot { width:7px; height:7px; border-radius:50%; background:#94A3B8; }
  .chat-textarea { resize: none; max-height: 90px; }
  .chat-textarea:focus { outline: none; }
  @media (max-width: 991px) {
    #sidebar { transform: translateX(-100%); }
    #sidebar.open { transform: translateX(0); }
    #main-content { margin-left: 0 !important; }
    #hamburger { display: flex !important; }
    #sidebar-overlay.show { display: block; }
  }
</style>
</head>
<body class="bg-sg-bg text-sg-text">

<div id="sidebar-overlay" class="hidden fixed inset-0 bg-black/50 z-[1035]" onclick="closeSidebar()"></div>

<nav id="sidebar" class="w-60 min-h-screen bg-sg-navy fixed top-0 left-0 z-[1040] flex flex-col overflow-y-auto">
  <div class="px-5 py-6 border-b border-white/[0.07]">
    <div class="font-display text-[22px] font-black text-white">Steam<span class="text-sg-sky">Go</span></div>
    <div class="text-[10px] text-white/35 uppercase tracking-[0.6px] font-semibold mt-0.5">Admin Panel</div>
  </div>

  <div class="px-3 pt-4 pb-1">
    <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Utama</div>
    <a class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium text-white/55 hover:bg-white/[0.07] hover:text-white/85 transition-all mb-0.5 bg-sg-blue text-white font-semibold" onclick="showPage('dashboard',this)">
      <i class="bi bi-grid-1x2-fill w-5 text-center text-base flex-shrink-0"></i> Dashboard
    </a>
    <a class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium text-white/55 hover:bg-white/[0.07] hover:text-white/85 transition-all mb-0.5" onclick="showPage('antrian',this)">
      <i class="bi bi-list-ol w-5 text-center text-base flex-shrink-0"></i> Antrian & Jadwal
      <span class="ml-auto bg-sg-red text-white text-[10px] font-bold px-1.5 py-px rounded-full">5</span>
    </a>
    <a class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium text-white/55 hover:bg-white/[0.07] hover:text-white/85 transition-all mb-0.5" onclick="showPage('pesanan',this)">
      <i class="bi bi-clipboard2-check w-5 text-center text-base flex-shrink-0"></i> Kelola Pesanan
    </a>
  </div>

  <div class="px-3 pt-4 pb-1">
    <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Data</div>
    <a class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium text-white/55 hover:bg-white/[0.07] hover:text-white/85 transition-all mb-0.5" onclick="showPage('layanan',this)">
      <i class="bi bi-droplet-half w-5 text-center text-base flex-shrink-0"></i> Layanan & Harga
    </a>
    <a class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium text-white/55 hover:bg-white/[0.07] hover:text-white/85 transition-all mb-0.5" onclick="showPage('pelanggan',this)">
      <i class="bi bi-people w-5 text-center text-base flex-shrink-0"></i> Data Pelanggan
    </a>
  </div>

  <div class="px-3 pt-4 pb-1">
    <div class="text-[10px] font-bold text-white/30 uppercase tracking-widest px-2 mb-1">Komunikasi</div>
    <a class="sb-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl cursor-pointer text-sm font-medium text-white/55 hover:bg-white/[0.07] hover:text-white/85 transition-all mb-0.5" onclick="showPage('chat',this)" id="sb-chat">
      <i class="bi bi-chat-dots w-5 text-center text-base flex-shrink-0"></i> Pesan Pelanggan
      <span class="ml-auto bg-sg-red text-white text-[10px] font-bold px-1.5 py-px rounded-full" id="chat-badge">0</span>
    </a>
  </div>

  <div class="mt-auto px-4 py-3.5 border-t border-white/[0.07] flex items-center gap-2.5">
    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-sg-blue to-sg-sky flex items-center justify-center text-lg flex-shrink-0">👤</div>
    <div>
      <div class="text-[13px] font-semibold text-white">Admin {{ Auth::user()->name ?? 'SteamGo' }}</div>
      <div class="text-[11px] text-white/40">Pemilik Usaha</div>
    </div>
  </div>
</nav>

<div id="main-content" class="ml-60 min-h-screen flex flex-col">

  <div class="bg-white border-b border-sg-border px-7 h-[62px] flex items-center gap-3 sticky top-0 z-[1030]">
    <button id="hamburger" class="hidden p-0 mr-2 bg-transparent border-none" onclick="toggleSidebar()">
      <i class="bi bi-list text-2xl text-sg-text"></i>
    </button>
    <div>
      <span class="font-display text-[17px] font-bold" id="topbar-title">Dashboard</span>
      <span class="text-xs text-sg-sub ml-1" id="topbar-sub">Selamat datang, Admin!</span>
    </div>
    <div class="ml-auto flex items-center gap-2">
      <div class="hidden lg:block text-[13px] text-sg-sub font-medium" id="tb-date"></div>
    </div>
  </div>

  <div class="p-7 flex-1">
    <div class="page active" id="page-dashboard">
      <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 mb-4">
        <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm">
          <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pendapatan Hari Ini</div>
          <span class="stat-number" id="dash-income">Rp 0</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm">
          <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Pesanan Selesai</div>
          <span class="stat-number" id="dash-orders">0</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm">
          <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Antrian Aktif</div>
          <span class="stat-number" id="dash-queue">0</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-sg-border shadow-sm">
          <div class="text-[11px] font-bold text-sg-sub uppercase tracking-wide">Total Pelanggan</div>
          <span class="stat-number" id="dash-customers">0</span>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 mb-4">
        <div class="lg:col-span-2">
          <div class="flex items-center justify-between mb-2">
            <span class="font-display font-bold text-[15px]">Pesanan Terbaru</span>
          </div>
          <div class="bg-white rounded-2xl border border-sg-border overflow-hidden shadow-sm">
             <table class="w-full text-left border-collapse">
                <thead class="bg-[#FAFBFD]">
                  <tr>
                    <th class="px-4 py-3 text-[11px] font-bold text-sg-sub border-b">Kode</th>
                    <th class="px-4 py-3 text-[11px] font-bold text-sg-sub border-b">Pelanggan</th>
                    <th class="px-4 py-3 text-[11px] font-bold text-sg-sub border-b">Status</th>
                  </tr>
                </thead>
                <tbody id="dash-recent-orders"></tbody>
             </table>
          </div>
        </div>
      </div>
    </div>

    <div class="page" id="page-layanan">
      <div class="flex justify-end mb-4">
        <button class="bg-sg-blue text-white font-semibold rounded-xl px-4 py-2 text-sm" onclick="openModal('modal-tambah-layanan')">
          <i class="bi bi-plus-lg mr-1"></i> Tambah Layanan
        </button>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3" id="layanan-grid"></div>
    </div>

    <div class="page" id="page-pelanggan">
      <div class="bg-white rounded-2xl border border-sg-border overflow-hidden shadow-sm overflow-x-auto">
        <table class="w-full text-left">
          <thead class="bg-[#FAFBFD]">
            <tr>
              <th class="px-4 py-3 text-[11px] font-bold text-sg-sub border-b">Nama</th>
              <th class="px-4 py-3 text-[11px] font-bold text-sg-sub border-b">HP</th>
              <th class="px-4 py-3 text-[11px] font-bold text-sg-sub border-b">Member</th>
              <th class="px-4 py-3 text-[11px] font-bold text-sg-sub border-b">Aksi</th>
            </tr>
          </thead>
          <tbody id="pelanggan-tbody"></tbody>
        </table>
      </div>
    </div>

    <div class="page" id="page-chat">
        <div class="bg-white rounded-2xl border border-sg-border shadow-sm grid grid-cols-1 lg:grid-cols-[300px_1fr]" style="height:70vh">
            <div class="border-r border-sg-border flex flex-col overflow-hidden">
                <div class="p-4 border-b font-bold text-sm">Pesan Masuk</div>
                <div class="flex-1 overflow-y-auto" id="chat-contacts"></div>
            </div>
            <div class="flex flex-col overflow-hidden" id="chat-window">
                <div class="flex-1 overflow-y-auto p-4 flex flex-col gap-2 bg-[#F7F9FD]" id="chat-msgs"></div>
                <div class="p-3 border-t bg-white flex gap-2">
                    <textarea id="chat-textarea" class="flex-1 bg-sg-bg border-none rounded-xl p-2 text-sm" placeholder="Balas pesan..."></textarea>
                    <button class="bg-sg-blue text-white rounded-xl px-4" onclick="sendMsg()">Kirim</button>
                </div>
            </div>
        </div>
    </div>

  </div>
</div>

<div id="modal-backdrop" class="hidden fixed inset-0 bg-black/50 z-[2000]" onclick="closeModal()"></div>
<div id="modal-tambah-layanan" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl">
  <div class="flex items-center justify-between px-6 py-4 border-b"><h5 class="font-bold">Tambah Layanan</h5><button onclick="closeModal()">✕</button></div>
  <div class="p-6 grid grid-cols-2 gap-3">
    <div class="col-span-2"><label class="text-[11px] font-bold text-sg-sub">Nama Layanan</label><input id="new-layanan-nama" class="w-full bg-sg-bg rounded-xl px-3 py-2 text-sm border-none"></div>
    <div><label class="text-[11px] font-bold text-sg-sub">Harga</label><input id="new-layanan-harga" type="number" class="w-full bg-sg-bg rounded-xl px-3 py-2 text-sm border-none"></div>
  </div>
  <div class="p-4 border-t flex gap-2 justify-end">
    <button class="text-sm font-semibold" onclick="closeModal()">Batal</button>
    <button class="bg-sg-blue text-white px-4 py-2 rounded-xl text-sm" onclick="saveTambahLayanan()">Simpan</button>
  </div>
</div>

<div id="sg-toast" class="fixed bottom-5 right-5 z-[3000] bg-sg-navy text-white px-4 py-3 rounded-xl font-semibold text-sm shadow-xl hidden">
  <span id="toast-msg">Berhasil!</span>
</div>

<script>
    // Data dari Laravel dikirim ke global variable JavaScript
    // sehingga file crud.js dan chat.js Anda tetap bisa membacanya.
    window.layananData = @json($layanan);
    window.pelangganData = @json($pelanggan);
    window.antrianData = @json($antrian);
    window.pesananData = @json($pesanan);

    // Fungsi dasar untuk Modal & Toast
    function openModal(id) {
        document.getElementById('modal-backdrop').classList.remove('hidden');
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('modal-backdrop').classList.add('hidden');
        document.querySelectorAll('.modal-panel').forEach(m => m.classList.add('hidden'));
    }
    function showToast(msg) {
        const t = document.getElementById('sg-toast');
        document.getElementById('toast-msg').textContent = msg;
        t.classList.remove('hidden');
        setTimeout(() => t.classList.add('hidden'), 3000);
    }
</script>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/crud.js') }}"></script>
<script src="{{ asset('js/chat.js') }}"></script>

</body>
</html>