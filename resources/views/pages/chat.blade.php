<div class="page {{ ($initPage ?? '') === 'chat' ? 'active' : '' }}" id="page-chat">
  
  <style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    @media (max-width: 1023px) {
      .chat-container #chat-sidebar { width: 100% !important; height: 100% !important; }
      .chat-container #chat-window { width: 100% !important; height: 100% !important; }
      .chat-container.chat-active #chat-sidebar { display: none !important; }
      .chat-container:not(.chat-active) #chat-window { display: none !important; }
    }
  </style>

  <div class="bg-white rounded-2xl border border-sg-border shadow-sm flex flex-col lg:flex-row overflow-hidden w-full chat-container" id="chat-container" style="height:calc(100vh - 110px);">

    <div class="w-full lg:w-[320px] h-full flex flex-col border-b lg:border-b-0 lg:border-r border-sg-border flex-shrink-0 bg-[#FAFBFD] min-h-0" id="chat-sidebar">
      <div class="px-5 py-4 border-b border-sg-border flex items-center justify-between flex-shrink-0">
        <span class="font-display font-bold text-[15px]">💬 Pesan Masuk</span>
      </div>
      <div class="p-3 border-b border-sg-border bg-white flex-shrink-0">
        <div class="relative">
          <i class="bi bi-search absolute left-3.5 top-1/2 -translate-y-1/2 text-sg-sub text-sm"></i>
          <input type="text" class="w-full bg-sg-bg border border-sg-border rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" placeholder="Cari pelanggan..." id="chat-search">
        </div>
      </div>
      
      <div class="flex-1 overflow-y-auto bg-white min-h-0" id="chat-contacts">
        @php
            $requestedUser = request('user');
            
            // PERBAIKAN: Tambahkan where('is_resolved', false) agar chat yang selesai tidak muncul lagi
            $userIds = \App\Models\Chat::where('is_resolved', false)->pluck('user_id')->unique()->filter()->values()->toArray();
            
            if (!empty($requestedUser) && !in_array($requestedUser, $userIds)) array_unshift($userIds, $requestedUser);

            $usersData = \App\Models\User::whereIn('id_user', $userIds)->orWhereIn('_id', $userIds)->get()->keyBy(function($item) {
                return $item->id_user ?? $item->_id ?? $item->id;
            });
            $colors = ['bg-sg-blue', 'bg-sg-green', 'bg-yellow-500', 'bg-purple-500'];
        @endphp

        @forelse($userIds as $idx => $uid)
            @php
                $u = $usersData->get($uid);
                $namaPelanggan = $u ? ($u->username ?? $u->nama ?? 'Pelanggan') : 'User ' . substr($uid, -4);
                $color = $colors[$idx % 4];
                $ava = strtoupper(substr($namaPelanggan, 0, 1));
                $fotoProfil = $u?->foto_profil ?? null;

                $lastMsg = \App\Models\Chat::where('user_id', $uid)->orderBy('created_at', 'desc')->first();
                $time = $lastMsg ? \Carbon\Carbon::parse($lastMsg->created_at)->timezone('Asia/Jakarta')->format('H:i') : '';
                $preview = $lastMsg ? (empty($lastMsg->message) && $lastMsg->image ? '📷 Mengirim Gambar' : $lastMsg->message) : 'Belum ada pesan';
            @endphp
            <div class="chat-contact cursor-pointer border-b border-sg-border/50 hover:bg-[#F8FAFC] transition-colors"
                 data-userid="{{ $uid }}"
                 data-foto="{{ $fotoProfil ? asset('storage/' . $fotoProfil) : '' }}"
                 onclick="openChat(this, '{{ $uid }}', '{{ $namaPelanggan }}', '{{ $time }}', '{{ $ava }}', '{{ $color }}')">
              <div class="p-3 flex items-center gap-3">
                {{-- Avatar: foto profil jika ada, fallback huruf --}}
                @if($fotoProfil)
                  <img src="{{ asset('storage/' . $fotoProfil) }}"
                       alt="{{ $namaPelanggan }}"
                       class="w-10 h-10 rounded-full object-cover flex-shrink-0 border border-sg-border">
                @else
                  <div class="cc-avatar {{ $color }} w-10 h-10 rounded-full flex items-center justify-center font-bold text-white flex-shrink-0">{{ $ava }}</div>
                @endif
                <div class="cc-info flex-1 min-w-0">
                  <div class="flex justify-between items-center mb-0.5 gap-2">
                    <div class="cc-name font-bold text-[14px] text-sg-text truncate flex-1">{{ $namaPelanggan }}</div>
                    <div class="cc-time text-[11px] text-sg-sub flex-shrink-0 whitespace-nowrap">{{ $time }}</div>
                  </div>
                  <div class="flex justify-between items-center">
                    <div class="cc-preview font-medium text-[12px] text-sg-sub truncate pr-2">{{ \Illuminate\Support\Str::limit($preview, 30) }}</div>
                  </div>
                </div>
              </div>
            </div>
        @empty
            <div class="p-5 text-center text-sg-sub text-sm">Belum ada obrolan masuk</div>
        @endforelse
      </div>
    </div>

    <div class="flex-1 flex flex-col overflow-hidden relative bg-[#F7F9FD] min-h-0" id="chat-window">

      <div class="absolute inset-0 flex flex-col items-center justify-center gap-3 text-sg-sub bg-white z-10" id="chat-empty">
        <div class="text-6xl opacity-20 mb-2">💬</div>
        <div class="text-[14px] font-medium px-6 text-center">Pilih percakapan dari daftar untuk mulai membalas</div>
      </div>

      <div class="px-4 md:px-5 py-3 border-b border-sg-border hidden items-center gap-3 bg-white shadow-sm z-20 flex-shrink-0" id="cw-header">
        <button class="lg:hidden text-sg-text hover:text-sg-blue mr-1 flex items-center justify-center w-8 h-8 rounded-lg hover:bg-sg-bg transition-colors" onclick="closeChat()">
          <i class="bi bi-arrow-left text-lg"></i>
        </button>
        <div class="w-10 h-10 rounded-xl overflow-hidden flex items-center justify-center text-lg font-bold text-white flex-shrink-0 shadow-sm bg-sg-blue" id="cw-avatar"></div>
        <div class="flex-grow min-w-0">
          <div class="font-bold text-[14px] md:text-[15px] truncate text-sg-text" id="cw-name"></div>
          <div class="text-[11px] font-semibold text-sg-green flex items-center gap-1 mt-0.5">
             <span class="w-1.5 h-1.5 rounded-full bg-sg-green"></span> Online
          </div>
        </div>
        
        <div class="flex gap-2 flex-shrink-0">
          <button class="bg-sg-greenlt text-sg-green border border-sg-green/20 font-bold rounded-xl px-3 py-2 text-xs hover:bg-sg-green hover:text-white transition-all flex items-center gap-1.5 shadow-sm" onclick="markResolved()">
            <i class="bi bi-check-lg text-sm"></i> <span class="hidden md:inline">Selesai</span>
          </button>
          <button class="bg-red-50 text-red-500 border border-red-100 font-bold rounded-xl px-3 py-2 text-xs hover:bg-red-500 hover:text-white transition-all flex items-center justify-center shadow-sm" onclick="closeChat()" title="Tutup Obrolan">
            <i class="bi bi-x-lg text-sm"></i>
          </button>
        </div>
      </div>

      <div class="flex-1 overflow-y-auto p-4 md:p-6 flex-col gap-2 hidden z-20 min-h-0" id="chat-msgs"></div>

      <div id="chat-input-section" class="hidden flex-col bg-white border-t border-sg-border z-20 flex-shrink-0">
        
        <div id="reply-banner" class="hidden bg-sg-bg/50 px-4 py-2 text-xs text-sg-sub flex justify-between items-center border-b border-sg-border/50">
          <div class="flex items-center gap-2 truncate">
            <i class="bi bi-reply-fill text-sg-blue"></i>
            <span>Membalas: <span id="reply-text" class="font-semibold italic text-sg-text truncate"></span></span>
          </div>
          <button type="button" onclick="cancelReply()" class="text-red-400 hover:text-red-600 ml-2"><i class="bi bi-x-circle-fill"></i></button>
        </div>

        <div id="image-preview-banner" class="hidden bg-sg-bg/50 px-4 py-2 flex justify-between items-center border-b border-sg-border/50">
           <div class="flex items-center gap-2 text-xs text-sg-text font-semibold">
               <i class="bi bi-image text-sg-blue"></i>
               <span id="image-preview-name" class="truncate max-w-[200px]"></span>
           </div>
           <button type="button" onclick="cancelImage()" class="text-red-400 hover:text-red-600 text-xs flex items-center gap-1"><i class="bi bi-x-circle-fill"></i> Batal</button>
        </div>
        
        <div class="p-3 md:p-4 flex items-end gap-2 md:gap-3">
          <div class="flex-1 bg-[#F8FAFC] border border-sg-border rounded-xl px-3 md:px-4 py-2 flex items-end gap-2 focus-within:border-sg-blue focus-within:bg-white focus-within:ring-1 focus-within:ring-sg-blue transition-all shadow-inner">
            <textarea id="chat-textarea" class="chat-textarea flex-1 bg-transparent border-none text-[13px] text-sg-text placeholder-sg-sub py-1.5 max-h-24 overflow-y-auto hide-scrollbar focus:outline-none" placeholder="Ketik balasan untuk pelanggan..." rows="1" onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();sendMsg();}"></textarea>
            
            <input type="file" id="chat-image-input" style="display: none;" accept="image/*" onchange="previewImage()">
            <button type="button" class="text-[20px] cursor-pointer text-sg-sub hover:text-sg-blue transition-colors pb-1 mr-1" title="Kirim Gambar" onclick="document.getElementById('chat-image-input').click()">
              <i class="bi bi-image"></i>
            </button>
          </div>
          
          <button class="w-12 md:w-auto h-12 md:h-auto md:px-5 md:py-2.5 bg-sg-blue text-white font-semibold rounded-xl flex items-center justify-center gap-2 hover:bg-sg-bluedk transition-all shadow-sm" onclick="sendMsg()" title="Kirim Pesan">
            <span class="hidden md:inline text-[13px]">Kirim</span>
            <i class="bi bi-send-fill text-sm"></i>
          </button>
        </div>
      </div>

    </div>
  </div>

  <script>
    let activeUserId = null;
    let activeUserAva = '';
    let activeUserColor = '';
    let replyingToText = null;

    function openChat(element, userId, name, time, avatarText, avatarColor) {
      window.history.pushState({}, '', '/chat?user=' + userId);
      
      document.getElementById('chat-container').classList.add('chat-active');
      document.getElementById('chat-empty').classList.add('hidden');
      
      document.getElementById('cw-header').classList.remove('hidden');
      document.getElementById('cw-header').classList.add('flex');
      document.getElementById('chat-msgs').classList.remove('hidden');
      document.getElementById('chat-msgs').classList.add('flex');
      document.getElementById('chat-input-section').classList.remove('hidden');
      document.getElementById('chat-input-section').classList.add('flex');

      document.getElementById('cw-name').textContent = name;

      // Update avatar header
      let avatarEl = document.getElementById('cw-avatar');
      const fotoUrl = element ? element.dataset.foto : '';
      if (avatarEl) {
          if (fotoUrl) {
              avatarEl.innerHTML = `<img src="${fotoUrl}" class="w-full h-full object-cover rounded-xl">`;
              avatarEl.className = `w-10 h-10 rounded-xl overflow-hidden flex-shrink-0 shadow-sm`;
          } else {
              avatarEl.innerHTML = avatarText;
              avatarEl.className = `w-10 h-10 rounded-xl flex items-center justify-center text-lg font-bold text-white flex-shrink-0 shadow-sm ${avatarColor}`;
          }
      }

      document.querySelectorAll('.chat-contact').forEach(el => el.classList.remove('active', 'bg-[#E8F0FE]', 'border-l-4', 'border-l-sg-blue'));
      if(element) element.classList.add('active', 'bg-[#E8F0FE]', 'border-l-4', 'border-l-sg-blue');

      activeUserId = userId;
      activeUserAva = avatarText;
      activeUserColor = avatarColor;

      cancelReply(); cancelImage();
      fetchMessages(); 
    }

    function closeChat() {
      document.getElementById('chat-container').classList.remove('chat-active');
      document.getElementById('chat-empty').classList.remove('hidden');
      
      document.getElementById('cw-header').classList.remove('flex');
      document.getElementById('cw-header').classList.add('hidden');
      document.getElementById('chat-msgs').classList.remove('flex');
      document.getElementById('chat-msgs').classList.add('hidden');
      document.getElementById('chat-input-section').classList.remove('flex');
      document.getElementById('chat-input-section').classList.add('hidden');
      
      document.querySelectorAll('.chat-contact').forEach(el => el.classList.remove('active', 'bg-[#E8F0FE]', 'border-l-4', 'border-l-sg-blue'));
      
      activeUserId = null;
      window.history.pushState({}, '', '/chat'); 
    }

    function previewImage() {
        const file = document.getElementById('chat-image-input').files[0];
        if(file) {
            document.getElementById('image-preview-banner').classList.remove('hidden');
            document.getElementById('image-preview-name').textContent = file.name;
        }
    }
    function cancelImage() {
        document.getElementById('chat-image-input').value = "";
        document.getElementById('image-preview-banner').classList.add('hidden');
    }
    function replyMsg(text) {
        replyingToText = text;
        document.getElementById('reply-banner').classList.remove('hidden');
        document.getElementById('reply-text').textContent = text;
        document.getElementById('chat-textarea').focus();
    }
    function cancelReply() {
        replyingToText = null;
        document.getElementById('reply-banner').classList.add('hidden');
    }
    function deleteMsg(id) {
        if(confirm("Hapus pesan ini dari sistem?")) {
            fetch(`/api/admin/chat/message/${id}`, { method: 'DELETE' })
            .then(res => res.json())
            .then(() => fetchMessages()); 
        }
    }

    function markResolved() {
        if (!activeUserId) return;
        if (!confirm('Tandai percakapan ini sebagai selesai? Riwayat pesan di sisi pelanggan akan dihapus secara otomatis.')) return;

        fetch(`/api/admin/chat/${activeUserId}/resolve`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? ''
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const contactEl = document.querySelector(`.chat-contact[data-userid="${activeUserId}"]`);
                if (contactEl) contactEl.remove();
                closeChat();
            }
        })
        .catch(() => alert('Gagal menandai selesai. Coba lagi.'));
    }

    function fetchMessages() {
        if (!activeUserId) return;
        
        fetch(`/api/admin/chat/${activeUserId}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const chatMsgs = document.getElementById('chat-msgs');
                    if(!chatMsgs) return;
                    
                    let tempHTML = `<div class="w-full text-center text-[11px] text-sg-sub my-3"><span>Awal Obrolan</span></div>`;
                    
                    data.data.forEach(msg => {
                        let msgId = msg._id || msg.id;
                        let timeStr = new Date(msg.created_at).toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'});
                        let safeMsg = (msg.message || 'Gambar').replace(/'/g, "\\'");
                        
                        let replyHtml = '';
                        if (msg.reply_to_text) {
                            if (msg.sender === 'admin') {
                                replyHtml = `<div class="bg-black/20 text-white/90 text-[11px] px-2 py-1.5 rounded mb-1.5 border-l-2 border-white/50 italic line-clamp-1">${msg.reply_to_text}</div>`;
                            } else {
                                replyHtml = `<div class="bg-gray-100 text-sg-sub text-[11px] px-2 py-1.5 rounded mb-1.5 border-l-2 border-sg-blue italic line-clamp-1">${msg.reply_to_text}</div>`;
                            }
                        }
                        
                        let imageHtml = msg.image ? `<img src="/storage/${msg.image}" class="rounded-lg mb-1.5 max-w-[200px] cursor-pointer hover:opacity-90" onclick="window.open('/storage/${msg.image}', '_blank')">` : '';
                        let formattedMsg = msg.message ? msg.message.replace(/\n/g, '<br>') : '';
                        let textHtml = formattedMsg ? `<div class="whitespace-pre-wrap">${formattedMsg}</div>` : '';

                        if (msg.sender === 'admin') {
                            tempHTML += `
                            <div class="w-full flex justify-end mb-2 pr-1 group" style="animation: fadeIn 0.3s ease;">
                              <div class="hidden group-hover:flex items-center justify-center mr-2 gap-2 text-sg-sub">
                                <button type="button" onclick="replyMsg('${safeMsg}')" title="Balas"><i class="bi bi-reply-fill hover:text-sg-blue text-base"></i></button>
                                <button type="button" onclick="deleteMsg('${msgId}')" title="Hapus"><i class="bi bi-trash-fill text-red-400 hover:text-red-600 text-base"></i></button>
                              </div>
                              <div class="flex flex-col items-end max-w-[75%]">
                                <div class="bg-sg-blue text-white px-3 py-2 rounded-2xl rounded-br-sm shadow-sm text-[12px] md:text-[13px] leading-relaxed">
                                  ${replyHtml} ${imageHtml} ${textHtml}
                                </div>
                                <div class="text-[9px] text-sg-sub mt-0.5 text-right">${timeStr}</div>
                              </div>
                            </div>`;
                        } else {
                            tempHTML += `
                            <div class="w-full flex justify-start mb-2 pl-1 group" style="animation: fadeIn 0.3s ease;">
                              <div class="${activeUserColor} w-7 h-7 rounded-full flex items-center justify-center text-white text-[10px] font-bold mr-2 mt-auto shadow-sm flex-shrink-0">${activeUserAva}</div>
                              <div class="flex flex-col items-start max-w-[75%]">
                                <div class="bg-white border border-sg-border text-sg-text px-3 py-2 rounded-2xl rounded-bl-sm shadow-sm text-[12px] md:text-[13px] leading-relaxed">
                                  ${replyHtml} ${imageHtml} ${textHtml}
                                </div>
                                <div class="text-[9px] text-sg-sub mt-0.5 text-left">${timeStr}</div>
                              </div>
                              <div class="hidden group-hover:flex items-center justify-center ml-2 gap-2 text-sg-sub">
                                <button type="button" onclick="replyMsg('${safeMsg}')" title="Balas"><i class="bi bi-reply-fill hover:text-sg-blue text-base"></i></button>
                              </div>
                            </div>`;
                        }
                    });
                    
                    if (chatMsgs.innerHTML !== tempHTML) {
                        let isScrolledBottom = chatMsgs.scrollHeight - chatMsgs.clientHeight <= chatMsgs.scrollTop + 50;
                        chatMsgs.innerHTML = tempHTML;
                        if (isScrolledBottom) chatMsgs.scrollTop = chatMsgs.scrollHeight;
                    }
                }
            });
    }

    function sendMsg(text = null) {
      const textarea = document.getElementById('chat-textarea');
      const fileInput = document.getElementById('chat-image-input');
      const messageText = text !== null ? text : textarea.value.trim();
      const file = fileInput.files[0];

      if ((messageText === "" && !file) || !activeUserId) return;

      const formData = new FormData();
      formData.append('message', messageText);
      if (file) formData.append('image', file);
      if (replyingToText) formData.append('reply_to_text', replyingToText);

      const chatMsgs = document.getElementById('chat-msgs');
      const currentTime = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
      
      let replyHtml = replyingToText ? `<div class="bg-black/20 text-white/90 text-[11px] px-2 py-1.5 rounded mb-1.5 border-l-2 border-white/50 italic line-clamp-1">${replyingToText}</div>` : '';
      let textHtml = messageText ? `<div class="whitespace-pre-wrap">${messageText.replace(/\n/g, '<br>')}</div>` : '';
      
      let imageHtml = '';
      if(file) {
          const objectUrl = URL.createObjectURL(file);
          imageHtml = `<img src="${objectUrl}" class="rounded-lg mb-1.5 max-w-[200px]">`;
      }

      const msgHTML = `
        <div class="w-full flex justify-end mb-2 pr-1 group" style="animation: fadeIn 0.3s ease;">
          <div class="flex flex-col items-end max-w-[75%]">
            <div class="bg-sg-blue text-white px-3 py-2 rounded-2xl rounded-br-sm shadow-sm text-[12px] md:text-[13px] leading-relaxed">
              ${replyHtml} ${imageHtml} ${textHtml}
            </div>
            <div class="text-[9px] text-sg-sub mt-0.5 text-right">${currentTime}</div>
          </div>
        </div>
      `;

      if(chatMsgs) {
         chatMsgs.insertAdjacentHTML('beforeend', msgHTML);
         chatMsgs.scrollTop = chatMsgs.scrollHeight;
      }
      
      if(textarea) { textarea.value = ""; textarea.style.height = 'auto'; }
      cancelReply();
      cancelImage();

      fetch(`/api/admin/chat/${activeUserId}`, {
          method: 'POST',
          body: formData
      }).then(() => {
          fetchMessages(); 
      });
    }

    // ── FITUR BARU: Cari / Filter Pelanggan Berdasarkan Input Text ──
    document.getElementById('chat-search')?.addEventListener('input', function(e) {
        const keyword = e.target.value.toLowerCase();
        document.querySelectorAll('.chat-contact').forEach(el => {
            const name = el.querySelector('.cc-name')?.textContent.toLowerCase() || '';
            el.style.display = name.includes(keyword) ? '' : 'none';
        });
    });

    // ── FITUR BARU: Update Sidebar Otomatis di Latar Belakang ──
    function refreshSidebar() {
        const searchInput = document.getElementById('chat-search');
        
        // Jangan auto-refresh sidebar jika admin sedang menggunakan fitur pencarian
        if (searchInput && searchInput.value.trim() !== '') return;

        // Ambil URL dengan query aktif agar user yang terpilih tidak tertutup
        const currentUrl = window.location.href;
        
        fetch(currentUrl)
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");
                const newContacts = doc.getElementById('chat-contacts');
                const oldContacts = document.getElementById('chat-contacts');
                
                if (newContacts && oldContacts) {
                    // Menyimpan posisi scroll agar tidak melompat ke atas secara tiba-tiba
                    const scrollPos = oldContacts.scrollTop;
                    oldContacts.innerHTML = newContacts.innerHTML;
                    oldContacts.scrollTop = scrollPos;
                    
                    // Mengembalikan highlight aktif ke user yang sedang dibuka pesannya
                    if (activeUserId) {
                        document.querySelectorAll('.chat-contact').forEach(el => el.classList.remove('active', 'bg-[#E8F0FE]', 'border-l-4', 'border-l-sg-blue'));
                        const activeContact = document.querySelector(`.chat-contact[data-userid="${activeUserId}"]`);
                        if (activeContact) activeContact.classList.add('active', 'bg-[#E8F0FE]', 'border-l-4', 'border-l-sg-blue');
                    }
                }
            })
            .catch(err => console.log('Gagal memperbarui sidebar', err));
    }

    setTimeout(() => {
        const urlParams = new URLSearchParams(window.location.search);
        const targetUserId = urlParams.get('user');
        if (targetUserId) {
            const contactTarget = document.querySelector(`.chat-contact[data-userid="${targetUserId}"]`);
            if (contactTarget) contactTarget.click(); 
        }
    }, 200);

    // ── PERBAIKAN: Interval Polling (Ruang Obrolan & Daftar Sidebar) ──
    setInterval(() => {
        // 1. Jalankan auto-refresh daftar kontak terbaru di sidebar (kiri)
        refreshSidebar();

        // 2. Jalankan auto-refresh isi pesan (kanan) HANYA jika ada chat yang sedang dibuka
        if(activeUserId) {
            const textarea = document.getElementById('chat-textarea');
            const fileInput = document.getElementById('chat-image-input');
            
            // Jeda pengambilan pesan baru dari server saat admin sedang mengetik/melampirkan foto
            if ((!textarea || textarea.value.trim() === "") && !fileInput.files.length) {
                fetchMessages();
            }
        }
    }, 3000); // Polling berjalan setiap 3 detik
  </script>
</div>