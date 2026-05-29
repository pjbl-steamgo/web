<div class="page {{ ($initPage ?? '') === 'chat' ? 'active' : '' }}" id="page-chat">
  
  <style>
    /* Menyembunyikan scrollbar di menu balasan cepat agar rapi */
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
  </style>

  <div class="bg-white rounded-2xl border border-sg-border shadow-sm flex flex-col lg:flex-row overflow-hidden" style="height:calc(100vh - 100px); min-height:600px;">

    <div class="w-full lg:w-[320px] h-[40%] lg:h-full flex flex-col border-b lg:border-b-0 lg:border-r border-sg-border flex-shrink-0 bg-[#FAFBFD]">
      
      <div class="px-5 py-4 border-b border-sg-border flex items-center justify-between">
        <span class="font-display font-bold text-[15px]">💬 Pesan Masuk</span>
        <span class="inline-flex text-[11px] font-bold px-2.5 py-1 rounded-full bg-sg-bluelt text-sg-blue shadow-sm" id="unread-count">4 baru</span>
      </div>
      
      <div class="p-3 border-b border-sg-border bg-white">
        <div class="relative">
          <i class="bi bi-search absolute left-3.5 top-1/2 -translate-y-1/2 text-sg-sub text-sm"></i>
          <input type="text" class="w-full bg-sg-bg border border-sg-border rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" placeholder="Cari pelanggan..." id="chat-search" oninput="filterContacts(this.value)">
        </div>
      </div>
      
      <div class="flex-1 overflow-y-auto bg-white" id="chat-contacts">
        
        <div class="chat-contact" onclick="openChat(this, 'Raditya H.', '10:42', 'R', 'bg-sg-blue')">
          <div class="cc-avatar bg-sg-blue">R</div>
          <div class="cc-info">
            <div class="flex justify-between items-end mb-0.5">
              <div class="cc-name">Raditya H.</div>
              <div class="cc-time">10:42</div>
            </div>
            <div class="flex justify-between items-center">
              <div class="cc-preview font-semibold text-sg-text">Min, mau tanya estimasi antri...</div>
              <div class="cc-unread hidden">0</div>
            </div>
          </div>
        </div>

        <div class="chat-contact" onclick="openChat(this, 'Sinta A.', 'Kemarin', 'S', 'bg-sg-green')">
          <div class="cc-avatar bg-sg-green">S</div>
          <div class="cc-info">
            <div class="flex justify-between items-end mb-0.5">
              <div class="cc-name">Sinta A.</div>
              <div class="cc-time">Kemarin</div>
            </div>
            <div class="flex justify-between items-center">
              <div class="cc-preview">Terima kasih ya min, mobilku...</div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="flex-1 flex flex-col overflow-hidden relative bg-[#F7F9FD]" id="chat-window">

      <div class="absolute inset-0 flex flex-col items-center justify-center gap-3 text-sg-sub bg-white z-10" id="chat-empty">
        <div class="text-6xl opacity-20 mb-2">💬</div>
        <div class="text-[14px] font-medium px-6 text-center">Pilih percakapan dari daftar untuk mulai membalas</div>
      </div>

      <div class="px-4 md:px-5 py-3 md:py-4 border-b border-sg-border hidden items-center gap-3 bg-white shadow-sm z-20" id="cw-header">
        <div class="w-10 md:w-11 h-10 md:h-11 rounded-xl bg-sg-blue flex items-center justify-center text-lg font-bold text-white flex-shrink-0 shadow-sm" id="cw-avatar"></div>
        <div class="flex-grow min-w-0">
          <div class="font-bold text-[14px] md:text-[15px] truncate text-sg-text" id="cw-name"></div>
          <div class="text-[11px] md:text-xs font-semibold text-sg-green flex items-center gap-1 mt-0.5" id="cw-status">
             <span class="w-1.5 h-1.5 rounded-full bg-sg-green"></span> Online
          </div>
        </div>
        <div class="flex gap-2 flex-shrink-0">
          <button class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-3 py-2 text-xs hover:border-sg-blue hover:text-sg-blue transition-colors flex items-center gap-1.5 shadow-sm" onclick="openModal('modal-detail-pelanggan')" title="Profil Pelanggan">
            <i class="bi bi-person-lines-fill text-sm"></i> <span class="hidden md:inline">Profil</span>
          </button>
          <button class="bg-sg-greenlt text-sg-green border border-sg-green/20 font-bold rounded-xl px-3 py-2 text-xs hover:brightness-95 transition-all flex items-center gap-1.5 shadow-sm" onclick="markResolved()">
            <i class="bi bi-check-lg text-sm"></i> <span class="hidden md:inline">Selesai</span>
          </button>
        </div>
      </div>

      <div class="flex-1 overflow-y-auto p-4 md:p-6 flex-col gap-3 hidden z-20" id="chat-msgs">
        </div>

      <div id="chat-input-section" class="hidden flex-col bg-white border-t border-sg-border z-20">
        
        <div class="flex gap-2 p-3 pb-2 overflow-x-auto whitespace-nowrap hide-scrollbar border-b border-sg-border/50 bg-[#FAFBFD]">
          <button class="px-4 py-1.5 rounded-full text-[11px] font-bold bg-white text-sg-sub border border-sg-border hover:border-sg-blue hover:text-sg-blue transition-colors shadow-sm flex-shrink-0" onclick="quickReply('Baik kak, kami proses sekarang ya 😊')">Oke, diproses</button>
          <button class="px-4 py-1.5 rounded-full text-[11px] font-bold bg-white text-sg-sub border border-sg-border hover:border-sg-blue hover:text-sg-blue transition-colors shadow-sm flex-shrink-0" onclick="quickReply('Jadwal sudah kami ubah, terima kasih kak!')">Jadwal diubah</button>
          <button class="px-4 py-1.5 rounded-full text-[11px] font-bold bg-white text-sg-sub border border-sg-border hover:border-sg-blue hover:text-sg-blue transition-colors shadow-sm flex-shrink-0" onclick="quickReply('Mohon maaf atas ketidaknyamanannya, kak 🙏')">Minta maaf</button>
          <button class="px-4 py-1.5 rounded-full text-[11px] font-bold bg-white text-sg-sub border border-sg-border hover:border-sg-blue hover:text-sg-blue transition-colors shadow-sm flex-shrink-0" onclick="quickReply('Kendaraan kak sudah selesai dan siap diambil!')">Selesai siap ambil</button>
        </div>
        
        <div class="p-3 md:p-4 flex items-end gap-2 md:gap-3">
          <div class="flex-1 bg-[#F8FAFC] border border-sg-border rounded-xl px-3 md:px-4 py-2 flex items-end gap-2 focus-within:border-sg-blue focus-within:bg-white focus-within:ring-1 focus-within:ring-sg-blue transition-all shadow-inner">
            <textarea id="chat-textarea" class="chat-textarea flex-1 bg-transparent border-none text-[13px] md:text-sm text-sg-text placeholder-sg-sub py-1.5" placeholder="Ketik balasan untuk pelanggan..." rows="1"
              onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();sendMsg();}"
              oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px'"></textarea>
            <button class="text-[20px] cursor-pointer text-sg-sub hover:text-sg-blue transition-colors pb-1 mr-1" title="Lampirkan File">
              <i class="bi bi-paperclip"></i>
            </button>
          </div>
          
          <button class="w-12 md:w-auto h-12 md:h-auto md:px-6 md:py-3 bg-sg-blue text-white font-semibold rounded-xl flex items-center justify-center gap-2 hover:bg-sg-bluedk transition-all shadow-sm flex-shrink-0" onclick="sendMsg()" title="Kirim Pesan">
            <span class="hidden md:inline text-sm">Kirim</span>
            <i class="bi bi-send-fill text-sm md:text-base"></i>
          </button>
        </div>
      </div>

    </div>
  </div>

  <script>
    // ==========================================
    // LOGIKA INTERAKSI HALAMAN CHAT
    // ==========================================

    // 1. Fungsi untuk Membuka Chat saat kontak diklik
    function openChat(element, name, time, avatarText, avatarColor) {
      // Sembunyikan layar kosong, tampilkan area chat
      document.getElementById('chat-empty').classList.add('hidden');
      
      // Hapus hidden & tambahkan flex agar komponen tampil
      document.getElementById('cw-header').classList.remove('hidden');
      document.getElementById('cw-header').classList.add('flex');
      document.getElementById('chat-msgs').classList.remove('hidden');
      document.getElementById('chat-msgs').classList.add('flex');
      document.getElementById('chat-input-section').classList.remove('hidden');
      document.getElementById('chat-input-section').classList.add('flex');

      // Update Header Chat
      document.getElementById('cw-name').textContent = name;
      let avatarEl = document.getElementById('cw-avatar');
      avatarEl.textContent = avatarText;
      // Mengganti warna background avatar header sesuai kontak
      avatarEl.className = `w-10 md:w-11 h-10 md:h-11 rounded-xl flex items-center justify-center text-lg font-bold text-white flex-shrink-0 shadow-sm ${avatarColor}`;

      // Hapus status 'active' dari semua kontak, lalu tambahkan ke kontak yg diklik
      document.querySelectorAll('.chat-contact').forEach(el => el.classList.remove('active'));
      element.classList.add('active');

      // Hilangkan badge merah (unread) jika ada
      let unreadBadge = element.querySelector('.cc-unread');
      if(unreadBadge) unreadBadge.classList.add('hidden');

      // Isi riwayat chat (Bisa disesuaikan nanti dengan data dari database)
      const chatMsgs = document.getElementById('chat-msgs');
      chatMsgs.innerHTML = `
        <div class="msg-date-divider"><span>Hari ini</span></div>
        <div class="msg-row" style="animation: fadeIn 0.3s ease;">
          <div class="msg-avatar ${avatarColor}">${avatarText}</div>
          <div>
            <div class="msg-bubble">Halo min, saya ${name}.</div>
            <div class="msg-time">${time}</div>
          </div>
        </div>
      `;

      // (Khusus Mobile) Otomatis scroll ke bawah agar area chat langsung terlihat
      if (window.innerWidth < 1024) {
        document.getElementById('chat-input-section').scrollIntoView({ behavior: 'smooth' });
      }
    }

    // 2. Fungsi untuk Mengirim Pesan
    function sendMsg(text = null) {
      const textarea = document.getElementById('chat-textarea');
      // Jika fungsi dipanggil oleh tombol Quick Reply, gunakan teks tersebut. Jika tidak, ambil dari textarea
      const messageText = text !== null ? text : textarea.value.trim();

      if (messageText === "") return; // Jangan kirim jika kosong

      const chatMsgs = document.getElementById('chat-msgs');
      const currentTime = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

      // Buat Gelembung Chat Admin (Warna Biru, Sebelah Kanan)
      const msgHTML = `
        <div class="msg-row admin" style="animation: fadeIn 0.3s ease;">
          <div class="msg-avatar bg-sg-blue">A</div>
          <div>
            <div class="msg-bubble">${messageText}</div>
            <div class="msg-time">${currentTime}</div>
          </div>
        </div>
      `;

      // Sisipkan gelembung chat ke dalam area percakapan
      chatMsgs.insertAdjacentHTML('beforeend', msgHTML);

      // Kosongkan kolom input, reset tinggi textarea, dan scroll ke chat paling bawah
      textarea.value = "";
      textarea.style.height = 'auto';
      chatMsgs.scrollTop = chatMsgs.scrollHeight;
    }

    // 3. Fungsi Balasan Cepat (Quick Reply)
    function quickReply(text) {
      sendMsg(text); // Panggil fungsi sendMsg dengan teks yang dipilih
    }
  </script>
</div>