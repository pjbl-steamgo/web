@php
    // ==========================================
    // ALGORITMA SMART GROUPING (DINAMIS)
    // ==========================================
    $dataLayanan = collect($layanans ?? []);
    $groupedServices = [];

    foreach ($dataLayanan as $layanan) {
        // Hapus embel-embel motor/mobil untuk mendapatkan nama dasar (Grup)
        $baseName = trim(str_ireplace([' motor', ' mobil', '-motor', '-mobil'], '', $layanan->nama_layanan));
        $baseName = ucwords(strtolower($baseName));

        // Buat kerangka grup jika belum ada
        if (!isset($groupedServices[$baseName])) {
            $lowerName = strtolower($baseName);
            // Penentuan Warna & Ikon
            if (str_contains($lowerName, 'steam')) {
                $icon = 'bi-droplet-fill'; $color = 'text-[#A855F7] bg-[#F3E8FF]'; 
            } elseif (str_contains($lowerName, 'snow')) {
                $icon = 'bi-snow'; $color = 'text-[#06B6D4] bg-[#ECFEFF]'; 
            } elseif (str_contains($lowerName, 'detail')) {
                $icon = 'bi-stars'; $color = 'text-[#F59E0B] bg-[#FEF3C7]'; 
            } else {
                $icon = 'bi-tools'; $color = 'text-[#3B82F6] bg-[#EFF6FF]'; 
            }

            $groupedServices[$baseName] = [
                'title'         => $baseName,
                'icon'          => $icon,
                'color'         => $color,
                'total_pesanan' => 0,
                'motor'         => null,
                'mobil'         => null,
            ];
        }

        // Tambahkan statistik pesanan ke total grup
        $count = $layanan->pesanans_count ?? 0;
        $groupedServices[$baseName]['total_pesanan'] += $count;

        // Masukkan data ke kategori yang sesuai
        if (strtolower($layanan->kategori) === 'motor') {
            $groupedServices[$baseName]['motor'] = $layanan;
        } else {
            $groupedServices[$baseName]['mobil'] = $layanan;
        }
    }
@endphp

