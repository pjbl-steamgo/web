<div class="page" id="page-pengaturan">
    <div class="max-w-2xl flex flex-col gap-4">
        {{-- Informasi Usaha --}}
        <div class="bg-white rounded-2xl border border-sg-border shadow-sm">
            <div class="px-5 py-4 border-b border-sg-border"><span class="font-display font-bold text-sm">Informasi Usaha</span></div>
            <div class="p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Nama Usaha</label>
                        <input class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" value="SteamGo">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Nomor HP</label>
                        <input class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" value="+62 812-xxxx-xxxx">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Email</label>
                        <input class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" value="admin@steamgo.id">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Jam Buka</label>
                        <input class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" type="time" value="08:00">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Jam Tutup</label>
                        <input class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" type="time" value="17:00">
                    </div>
                </div>
                <div class="flex gap-2 mt-4">
                    <button class="bg-sg-blue text-white font-semibold rounded-xl px-4 py-2 text-sm hover:bg-sg-bluedk transition-colors" onclick="showToast('Perubahan disimpan!')">Simpan Perubahan</button>
                    <button class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-4 py-2 text-sm hover:border-sg-blue hover:text-sg-blue transition-colors">Batal</button>
                </div>
            </div>
        </div>

        {{-- Akun Admin --}}
        <div class="bg-white rounded-2xl border border-sg-border shadow-sm">
            <div class="px-5 py-4 border-b border-sg-border"><span class="font-display font-bold text-sm">Akun Admin</span></div>
            <div class="p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Nama Admin</label>
                        <input class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" value="Admin SteamGo">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Password Baru</label>
                        <input class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" type="password" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Konfirmasi Password</label>
                        <input class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" type="password" placeholder="••••••••">
                    </div>
                </div>
                <div class="mt-4">
                    <button class="bg-sg-blue text-white font-semibold rounded-xl px-4 py-2 text-sm hover:bg-sg-bluedk transition-colors" onclick="showToast('Password diperbarui!')">Update Password</button>
                </div>
            </div>
        </div>
    </div>
</div>{{-- /pengaturan --}}
