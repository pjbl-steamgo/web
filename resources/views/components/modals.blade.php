<div id="modal-backdrop" class="hidden fixed inset-0 bg-black/50 z-[2000]" onclick="closeModal()"></div>

<div id="modal-tambah-antrian" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl">
  <div class="flex items-center justify-between px-6 py-4 border-b border-sg-border"><h5 class="font-display font-bold text-[17px]">Tambah Antrian Baru</h5><button class="text-sg-sub hover:text-sg-text" onclick="closeModal()">✕</button></div>
  <div class="p-6 grid grid-cols-2 gap-3">
    <div class="col-span-2"><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Nama Pelanggan</label><input id="new-antrian-pelanggan" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" placeholder="Nama pelanggan..."></div>
    <div><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Kendaraan</label><select id="new-antrian-kendaraan" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue"><option>Motor</option><option>Mobil</option></select></div>
    <div><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Layanan</label><select id="new-antrian-layanan" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue"><option>Steam Biasa Motor</option><option>Snow Wash Motor</option><option>Detailing Motor</option><option>Steam Biasa Mobil</option><option>Snow Wash Mobil</option><option>Detailing Mobil</option></select></div>
    <div><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Jam</label><input id="new-antrian-jam" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" type="time" value="10:00"></div>
  </div>
  <div class="flex gap-2 px-6 py-4 border-t border-sg-border">
    <button class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-4 py-2 text-sm hover:border-sg-blue hover:text-sg-blue transition-colors" onclick="closeModal()">Batal</button>
    <button class="bg-sg-blue text-white font-semibold rounded-xl px-4 py-2 text-sm hover:bg-sg-bluedk transition-colors" onclick="saveTambahAntrian()">Tambah Antrian</button>
  </div>
</div>

<div id="modal-tambah-layanan" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl">
  
  <form action="{{ route('layanan.store') }}" method="POST">
    @csrf <div class="flex items-center justify-between px-6 py-4 border-b border-sg-border">
      <h5 class="font-display font-bold text-[17px]">Tambah Layanan Baru</h5>
      <button type="button" class="text-sg-sub hover:text-sg-text" onclick="closeModal()">✕</button>
    </div>
    
    <div class="p-6 grid grid-cols-2 gap-3">
      <div class="col-span-2">
        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Nama Layanan</label>
        <input name="nama_layanan" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" placeholder="Cth: Snow Wash Motor" required>
      </div>
      
      <div>
        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Kategori</label>
        <select name="kategori" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" required>
          <option value="Motor">Motor</option>
          <option value="Mobil">Mobil</option>
        </select>
      </div>
      
      <div>
        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Harga (Rp)</label>
        <input type="number" name="harga" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" placeholder="25000" required>
      </div>
      
      <div>
        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Estimasi (menit)</label>
        <input type="number" name="estimasi_waktu" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" placeholder="30" required>
      </div>

      <div class="mb-4">
        <label class="block text-xs font-bold text-sg-sub uppercase tracking-wide mb-2">Slot Tersedia</label>
        <input type="number" name="slot_tersedia" id="edit-slot-tersedia" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" placeholder="Contoh: 5" required>
      </div>
      
      <div class="col-span-2">
        <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Deskripsi</label>
        <textarea name="deskripsi" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" rows="3" placeholder="Deskripsi layanan..." required></textarea>
      </div>
    </div>
    
    <div class="flex gap-2 px-6 py-4 border-t border-sg-border">
      <button type="button" class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-4 py-2 text-sm" onclick="closeModal()">Batal</button>
      <button type="submit" class="bg-sg-blue text-white font-semibold rounded-xl px-4 py-2 text-sm hover:bg-sg-bluedk transition-colors">Simpan</button>
    </div>
  </form>
  
</div>