<div class="page {{ ($initPage ?? '') === 'layanan' ? 'active' : '' }}" id="page-layanan">
  
  @if($errors->any())
    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm flex justify-between items-start">
      <div>
        <h3 class="text-red-800 font-bold text-sm mb-1">Gagal Menyimpan Layanan!</h3>
        <ul class="text-red-600 text-[13px] list-disc list-inside">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      <button onclick="this.parentElement.style.display='none'" class="text-red-400 hover:text-red-600 font-bold transition-colors">
        <i class="bi bi-x-lg"></i>
      </button>
    </div>
  @endif

  @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-xl shadow-sm flex justify-between items-start">
      <div>
        <h3 class="text-green-800 font-bold text-sm">{{ session('success') }}</h3>
      </div>
      <button onclick="this.parentElement.style.display='none'" class="text-green-400 hover:text-green-600 font-bold transition-colors">
        <i class="bi bi-x-lg"></i>
      </button>
    </div>
  @endif

  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">   
    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
      <div class="relative flex-grow sm:flex-grow-0">
        <input type="text" id="layanan-search" class="w-full sm:w-64 bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue shadow-sm" placeholder="🔍 Cari nama layanan..." oninput="searchLayanan()">
      </div>
      <button class="bg-[#2563EB] hover:bg-blue-700 text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex items-center justify-center transition-colors shadow-sm whitespace-nowrap" onclick="openModal('modal-tambah-layanan')">
        <i class="bi bi-plus-lg mr-2"></i> Tambah Layanan
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" id="layanan-grid">
    
    @forelse($groupedServices as $svc)
      <div class="bg-white rounded-2xl border border-sg-border shadow-sm flex flex-col overflow-hidden layanan-group-card">
        
        <div class="p-5 border-b border-sg-border flex justify-between items-center bg-[#FAFBFD]">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl {{ $svc['color'] }} flex items-center justify-center text-[22px] flex-shrink-0 shadow-sm">
              <i class="bi {{ $svc['icon'] }}"></i>
            </div>
            <div>
              <h3 class="font-display font-bold text-[17px] text-sg-text">{{ $svc['title'] }}</h3>
              <p class="text-[12px] text-sg-sub flex items-center gap-1.5 mt-0.5">
                <i class="bi bi-graph-up-arrow"></i> Total Dipesan: <strong class="text-sg-text">{{ $svc['total_pesanan'] }} kali</strong>
              </p>
            </div>
          </div>
        </div>

        <div class="divide-y divide-sg-border flex-grow flex flex-col">
          
          @php 
            $itemMotor = $svc['motor']; 
            $isActiveMtr = $itemMotor ? ($itemMotor->is_active ?? true) : false;
          @endphp
          
          <div class="p-5 flex-1 flex flex-col {{ $itemMotor && !$isActiveMtr ? 'bg-red-50/20 grayscale-[15%]' : '' }}">
            <div class="flex justify-between items-center mb-3">
              <div class="font-bold text-[14px] text-sg-text flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-sm">
                  <i class="bi bi-bicycle"></i>
                </div>
                Kategori Motor
              </div>
              @if($itemMotor)
                @if($isActiveMtr)
                  <span class="px-2.5 py-1 bg-[#DCFCE7] text-[#16A34A] text-[10px] font-bold rounded-md uppercase tracking-wider">Aktif</span>
                @else
                  <span class="px-2.5 py-1 bg-red-100 text-red-600 text-[10px] font-bold rounded-md uppercase tracking-wider">Tutup</span>
                @endif
              @endif
            </div>

            @if($itemMotor)
              <p class="text-[12px] text-sg-sub leading-relaxed mb-4 text-justify break-words">
                {{ $itemMotor->deskripsi }}
              </p>

              <div class="grid grid-cols-2 gap-2.5 mb-5 flex-grow">
                <div class="bg-white border border-sg-border/60 rounded-xl p-3 shadow-sm">
                  <div class="text-[10px] font-bold text-sg-sub uppercase mb-1">Harga Layanan</div>
                  <div class="font-bold text-[14px] text-sg-blue">Rp {{ number_format($itemMotor->harga, 0, ',', '.') }}</div>
                </div>
                <div class="bg-white border border-sg-border/60 rounded-xl p-3 shadow-sm">
                  <div class="text-[10px] font-bold text-sg-sub uppercase mb-1">Waktu (Menit)</div>
                  <div class="font-bold text-[14px] text-sg-text">{{ $itemMotor->estimasi_waktu }} Min</div>
                </div>
                <div class="col-span-2 bg-white border border-sg-border/60 rounded-xl p-3 shadow-sm flex justify-between items-center">
                  <div class="text-[10px] font-bold text-sg-sub uppercase">Dipesan Bulan Ini</div>
                  <div class="font-bold text-[13px] text-sg-text"><span class="text-sg-blue">{{ $itemMotor->pesanans_count ?? 0 }}</span> kali</div>
                </div>
              </div>

              <div class="flex gap-2 mt-auto">
                <button class="flex-1 bg-white border border-sg-border text-sg-sub hover:text-sg-blue hover:border-sg-blue hover:shadow-sm rounded-xl py-2 text-[12px] font-bold transition-all flex items-center justify-center gap-2"
                        data-id="{{ $itemMotor->id }}" 
                        data-nama="{{ $itemMotor->nama_layanan }}" 
                        data-kategori="{{ $itemMotor->kategori }}" 
                        data-harga="{{ $itemMotor->harga }}" 
                        data-estimasi="{{ $itemMotor->estimasi_waktu }}" 
                        data-deskripsi="{{ $itemMotor->deskripsi }}"
                        onclick="openEditLayananModal(this)">
                  <i class="bi bi-pencil-square text-sm"></i> Edit Data
                </button>
                
                <button class="w-10 h-10 bg-white border border-sg-border rounded-xl flex items-center justify-center transition-all flex-shrink-0 {{ $isActiveMtr ? 'text-sg-green hover:bg-[#DCFCE7] hover:border-green-300' : 'text-red-500 hover:bg-red-50 hover:border-red-300' }}"
                        data-url="{{ route('layanan.toggle', $itemMotor->id) }}" 
                        data-nama="{{ $itemMotor->nama_layanan }}" 
                        data-status="{{ $isActiveMtr ? 'aktif' : 'tidak_aktif' }}"
                        onclick="openToggleLayananModal(this)" title="Buka/Tutup">
                  <i class="bi {{ $isActiveMtr ? 'bi-toggle-on' : 'bi-toggle-off' }} text-[20px]"></i>
                </button>
                
                <button class="w-10 h-10 bg-white border border-sg-border text-sg-red hover:bg-red-50 hover:border-red-200 rounded-xl flex items-center justify-center transition-all flex-shrink-0"
                        data-url="{{ route('layanan.destroy', $itemMotor->id) }}" 
                        data-nama="{{ $itemMotor->nama_layanan }}"
                        onclick="openDeleteLayananModal(this)" title="Hapus Layanan">
                  <i class="bi bi-trash text-[16px]"></i>
                </button>
              </div>
            @else
              <div class="flex-grow flex flex-col items-center justify-center border-2 border-dashed border-sg-border rounded-xl bg-gray-50/50 p-4 text-center mt-2">
                <p class="text-[12px] text-sg-sub mb-2">Data Motor belum ada.</p>
                <button type="button" class="text-[11px] font-bold text-[#2563EB] hover:underline" onclick="openModal('modal-tambah-layanan')">
                  + Tambah Data Motor
                </button>
              </div>
            @endforelse
          </div>

          @php 
            $itemMobil = $svc['mobil']; 
            $isActiveMbl = $itemMobil ? ($itemMobil->is_active ?? true) : false;
          @endphp

          <div class="p-5 flex-1 flex flex-col {{ $itemMobil && !$isActiveMbl ? 'bg-red-50/20 grayscale-[15%]' : '' }}">
            <div class="flex justify-between items-center mb-3">
              <div class="font-bold text-[14px] text-sg-text flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-sm">
                  <i class="bi bi-car-front-fill"></i>
                </div>
                Kategori Mobil
              </div>
              @if($itemMobil)
                @if($isActiveMbl)
                  <span class="px-2.5 py-1 bg-[#DCFCE7] text-[#16A34A] text-[10px] font-bold rounded-md uppercase tracking-wider">Aktif</span>
                @else
                  <span class="px-2.5 py-1 bg-red-100 text-red-600 text-[10px] font-bold rounded-md uppercase tracking-wider">Tutup</span>
                @endif
              @endif
            </div>

            @if($itemMobil)
              <p class="text-[12px] text-sg-sub leading-relaxed mb-4 text-justify break-words">
                {{ $itemMobil->deskripsi }}
              </p>

              <div class="grid grid-cols-2 gap-2.5 mb-5 flex-grow">
                <div class="bg-white border border-sg-border/60 rounded-xl p-3 shadow-sm">
                  <div class="text-[10px] font-bold text-sg-sub uppercase mb-1">Harga Layanan</div>
                  <div class="font-bold text-[14px] text-sg-blue">Rp {{ number_format($itemMobil->harga, 0, ',', '.') }}</div>
                </div>
                <div class="bg-white border border-sg-border/60 rounded-xl p-3 shadow-sm">
                  <div class="text-[10px] font-bold text-sg-sub uppercase mb-1">Waktu (Menit)</div>
                  <div class="font-bold text-[14px] text-sg-text">{{ $itemMobil->estimasi_waktu }} Min</div>
                </div>
                <div class="col-span-2 bg-white border border-sg-border/60 rounded-xl p-3 shadow-sm flex justify-between items-center">
                  <div class="text-[10px] font-bold text-sg-sub uppercase">Dipesan Bln Ini</div>
                  <div class="font-bold text-[13px] text-sg-text"><span class="text-sg-blue">{{ $itemMobil->pesanans_count ?? 0 }}</span> kali</div>
                </div>
              </div>

              <div class="flex gap-2 mt-auto">
                <button class="flex-1 bg-white border border-sg-border text-sg-sub hover:text-sg-blue hover:border-sg-blue hover:shadow-sm rounded-xl py-2 text-[12px] font-bold transition-all flex items-center justify-center gap-2"
                        data-id="{{ $itemMobil->id }}" 
                        data-nama="{{ $itemMobil->nama_layanan }}" 
                        data-kategori="{{ $itemMobil->kategori }}" 
                        data-harga="{{ $itemMobil->harga }}" 
                        data-estimasi="{{ $itemMobil->estimasi_waktu }}" 
                        data-deskripsi="{{ $itemMobil->deskripsi }}"
                        onclick="openEditLayananModal(this)">
                  <i class="bi bi-pencil-square text-sm"></i> Edit Data
                </button>
                
                <button class="w-10 h-10 bg-white border border-sg-border rounded-xl flex items-center justify-center transition-all flex-shrink-0 {{ $isActiveMbl ? 'text-sg-green hover:bg-[#DCFCE7] hover:border-green-300' : 'text-red-500 hover:bg-red-50 hover:border-red-300' }}"
                        data-url="{{ route('layanan.toggle', $itemMobil->id) }}" 
                        data-nama="{{ $itemMobil->nama_layanan }}" 
                        data-status="{{ $isActiveMbl ? 'aktif' : 'tidak_aktif' }}"
                        onclick="openToggleLayananModal(this)" title="Buka/Tutup">
                  <i class="bi {{ $isActiveMbl ? 'bi-toggle-on' : 'bi-toggle-off' }} text-[20px]"></i>
                </button>
                
                <button class="w-10 h-10 bg-white border border-sg-border text-sg-red hover:bg-red-50 hover:border-red-200 rounded-xl flex items-center justify-center transition-all flex-shrink-0"
                        data-url="{{ route('layanan.destroy', $itemMobil->id) }}" 
                        data-nama="{{ $itemMobil->nama_layanan }}"
                        onclick="openDeleteLayananModal(this)" title="Hapus Layanan">
                  <i class="bi bi-trash text-[16px]"></i>
                </button>
              </div>
            @else
              <div class="flex-grow flex flex-col items-center justify-center border-2 border-dashed border-sg-border rounded-xl bg-gray-50/50 p-4 text-center mt-2">
                <p class="text-[12px] text-sg-sub mb-2">Data Mobil belum ada.</p>
                <button type="button" class="text-[11px] font-bold text-[#2563EB] hover:underline" onclick="openModal('modal-tambah-layanan')">
                  + Tambah Data Mobil
                </button>
              </div>
            @endif
          </div>

        </div>
      </div>
    @empty
      <div class="col-span-full bg-white border border-sg-border rounded-2xl p-10 text-center shadow-sm">
        <div class="text-sg-sub text-4xl mb-3">📂</div>
        <p class="text-sg-text font-bold text-base mb-1">Belum Ada Data Layanan</p>
        <p class="text-sg-sub text-sm">Gunakan tombol "Tambah Layanan" untuk mulai menambahkan layanan baru.</p>
      </div>
    @endforelse

    <div id="search-empty-state" class="col-span-full bg-white border border-sg-border rounded-2xl p-10 text-center shadow-sm hidden">
      <div class="text-sg-sub text-4xl mb-3">🔍</div>
      <p class="text-sg-text font-bold text-base mb-1">Layanan tidak ditemukan</p>
      <p class="text-sg-sub text-sm">Coba gunakan kata kunci pencarian yang lain.</p>
    </div>

  </div>
