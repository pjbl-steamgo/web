<div class="page" id="page-chat">
    <div class="bg-white rounded-2xl border border-sg-border overflow-hidden shadow-sm grid grid-cols-1 lg:grid-cols-[300px_1fr]" style="height:calc(100vh - 62px - 48px - 24px); min-height:500px;">

        {{-- Contact List --}}
        <div class="border-r border-sg-border flex flex-col overflow-hidden">
            <div class="px-5 py-4 border-b border-sg-border flex items-center justify-between">
                <span class="font-display font-bold text-sm">💬 Pesan Masuk</span>
                <span class="inline-flex text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-sg-bluelt text-sg-blue" id="unread-count">4 baru</span>
            </div>
            <div class="p-2 border-b border-sg-border">
                <input type="text" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-sg-blue" placeholder="🔍 Cari pelanggan..." id="chat-search" oninput="filterContacts(this.value)">
            </div>
            <div class="flex-1 overflow-y-auto" id="chat-contacts"></div>
        </div>

        {{-- Chat Window --}}
        <div class="flex flex-col overflow-hidden" id="chat-window">
            {{-- Empty state --}}
            <div class="flex flex-col items-center justify-center h-full gap-2 text-sg-sub" id="chat-empty">
                <div class="text-5xl opacity-30">💬</div>
                <div class="text-sm font-medium">Pilih percakapan untuk mulai membalas</div>
            </div>

            {{-- Chat Header --}}
            <div class="px-5 py-4 border-b border-sg-border hidden items-center gap-3" id="cw-header">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-base font-bold text-white flex-shrink-0" id="cw-avatar"></div>
                <div class="flex-grow">
                    <div class="font-semibold text-[15px]" id="cw-name"></div>
                    <div class="text-xs text-sg-green" id="cw-status">● Online</div>
                </div>
                <div class="flex gap-2">
                    <button class="bg-white text-sg-text border border-sg-border font-semibold rounded-lg px-3 py-1.5 text-xs hover:border-sg-blue hover:text-sg-blue transition-colors" onclick="openModal('modal-detail-pelanggan')">👤 Profil</button>
                    <button class="bg-sg-greenlt text-sg-green border border-sg-green/20 font-semibold rounded-lg px-3 py-1.5 text-xs" onclick="markResolved()">✓ Selesai</button>
                </div>
            </div>

            {{-- Messages --}}
            <div class="flex-1 overflow-y-auto p-4 flex-col gap-2.5 bg-[#F7F9FD] hidden" id="chat-msgs"></div>

            {{-- Chat Input --}}
            <div id="chat-input-section" class="hidden">
                <div class="flex gap-1.5 p-3 pb-0 flex-wrap">
                    <button class="px-3 py-1 rounded-full text-xs font-semibold bg-white border border-sg-border hover:border-sg-blue hover:text-sg-blue transition-colors" onclick="quickReply('Baik kak, kami proses sekarang ya 😊')">Oke, diproses</button>
                    <button class="px-3 py-1 rounded-full text-xs font-semibold bg-white border border-sg-border hover:border-sg-blue hover:text-sg-blue transition-colors" onclick="quickReply('Jadwal sudah kami ubah, terima kasih kak!')">Jadwal diubah</button>
                    <button class="px-3 py-1 rounded-full text-xs font-semibold bg-white border border-sg-border hover:border-sg-blue hover:text-sg-blue transition-colors" onclick="quickReply('Mohon maaf atas ketidaknyamanannya, kak 🙏')">Minta maaf</button>
                    <button class="px-3 py-1 rounded-full text-xs font-semibold bg-white border border-sg-border hover:border-sg-blue hover:text-sg-blue transition-colors" onclick="quickReply('Kendaraan kak sudah selesai dan siap diambil!')">Selesai siap ambil</button>
                </div>
                <div class="p-3 border-t border-sg-border bg-white flex items-end gap-2">
                    <div class="flex-1 bg-sg-bg border border-sg-border rounded-xl px-3 py-2 flex items-end gap-1.5 focus-within:border-sg-blue focus-within:bg-white transition-colors">
                        <textarea id="chat-textarea" class="chat-textarea flex-1 bg-transparent border-none text-sm text-sg-text placeholder-[#b0b8cc]" placeholder="Ketik balasan..." rows="1"
                            onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();sendMsg();}"
                            oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px'"></textarea>
                        <span class="text-lg cursor-pointer text-sg-sub">📎</span>
                    </div>
                    <button class="bg-sg-blue text-white font-semibold rounded-xl px-5 py-2.5 text-sm hover:bg-sg-bluedk transition-colors" onclick="sendMsg()">Kirim <i class="bi bi-send"></i></button>
                </div>
            </div>
        </div>

    </div>
</div>{{-- /chat --}}