<div id="modal-edit-layanan" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">

  <div class="px-6 py-4 border-b border-sg-border flex justify-between items-center bg-[#FAFBFD] flex-shrink-0">
    <h3 class="font-display font-bold text-[17px] text-sg-text">Edit Layanan</h3>
    <button type="button" class="text-sg-sub hover:text-sg-red transition-colors" onclick="closeModal()">
      <i class="bi bi-x-lg text-lg"></i>
    </button>
  </div>

  <form id="form-edit-layanan" method="POST" class="flex flex-col overflow-hidden">
    @csrf
    @method('PUT') 
    
    <div class="p-6 overflow-y-auto custom-scrollbar space-y-4">
      
      <div>
        <label class="block text-xs font-bold text-sg-sub uppercase tracking-wide mb-2">Nama Layanan</label>
        <input type="text" name="nama_layanan" id="edit-nama-layanan" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" required>
      </div>

      <div>
        <label class="block text-xs font-bold text-sg-sub uppercase tracking-wide mb-2">Kategori</label>
        <select name="kategori" id="edit-kategori" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" required>
          <option value="Mobil">Mobil</option>
          <option value="Motor">Motor</option>
        </select>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        
        <div>
          <label class="block text-xs font-bold text-sg-sub uppercase tracking-wide mb-2">Harga (Rp)</label>
          <input type="number" name="harga" id="edit-harga" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" required>
        </div>
        
        <div>
          <label class="block text-xs font-bold text-sg-sub uppercase tracking-wide mb-2">Waktu (Menit)</label>
          <input type="number" name="estimasi_waktu" id="edit-estimasi" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" required>
        </div>
        
        <div>
          <label class="block text-xs font-bold text-sg-sub uppercase tracking-wide mb-2">Slot Tersedia</label>
          <input type="number" name="slot_tersedia" id="edit-slot-tersedia" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" placeholder="Contoh: 5" required>
        </div>

      </div>

      <div>
        <label class="block text-xs font-bold text-sg-sub uppercase tracking-wide mb-2">Deskripsi</label>
        <textarea name="deskripsi" id="edit-deskripsi" rows="3" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all" required></textarea>
      </div>

    </div>

    <div class="p-6 border-t border-sg-border flex justify-end gap-2 bg-[#FAFBFD] flex-shrink-0">
      <button type="button" class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-5 py-2.5 text-sm hover:bg-gray-50 transition-colors" onclick="closeModal()">Batal</button>
      <button type="submit" class="bg-sg-blue text-white font-semibold rounded-xl px-5 py-2.5 text-sm hover:bg-sg-bluedk transition-colors">Simpan Perubahan</button>
    </div>

  </form>
</div>

<div id="modal-toggle-layanan" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm bg-white rounded-2xl shadow-2xl">
  
  <form id="form-toggle-layanan" method="POST">
    @csrf
    @method('PATCH')

    <div class="p-6 text-center">
      <div id="toggle-icon-container" class="w-16 h-16 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 bg-sg-bluelt text-sg-blue">
        <i id="toggle-icon" class="bi bi-info-circle"></i>
      </div>
      
      <h5 id="toggle-title" class="font-display font-bold text-[19px] mb-2">Ubah Status?</h5>
      <p class="text-sm text-sg-sub mb-6">
        Apakah Anda yakin ingin <span id="toggle-action-text" class="font-bold"></span> layanan <strong id="toggle-nama-layanan" class="text-sg-text"></strong> di aplikasi mobile?
      </p>

      <div class="flex gap-2 justify-center">
        <button type="button" class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-gray-50 transition-colors" onclick="closeModal()">Batal</button>
        <button type="submit" id="toggle-submit-btn" class="bg-sg-blue text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 transition-colors">Ya, Lanjutkan</button>
      </div>
    </div>
  </form>
  
</div>

<div id="modal-hapus-layanan" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm bg-white rounded-2xl shadow-2xl">
  
  <form id="form-hapus-layanan" method="POST">
    @csrf
    @method('DELETE')

    <div class="p-6 text-center">
      <div class="w-16 h-16 rounded-full bg-sg-redlt text-sg-red flex items-center justify-center text-3xl mx-auto mb-4">
        <i class="bi bi-exclamation-triangle"></i>
      </div>
      
      <h5 class="font-display font-bold text-[19px] mb-2">Hapus Layanan?</h5>
      <p class="text-sm text-sg-sub mb-6">
        Apakah Anda yakin ingin menghapus layanan <strong id="hapus-nama-layanan" class="text-sg-text"></strong>? Data yang sudah dihapus tidak dapat dikembalikan.
      </p>

      <div class="flex gap-2 justify-center">
        <button type="button" class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-gray-50 transition-colors" onclick="closeModal()">Batal</button>
        <button type="submit" class="bg-sg-red text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-red-600 transition-colors">Ya, Hapus</button>
      </div>
    </div>
  </form>
  