</div>

<div id="modal-hapus-layanan" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] sm:w-full max-w-sm bg-white rounded-2xl shadow-2xl mx-auto">
  <form id="form-hapus-layanan" method="POST">
    @csrf
    @method('DELETE')
    <div class="p-6 text-center">
      <div class="w-16 h-16 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 bg-red-100 text-red-600">
        <i class="bi bi-trash"></i>
      </div>
      <h5 class="font-display font-bold text-[19px] mb-2">Hapus Layanan?</h5>
      <p class="text-sm text-sg-sub mb-6">
        Layanan <strong id="hapus-nama-layanan" class="text-sg-text"></strong> akan dihapus secara permanen dari database. Tindakan ini tidak dapat dibatalkan.
      </p>
      <div class="flex gap-2 justify-center">
        <button type="button" class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-gray-50 transition-colors" onclick="closeModal()">Batal</button>
        <button type="submit" class="bg-red-500 text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-red-600 transition-colors">Ya, Hapus</button>
      </div>
    </div>
  </form>
</div>

<div id="modal-toggle-layanan" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] sm:w-full max-w-sm bg-white rounded-2xl shadow-2xl mx-auto">
  <form id="form-toggle-layanan" method="POST">
    @csrf
    <div class="p-6 text-center">
      <div id="toggle-icon-container">
        <i id="toggle-icon"></i>
      </div>
      <h5 id="toggle-title" class="font-display font-bold text-[19px] mb-2"></h5>
      <p class="text-sm text-sg-sub mb-6">
        Apakah Anda yakin ingin <strong id="toggle-action-text" class="text-sg-text"></strong> <span id="toggle-nama-layanan"></span> untuk sementara waktu?
      </p>
      <div class="flex gap-2 justify-center">
        <button type="button" class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-gray-50 transition-colors" onclick="closeModal('modal-toggle-layanan')">Batal</button>
        <button type="submit" id="toggle-submit-btn"></button>
      </div>
    </div>
  </form>
