<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SteamGo — Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            sg: {
              blue:     '#1A6BFF', bluedk:   '#0D4FCC', bluelt:   '#EEF4FF',
              sky:      '#38B6FF', navy:     '#0A1628', navy2:    '#111E35', navy3:    '#1A2A45',
              green:    '#00C48C', greenlt:  '#E6FBF4', orange:   '#FF7A00', orangelt: '#FFF4E6',
              red:      '#FF4444', redlt:    '#FFE8E8', yellow:   '#FFB830', yellowlt: '#FFF8E6',
              bg:       '#F0F3FA', border:   '#E2E7F0', text:     '#0F172A', sub:      '#64748B',
            }
          },
          fontFamily: { sans: ['Poppins', 'sans-serif'], display: ['Poppins', 'serif'] },
          keyframes: {
            fadeIn: { from: { opacity: 0, transform: 'translateY(8px)' }, to: { opacity: 1, transform: 'translateY(0)' } },
            typing: { '0%,60%,100%': { transform: 'translateY(0)' }, '30%': { transform: 'translateY(-5px)' } },
          },
          animation: { fadeIn: 'fadeIn .2s ease', typing: 'typing 1.2s infinite' }
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
      @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
      .typing-dot { animation: typing 1.2s infinite; }
      .typing-dot:nth-child(2) { animation-delay: .2s; }
      .typing-dot:nth-child(3) { animation-delay: .4s; }
      @keyframes typing { 0%,60%,100% { transform: translateY(0); } 30% { transform: translateY(-5px); } }
      .bar { border-radius: 6px 6px 0 0; transition: all .3s; cursor: pointer; }
      .bar:hover { filter: brightness(1.12); }
      .donut { width: 110px; height: 110px; border-radius: 50%; flex-shrink: 0; background: conic-gradient(#1A6BFF 0% 45%, #38B6FF 45% 72%, #00C48C 72% 85%, #FF7A00 85% 100%); display: flex; align-items: center; justify-content: center; position: relative; }
      .donut::after { content:''; position: absolute; width: 68px; height: 68px; border-radius: 50%; background: #fff; }
      .donut-center { position: absolute; z-index: 1; text-align: center; }
      .chat-contact { display:flex; align-items:flex-start; gap:10px; padding:12px 16px; cursor:pointer; border-bottom:1px solid var(--sg-border,#E2E7F0); transition:background .15s; }
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
      }
    </style>
</head>
<body class="bg-sg-bg text-sg-text">

    <div id="sidebar-overlay" class="hidden fixed inset-0 bg-black/50 z-[1035] transition-opacity" onclick="closeSidebar()"></div>

    @include('components.sidebar')

    <div id="main-content" class="ml-60 min-h-screen flex flex-col">
        @include('components.topbar')

        <div class="p-7 flex-1">
            @yield('content')
        </div>
    </div>

    @include('components.modals')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/crud.js') }}"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
    
    <script>
    // =====================================
    // FUNGSI UNTUK TOGGLE SIDEBAR DI MOBILE
    // =====================================
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        // Tambahkan / Hapus class 'open' yang akan men-trigger animasi CSS translateX(0)
        sidebar.classList.toggle('open');
        
        // Tampilkan / Sembunyikan latar belakang hitam (overlay) dan kunci scroll
        if (sidebar.classList.contains('open')) {
            overlay.classList.remove('hidden');
            // Mencegah halaman utama bisa di-scroll
            document.body.classList.add('overflow-hidden');
        } else {
            overlay.classList.add('hidden');
            // Mengembalikan fungsi scroll halaman utama
            document.body.classList.remove('overflow-hidden');
        }
    }

    // Fungsi khusus untuk menutup saat area gelap di luar menu (overlay) di klik
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebar-overlay').classList.add('hidden');
        // Mengembalikan fungsi scroll halaman utama
        document.body.classList.remove('overflow-hidden');
    }

    // =====================================
    // FUNGSI MODAL DAN TOAST
    // =====================================
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
      t.style.opacity = '1';
      setTimeout(() => { 
        t.style.opacity = '0'; 
        setTimeout(() => t.classList.add('hidden'), 300); 
      }, 2800);
    }
    
    function toastMsg(msg) { 
      showToast(msg); 
    }
    </script>
</body>
</html>