</div>

<div id="modal-tambah-pelanggan" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl">
  <div class="flex items-center justify-between px-6 py-4 border-b border-sg-border"><h5 class="font-display font-bold text-[17px]">Tambah Pelanggan Baru</h5><button class="text-sg-sub hover:text-sg-text" onclick="closeModal()">✕</button></div>
  <div class="p-6 grid grid-cols-2 gap-3">
    <div class="col-span-2"><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Nama Lengkap</label><input id="new-pelanggan-nama" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" placeholder="Nama pelanggan..."></div>
    <div><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Nomor HP</label><input id="new-pelanggan-hp" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" placeholder="08xx-xxxx-xxxx"></div>
    <div><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Member</label><select id="new-pelanggan-member" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue"><option>Baru</option><option>Silver</option><option>Gold</option></select></div>
  </div>
  <div class="flex gap-2 px-6 py-4 border-t border-sg-border">
    <button class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-4 py-2 text-sm" onclick="closeModal()">Batal</button>
    <button class="bg-sg-blue text-white font-semibold rounded-xl px-4 py-2 text-sm hover:bg-sg-bluedk transition-colors" onclick="saveTambahPelanggan()">Tambah</button>
  </div>
</div>

<div id="modal-edit-pelanggan" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl">
  <div class="flex items-center justify-between px-6 py-4 border-b border-sg-border"><h5 class="font-display font-bold text-[17px]">Edit Data Pelanggan</h5><button class="text-sg-sub hover:text-sg-text" onclick="closeModal()">✕</button></div>
  <div class="p-6 grid grid-cols-2 gap-3">
    <input type="hidden" id="edit-pelanggan-id">
    <div class="col-span-2"><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Nama Lengkap</label><input id="edit-pelanggan-nama" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue"></div>
    <div><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Nomor HP</label><input id="edit-pelanggan-hp" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue"></div>
    <div><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Member</label><select id="edit-pelanggan-member" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue"><option>Baru</option><option>Silver</option><option>Gold</option></select></div>
  </div>
  <div class="flex gap-2 px-6 py-4 border-t border-sg-border">
    <button class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-4 py-2 text-sm" onclick="closeModal()">Batal</button>
    <button class="bg-sg-blue text-white font-semibold rounded-xl px-4 py-2 text-sm hover:bg-sg-bluedk transition-colors" onclick="saveEditPelanggan()">Simpan</button>
  </div>
</div>

<div id="modal-detail-pelanggan" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-white rounded-2xl shadow-2xl">
  <div class="flex items-center justify-between px-6 py-4 border-b border-sg-border"><h5 class="font-display font-bold text-[17px]">Detail Pelanggan</h5><button class="text-sg-sub hover:text-sg-text" onclick="closeModal()">✕</button></div>
  <div class="p-6">
    <div class="flex items-center gap-3 p-3 mb-4 rounded-2xl bg-sg-bg">
      <div class="w-14 h-14 rounded-xl flex items-center justify-center text-2xl font-bold text-white flex-shrink-0" id="detail-pelanggan-avatar"></div>
      <div>
        <div class="font-display text-[18px] font-bold" id="detail-pelanggan-nama"></div>
        <div class="text-[13px] text-sg-sub" id="detail-pelanggan-kontak"></div>
        <div id="detail-pelanggan-member" class="mt-1"></div>
      </div>
    </div>
    <div class="grid grid-cols-3 gap-2 mb-4">
      <div class="text-center p-3 rounded-xl bg-sg-bg"><div class="font-display text-[22px] font-black" id="detail-pelanggan-steam">—</div><div class="text-[11px] text-sg-sub">Total Steam</div></div>
      <div class="text-center p-3 rounded-xl bg-sg-bg"><div class="font-display text-[22px] font-black text-sg-blue" id="detail-pelanggan-bayar">—</div><div class="text-[11px] text-sg-sub">Total Bayar</div></div>
      <div class="text-center p-3 rounded-xl bg-sg-bg"><div class="font-display text-[22px] font-black text-sg-orange">4.8⭐</div><div class="text-[11px] text-sg-sub">Rating</div></div>
    </div>
  </div>
  <div class="flex gap-2 px-6 py-4 border-t border-sg-border">
    <button class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-4 py-2 text-sm" onclick="closeModal()">Tutup</button>
    <button id="detail-edit-btn" class="bg-sg-blue text-white font-semibold rounded-xl px-4 py-2 text-sm hover:bg-sg-bluedk transition-colors">Edit Data</button>
  </div>
