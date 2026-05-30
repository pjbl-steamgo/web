<div class="page {{ ($initPage ?? '') === 'pelanggan' ? 'active' : 'hidden' }}" id="page-pelanggan">
  
  <div class="mb-6">
    <h2 class="text-xl font-display font-bold text-sg-text">Manajemen Akun Pelanggan</h2>
    <p class="text-sm text-sg-sub mt-1">Simulator pembuatan akun user (mobile) serta daftar tingkatan member pelanggan.</p>
  </div>

  @if(session('success'))
    <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2 shadow-sm">
      <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    </div>
  @endif

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <div class="bg-white border border-sg-border rounded-2xl shadow-sm p-5 h-fit">
      <h3 class="text-sm font-bold text-sg-text uppercase tracking-wider mb-4 pb-2 border-b border-sg-border flex items-center gap-2">
        <i class="bi bi-person-plus text-base text-sg-blue"></i> Buat Akun Baru
      </h3>

      <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <div>
          <label class="block text-[11px] font-bold text-sg-sub uppercase tracking-wider mb-1.5">ID User</label>
          <input type="text" class="w-full bg-gray-50 border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-sub cursor-not-allowed font-mono" value="[ Otomatis Tergenerate Sistem ]" disabled>
        </div>

        <div>
          <label for="username" class="block text-[11px] font-bold text-sg-sub uppercase tracking-wider mb-1.5">Username <span class="text-red-500">*</span></label>
          <input type="text" name="username" id="username" required placeholder="Contoh: fazanew" value="{{ old('username') }}" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue transition-colors">
          @error('username') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
        </div>

        <div>
          <label for="no_hp" class="block text-[11px] font-bold text-sg-sub uppercase tracking-wider mb-1.5">No. Handphone <span class="text-red-500">*</span></label>
          <input type="tel" name="no_hp" id="no_hp" required placeholder="Contoh: 08123456789" value="{{ old('no_hp') }}" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue transition-colors">
          @error('no_hp') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
        </div>

        <div>
          <label for="email" class="block text-[11px] font-bold text-sg-sub uppercase tracking-wider mb-1.5">Alamat Email <span class="text-red-500">*</span></label>
          <input type="email" name="email" id="email" required placeholder="name@example.com" value="{{ old('email') }}" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue transition-colors">
          @error('email') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
        </div>

        <div>
          <label for="password" class="block text-[11px] font-bold text-sg-sub uppercase tracking-wider mb-1.5">Password <span class="text-red-500">*</span></label>
          <input type="password" name="password" id="password" required placeholder="Minimal 6 karakter" class="w-full bg-white border border-sg-border rounded-xl px-4 py-2.5 text-sm text-sg-text focus:outline-none focus:border-sg-blue transition-colors">
          @error('password') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
        </div>

        <div>
          <label for="foto_profil" class="block text-[11px] font-bold text-sg-sub uppercase tracking-wider mb-1.5">Foto Profil</label>
          <input type="file" name="foto_profil" id="foto_profil" accept="image/*" class="w-full text-sm text-sg-sub file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-sg-blue hover:file:bg-blue-100 border border-sg-border rounded-xl p-1.5 bg-white">
          @error('foto_profil') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
        </div>

        <div class="bg-blue-50/50 border border-blue-100 p-3 rounded-xl text-xs text-sg-sub">
          <i class="bi bi-info-circle text-sg-blue"></i> Akun baru otomatis berstatus member <strong class="text-sg-blue">Silver</strong> (0 total pesanan).
        </div>

        <button type="submit" class="w-full bg-sg-blue hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl text-sm transition-colors shadow-sm flex items-center justify-center gap-2">
          <i class="bi bi-cloud-upload"></i> Daftarkan User Baru
        </button>
      </form>
    </div>

    <div class="bg-white border border-sg-border rounded-2xl shadow-sm p-5 lg:col-span-2 overflow-hidden flex flex-col">
      <h3 class="text-sm font-bold text-sg-text uppercase tracking-wider mb-4 pb-2 border-b border-sg-border flex items-center gap-2">
        <i class="bi bi-people text-base text-sg-blue"></i> Database Akun Terdaftar
      </h3>

      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="text-[11px] font-bold text-sg-sub uppercase tracking-wider border-b border-sg-border bg-[#FAFBFD]">
              <th class="px-4 py-3">User</th>
              <th class="px-4 py-3">Kontak & Email</th>
              <th class="px-4 py-3 text-center">Total Order</th>
              <th class="px-4 py-3 text-right">Tier Member</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-sg-border">
            @forelse ($pelanggans ?? [] as $pelanggan)
              @php
                // Proteksi nilai pesanan jika kosong di mongo
                $totalPesanan = $pelanggan->jumlah_pesanan ?? 0;
                
                // Menghitung & memvalidasi tingkatan tier member secara dinamis
                if ($totalPesanan >= 40) {
                    $tier = 'Diamond';
                    $badgeStyle = 'bg-cyan-50 text-cyan-600 border-cyan-200';
                } elseif ($totalPesanan >= 10 && $totalPesanan <= 39) {
                    $tier = 'Gold';
                    $badgeStyle = 'bg-amber-50 text-amber-600 border-amber-200';
                } else {
                    $tier = 'Silver';
                    $badgeStyle = 'bg-slate-100 text-slate-600 border-slate-200';
                }
              @endphp
              <tr class="hover:bg-gray-50 transition-colors text-sm">
                <td class="px-4 py-3 whitespace-nowrap">
                  <div class="flex items-center gap-3">
                    @if(!empty($pelanggan->foto_profil))
                      <img src="{{ asset('storage/' . $pelanggan->foto_profil) }}" alt="Avatar" class="w-9 h-9 rounded-full object-cover border border-sg-border">
                    @else
                      <div class="w-9 h-9 rounded-full bg-blue-100 text-sg-blue flex items-center justify-center font-bold text-sm uppercase">
                        {{ substr($pelanggan->username, 0, 2) }}
                      </div>
                    @endif
                    <div>
                      <div class="font-bold text-sg-text">{{ $pelanggan->username }}</div>
                      <div class="text-[11px] font-mono text-sg-sub mt-0.5">{{ $pelanggan->user_id }}</div>
                    </div>
                  </div>
                </td>

                <td class="px-4 py-3 whitespace-nowrap">
                  <div class="text-sg-text font-medium">{{ $pelanggan->no_hp }}</div>
                  <div class="text-[12px] text-sg-sub mt-0.5">{{ $pelanggan->email }}</div>
                </td>

                <td class="px-4 py-3 whitespace-nowrap text-center font-bold text-sg-text">
                  {{ $totalPesanan }} <span class="text-xs font-normal text-sg-sub">kali</span>
                </td>

                <td class="px-4 py-3 whitespace-nowrap text-right">
                  <span class="inline-flex px-2.5 py-1 rounded-full text-[11px] font-black uppercase border tracking-wider {{ $badgeStyle }}">
                    <i class="bi bi-gem mr-1"></i> {{ $tier }}
                  </span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="px-4 py-10 text-center text-sg-sub text-xs">
                  Belum ada data pelanggan yang terdaftar.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>