<div class="page {{ ($initPage ?? '') === 'layanan' ? 'active' : '' }}" id="page-layanan">
  
  <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-6">
    <div class="flex-1 w-full sm:max-w-xs">
      <input id="layanan-search" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue focus:ring-1 focus:ring-sg-blue transition-all shadow-sm" placeholder="🔍 Cari layanan..." oninput="searchLayanan()">
    </div>
    <button class="bg-sg-blue text-white font-semibold rounded-xl px-5 py-2.5 text-sm hover:bg-sg-bluedk transition-all shadow-sm flex items-center justify-center w-full sm:w-auto" onclick="openModal('modal-tambah-layanan')">
      <i class="bi bi-plus-lg mr-2"></i> Tambah Layanan
    </button>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 lg:gap-5" id="layanan-grid">
    
    <div class="bg-white rounded-2xl border border-sg-border shadow-sm hover:shadow-md transition-shadow p-5 flex flex-col relative overflow-hidden group">
      <div class="flex items-start justify-between mb-4">
        <div class="w-12 h-12 rounded-xl bg-sg-bluelt text-sg-blue flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 transition-transform">
          <i class="bi bi-droplet-fill"></i>
        </div>
        <span class="inline-flex items-center gap-1.5 text-[10px] font-bold px-2.5 py-1 rounded-full bg-sg-bluelt text-sg-blue uppercase tracking-wider">
          Motor
        </span>
      </div>
      
      <h3 class="font-display font-bold text-[17px] text-sg-text mb-1">Snow Wash Motor</h3>
      <p class="text-[12.5px] text-sg-sub font-medium mb-5 flex-grow leading-relaxed">Cuci salju seluruh bodi motor, semir ban, dan pembersihan area mesin ringan.</p>
      
      <div class="grid grid-cols-2 gap-3 mb-5">
        <div class="bg-[#FAFBFD] border border-sg-border/50 rounded-xl p-3">
          <div class="text-[10px] font-bold text-sg-sub uppercase tracking-wide">Estimasi Waktu</div>
          <div class="font-semibold text-[13px] text-sg-text mt-1">~30 Menit</div>
        </div>
        <div class="bg-[#FAFBFD] border border-sg-border/50 rounded-xl p-3">
          <div class="text-[10px] font-bold text-sg-sub uppercase tracking-wide">Harga</div>
          <div class="font-bold text-[14px] text-sg-blue mt-1">Rp 25.000</div>
        </div>
      </div>
      
      <div class="flex gap-2 pt-4 border-t border-sg-border">
        <button class="flex-1 bg-white border border-sg-border text-sg-sub hover:text-sg-blue hover:border-sg-blue rounded-xl py-2 text-sm font-semibold transition-colors flex items-center justify-center gap-2" onclick="openModal('modal-edit-layanan')">
          <i class="bi bi-pencil-square"></i> Edit
        </button>
        <button class="w-11 h-11 bg-white border border-sg-border text-sg-red hover:bg-sg-redlt hover:border-sg-redlt rounded-xl flex items-center justify-center transition-colors flex-shrink-0" title="Hapus">
          <i class="bi bi-trash"></i>
        </button>
      </div>
    </div>

    <div class="bg-white rounded-2xl border border-sg-border shadow-sm hover:shadow-md transition-shadow p-5 flex flex-col relative overflow-hidden group">
      <div class="flex items-start justify-between mb-4">
        <div class="w-12 h-12 rounded-xl bg-sg-bluelt text-sg-blue flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 transition-transform">
          <i class="bi bi-droplet-fill"></i>
        </div>
        <span class="inline-flex items-center gap-1.5 text-[10px] font-bold px-2.5 py-1 rounded-full bg-sg-bluelt text-sg-blue uppercase tracking-wider">
          Mobil
        </span>
      </div>
      
      <h3 class="font-display font-bold text-[17px] text-sg-text mb-1">Snow Wash Mobil</h3>
      <p class="text-[12.5px] text-sg-sub font-medium mb-5 flex-grow leading-relaxed">Pencucian bodi mobil dengan sampo salju khusus, vacuum interior, dan semir ban.</p>
      
      <div class="grid grid-cols-2 gap-3 mb-5">
        <div class="bg-[#FAFBFD] border border-sg-border/50 rounded-xl p-3">
          <div class="text-[10px] font-bold text-sg-sub uppercase tracking-wide">Estimasi Waktu</div>
          <div class="font-semibold text-[13px] text-sg-text mt-1">~45 Menit</div>
        </div>
        <div class="bg-[#FAFBFD] border border-sg-border/50 rounded-xl p-3">
          <div class="text-[10px] font-bold text-sg-sub uppercase tracking-wide">Harga</div>
          <div class="font-bold text-[14px] text-sg-blue mt-1">Rp 60.000</div>
        </div>
      </div>
      
      <div class="flex gap-2 pt-4 border-t border-sg-border">
        <button class="flex-1 bg-white border border-sg-border text-sg-sub hover:text-sg-blue hover:border-sg-blue rounded-xl py-2 text-sm font-semibold transition-colors flex items-center justify-center gap-2" onclick="openModal('modal-edit-layanan')">
          <i class="bi bi-pencil-square"></i> Edit
        </button>
        <button class="w-11 h-11 bg-white border border-sg-border text-sg-red hover:bg-sg-redlt hover:border-sg-redlt rounded-xl flex items-center justify-center transition-colors flex-shrink-0" title="Hapus">
          <i class="bi bi-trash"></i>
        </button>
      </div>
    </div>

    <div class="bg-white rounded-2xl border border-sg-border shadow-sm hover:shadow-md transition-shadow p-5 flex flex-col relative overflow-hidden group">
      <div class="flex items-start justify-between mb-4">
        <div class="w-12 h-12 rounded-xl bg-sg-greenlt text-sg-green flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 transition-transform">
          <i class="bi bi-stars"></i>
        </div>
        <span class="inline-flex items-center gap-1.5 text-[10px] font-bold px-2.5 py-1 rounded-full bg-sg-greenlt text-sg-green uppercase tracking-wider">
          Detailing
        </span>
      </div>
      
      <h3 class="font-display font-bold text-[17px] text-sg-text mb-1">Detailing Mobil</h3>
      <p class="text-[12.5px] text-sg-sub font-medium mb-5 flex-grow leading-relaxed">Pembersihan jamur kaca, poles bodi menghilangkan baret halus, dan wax proteksi.</p>
      
      <div class="grid grid-cols-2 gap-3 mb-5">
        <div class="bg-[#FAFBFD] border border-sg-border/50 rounded-xl p-3">
          <div class="text-[10px] font-bold text-sg-sub uppercase tracking-wide">Estimasi Waktu</div>
          <div class="font-semibold text-[13px] text-sg-text mt-1">~120 Menit</div>
        </div>
        <div class="bg-[#FAFBFD] border border-sg-border/50 rounded-xl p-3">
          <div class="text-[10px] font-bold text-sg-sub uppercase tracking-wide">Harga</div>
          <div class="font-bold text-[14px] text-sg-green mt-1">Rp 350.000</div>
        </div>
      </div>
      
      <div class="flex gap-2 pt-4 border-t border-sg-border">
        <button class="flex-1 bg-white border border-sg-border text-sg-sub hover:text-sg-blue hover:border-sg-blue rounded-xl py-2 text-sm font-semibold transition-colors flex items-center justify-center gap-2" onclick="openModal('modal-edit-layanan')">
          <i class="bi bi-pencil-square"></i> Edit
        </button>
        <button class="w-11 h-11 bg-white border border-sg-border text-sg-red hover:bg-sg-redlt hover:border-sg-redlt rounded-xl flex items-center justify-center transition-colors flex-shrink-0" title="Hapus">
          <i class="bi bi-trash"></i>
        </button>
      </div>
    </div>

  </div>
</div>```