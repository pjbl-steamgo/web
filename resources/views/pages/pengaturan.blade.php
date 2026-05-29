<div class="page {{ ($initPage ?? '') === 'pengaturan' ? 'active' : '' }}" id="page-pengaturan">
  <div class="w-full grid grid-cols-1 xl:grid-cols-2 gap-4 md:gap-6">
    
    <div class="bg-white rounded-2xl border border-sg-border shadow-sm overflow-hidden flex flex-col">
      <div class="px-5 py-4 border-b border-sg-border bg-[#FAFBFD]">
        <span class="font-display font-bold text-[15px] text-sg-text flex items-center gap-2">
          <i class="bi bi-shop text-sg-blue"></i> Informasi Usaha
        </span>
      </div>
      
      <div class="p-5 flex-grow flex flex-col">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="sm:col-span-2">
            <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1.5">Nama Usaha</label>
            <input class="w-full bg-[#FAFBFD] border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:bg-white focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" value="SteamGo">
          </div>
          
          <div>
            <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1.5">Nomor HP</label>
            <input class="w-full bg-[#FAFBFD] border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:bg-white focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" value="+62 812-xxxx-xxxx">
          </div>
          
          <div>
            <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1.5">Email</label>
            <input class="w-full bg-[#FAFBFD] border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:bg-white focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" value="admin@steamgo.id">
          </div>
          
          <div>
            <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1.5">Jam Buka</label>
            <input class="w-full bg-[#FAFBFD] border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:bg-white focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" type="time" value="08:00">
          </div>
          
          <div>
            <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1.5">Jam Tutup</label>
            <input class="w-full bg-[#FAFBFD] border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:bg-white focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" type="time" value="17:00">
          </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 mt-auto pt-5 border-t border-sg-border mt-6">
          <button class="w-full sm:w-auto bg-sg-blue text-white font-semibold rounded-xl px-5 py-2.5 text-sm hover:bg-sg-bluedk transition-colors shadow-sm order-1 sm:order-2" onclick="showToast('Perubahan disimpan!')">
            Simpan Perubahan
          </button>
          <button class="w-full sm:w-auto bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-5 py-2.5 text-sm hover:bg-sg-bg hover:text-sg-sub transition-colors order-2 sm:order-1">
            Batal
          </button>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-2xl border border-sg-border shadow-sm overflow-hidden flex flex-col">
      <div class="px-5 py-4 border-b border-sg-border bg-[#FAFBFD]">
        <span class="font-display font-bold text-[15px] text-sg-text flex items-center gap-2">
          <i class="bi bi-person-badge text-sg-blue"></i> Akun Admin
        </span>
      </div>
      
      <div class="p-5 flex-grow flex flex-col">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="sm:col-span-2">
            <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1.5">Nama Admin</label>
            <input class="w-full bg-[#FAFBFD] border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:bg-white focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" value="Admin SteamGo">
          </div>
          
          <div>
            <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1.5">Password Baru</label>
            <input class="w-full bg-[#FAFBFD] border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:bg-white focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" type="password" placeholder="••••••••">
          </div>
          
          <div>
            <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1.5">Konfirmasi Password</label>
            <input class="w-full bg-[#FAFBFD] border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:bg-white focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" type="password" placeholder="••••••••">
          </div>
        </div>
        
        <div class="mt-auto pt-5 border-t border-sg-border mt-6">
          <button class="w-full sm:w-auto bg-sg-blue text-white font-semibold rounded-xl px-5 py-2.5 text-sm hover:bg-sg-bluedk transition-colors shadow-sm" onclick="showToast('Password diperbarui!')">
            Update Password
          </button>
        </div>
      </div>
    </div>

  </div>
</div>