</div>

<div id="modal-selesai-pesanan" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm bg-white rounded-2xl shadow-2xl">
  
  <form id="form-selesai-pesanan" method="POST">
    @csrf
    @method('PATCH')

    <div class="p-6 text-center">
      <div class="w-16 h-16 rounded-full bg-sg-greenlt text-sg-green flex items-center justify-center text-4xl mx-auto mb-4">
        <i class="bi bi-check-circle"></i>
      </div>
      
      <h5 class="font-display font-bold text-[19px] mb-2">Selesaikan Pesanan?</h5>
      <p class="text-sm text-sg-sub mb-6">
        Tandai pesanan <strong id="selesai-kode-pesanan" class="text-sg-text"></strong> sudah selesai dikerjakan? Kendaraan di antrian selanjutnya akan otomatis diproses.
      </p>

      <div class="flex gap-2 justify-center">
        <button type="button" class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-gray-50 transition-colors" onclick="closeModal()">Batal</button>
        <button type="submit" class="bg-sg-green text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-green-700 transition-colors">Ya, Selesaikan</button>
      </div>
    </div>
  </form>
  
</div>

<div id="modal-edit-antrian" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl">
  <div class="flex items-center justify-between px-6 py-4 border-b border-sg-border"><h5 class="font-display font-bold text-[17px]">Edit Antrian</h5><button class="text-sg-sub hover:text-sg-text" onclick="closeModal()">✕</button></div>
  <div class="p-6 grid grid-cols-2 gap-3">
    <input type="hidden" id="edit-antrian-id">
    <div class="col-span-2"><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Nama Pelanggan</label><input id="edit-antrian-pelanggan" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue"></div>
    <div><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Layanan</label><select id="edit-antrian-layanan" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue"><option>Steam Biasa Motor</option><option>Snow Wash Motor</option><option>Detailing Motor</option><option>Steam Biasa Mobil</option><option>Snow Wash Mobil</option><option>Detailing Mobil</option></select></div>
    <div><label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wide mb-1">Jam</label><input id="edit-antrian-jam" class="w-full bg-sg-bg border border-sg-border rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-sg-blue" type="time"></div>
  </div>
  <div class="flex gap-2 px-6 py-4 border-t border-sg-border">
    <button class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-4 py-2 text-sm" onclick="closeModal()">Batal</button>
    <button class="bg-sg-blue text-white font-semibold rounded-xl px-4 py-2 text-sm hover:bg-sg-bluedk transition-colors" onclick="saveEditAntrian()">Simpan</button>
  </div>
</div>

<div id="modal-topbar-search" class="modal-panel hidden fixed z-[2001] top-16 left-1/2 -translate-x-1/2 w-full max-w-xl bg-white rounded-2xl shadow-2xl">
  <div class="flex items-center gap-2 px-4 py-3 border-b border-sg-border">
    <i class="bi bi-search text-sg-sub"></i>
    <input id="topbar-search-input" class="flex-1 bg-transparent border-none text-sm focus:outline-none placeholder-sg-sub" placeholder="Cari pesanan, pelanggan, antrian..." oninput="searchTopbar(this.value)">
    <button class="text-xs text-sg-sub hover:text-sg-text font-medium" onclick="closeModal()">Tutup</button>
  </div>
  <div id="topbar-search-results" class="p-3 max-h-80 overflow-y-auto">
    <div class="text-center text-sg-sub text-sm py-4">Ketik untuk mencari...</div>
  </div>
</div>

<div id="sg-toast" class="fixed bottom-5 right-5 z-[3000] bg-sg-navy text-white px-4 py-3 rounded-xl font-semibold text-sm shadow-xl hidden transition-all">
  <span id="toast-msg">Berhasil!</span>
</div>