</div>

<script>
  function searchLayanan() {
      const keyword = document.getElementById('layanan-search').value.toLowerCase();
      const cards = document.querySelectorAll('.layanan-group-card');
      const emptyState = document.getElementById('search-empty-state');
      let visibleCount = 0;

      cards.forEach(card => {
          const namaLayanan = card.querySelector('h3').innerText.toLowerCase();
          
          if (namaLayanan.includes(keyword)) {
              card.style.display = 'flex'; 
              visibleCount++;
          } else {
              card.style.display = 'none'; 
          }
      });

      if (cards.length > 0) {
          if (visibleCount === 0) {
              emptyState.style.display = 'block';
          } else {
              emptyState.style.display = 'none';
          }
      }
  }

  function openEditLayananModal(button) {
      const id = button.getAttribute('data-id');
      const nama = button.getAttribute('data-nama');
      const kategori = button.getAttribute('data-kategori');
      const harga = button.getAttribute('data-harga');
      const textEstimasi = button.getAttribute('data-estimasi');
      const deskripsi = button.getAttribute('data-deskripsi');

      const form = document.getElementById('form-edit-layanan');
      if(form) form.action = `/layanan/${id}`;

      if(document.getElementById('edit-nama-layanan')) document.getElementById('edit-nama-layanan').value = nama;
      
      const selectKategori = document.getElementById('edit-kategori');
      if (selectKategori) {
          for (let i = 0; i < selectKategori.options.length; i++) {
              if (selectKategori.options[i].value.toLowerCase() === kategori.toLowerCase()) {
                  selectKategori.selectedIndex = i;
                  break;
              }
          }
      }

      if(document.getElementById('edit-harga')) document.getElementById('edit-harga').value = harga;
      if(document.getElementById('edit-estimasi')) document.getElementById('edit-estimasi').value = textEstimasi;
      if(document.getElementById('edit-deskripsi')) document.getElementById('edit-deskripsi').value = deskripsi;

      openModal('modal-edit-layanan');
  }

  function openToggleLayananModal(button) {
      const url = button.getAttribute('data-url');
      const nama = button.getAttribute('data-nama');
      const status = button.getAttribute('data-status'); 

      document.getElementById('form-toggle-layanan').action = url;
      document.getElementById('toggle-nama-layanan').innerText = nama;

      const titleEl = document.getElementById('toggle-title');
      const actionTextEl = document.getElementById('toggle-action-text');
      const iconContainer = document.getElementById('toggle-icon-container');
      const iconEl = document.getElementById('toggle-icon');
      const submitBtn = document.getElementById('toggle-submit-btn');

      if (status === 'aktif') {
          titleEl.innerText = "Tutup Layanan?";
          actionTextEl.innerText = "menutup";
          iconContainer.className = "w-16 h-16 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 bg-red-100 text-red-600";
          iconEl.className = "bi bi-toggle-off";
          submitBtn.className = "bg-red-500 text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-red-600 transition-colors";
          submitBtn.innerText = "Ya, Tutup";
      } else {
          titleEl.innerText = "Buka Layanan?";
          actionTextEl.innerText = "membuka";
          iconContainer.className = "w-16 h-16 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 bg-[#DCFCE7] text-[#16A34A]";
          iconEl.className = "bi bi-toggle-on";
          submitBtn.className = "bg-[#16A34A] text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-green-700 transition-colors";
          submitBtn.innerText = "Ya, Buka";
      }

      openModal('modal-toggle-layanan');
  }

  function openDeleteLayananModal(button) {
      const url = button.getAttribute('data-url');
      const nama = button.getAttribute('data-nama');

      document.getElementById('form-hapus-layanan').action = url;
      document.getElementById('hapus-nama-layanan').innerText = nama;

      openModal('modal-hapus-layanan');
  }
  
  function closeModal(modalId) {
      const modal = document.getElementById(modalId);
      if(modal) {
          modal.classList.add('hidden');
      } else {
          document.querySelectorAll('.modal-panel').forEach(m => m.classList.add('hidden'));
      }
  }
</script>