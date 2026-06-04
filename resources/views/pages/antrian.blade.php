<div class="page {{ in_array($initPage ?? '', ['antrian', 'antrian-jadwal']) ? 'active' : '' }}" id="page-antrian-jadwal">
  
  <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
    
    <div class="grid grid-cols-2 md:flex md:flex-wrap gap-3 w-full lg:w-auto">
      
      {{-- ============================================================ --}}
      {{-- FILTER TANGGAL - Custom pill dengan navigasi prev/next hari  --}}
      {{-- ============================================================ --}}
      <div class="col-span-2 md:col-span-1 relative flex items-center gap-1 bg-white border border-sg-border rounded-xl shadow-sm px-1 py-[5px]">
        
        {{-- Tombol prev hari --}}
        <button type="button" onclick="shiftTanggal(-1)"
          class="w-8 h-8 flex items-center justify-center rounded-lg text-sg-sub hover:bg-gray-100 hover:text-sg-text transition-colors flex-shrink-0"
          title="Hari sebelumnya">
          <i class="bi bi-chevron-left text-[13px]"></i>
        </button>

        {{-- Label klik → buka native date picker --}}
        <button type="button" onclick="document.getElementById('filter-tanggal').showPicker()"
          class="flex items-center gap-2 px-2 py-1 rounded-lg hover:bg-gray-50 transition-colors min-w-[130px] justify-center">
          <i class="bi bi-calendar3 text-[#2563EB] text-[14px]"></i>
          <span id="label-tanggal" class="text-sm font-semibold text-sg-text whitespace-nowrap"></span>
        </button>

        {{-- Input date aslinya, disembunyikan tapi tetap bisa showPicker() --}}
        <input type="date" id="filter-tanggal"
          class="absolute opacity-0 w-0 h-0 pointer-events-none"
          value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d') }}"
          onchange="onTanggalChange()">

        {{-- Tombol next hari --}}
        <button type="button" onclick="shiftTanggal(1)"
          class="w-8 h-8 flex items-center justify-center rounded-lg text-sg-sub hover:bg-gray-100 hover:text-sg-text transition-colors flex-shrink-0"
          title="Hari berikutnya">
          <i class="bi bi-chevron-right text-[13px]"></i>
        </button>

      </div>
      
      {{-- ============================================================ --}}
      {{-- FILTER STATUS - Custom dropdown pill                        --}}
      {{-- ============================================================ --}}
      <div class="relative" id="wrapper-filter-status">
        <button type="button"
          onclick="toggleDropdown('dropdown-status')"
          class="flex items-center gap-2 bg-white border border-sg-border rounded-xl px-3 py-2 text-sm shadow-sm hover:bg-gray-50 transition-colors w-full md:w-auto"
          id="btn-filter-status">
          <i class="bi bi-circle-half text-sg-sub text-[14px]" id="icon-filter-status"></i>
          <span id="label-filter-status" class="font-semibold text-sg-text whitespace-nowrap">Semua Status</span>
          <i class="bi bi-chevron-down text-sg-sub text-[11px] ml-1 transition-transform duration-200" id="chevron-filter-status"></i>
        </button>
        <div id="dropdown-status"
          class="hidden absolute left-0 top-[calc(100%+6px)] z-50 bg-white border border-sg-border rounded-xl shadow-lg py-1.5 min-w-[160px]">
          <button type="button" onclick="setFilter('status','semua','Semua Status','bi-circle-half')"
            class="filter-option w-full text-left px-4 py-2 text-sm text-sg-text hover:bg-gray-50 flex items-center gap-2.5 font-medium" data-active="true">
            <i class="bi bi-circle-half text-sg-sub text-[13px]"></i> Semua Status
          </button>
          <button type="button" onclick="setFilter('status','proses','Proses','bi-arrow-repeat')"
            class="filter-option w-full text-left px-4 py-2 text-sm text-sg-text hover:bg-gray-50 flex items-center gap-2.5 font-medium">
            <i class="bi bi-arrow-repeat text-[#4F46E5] text-[13px]"></i> Proses
          </button>
          <button type="button" onclick="setFilter('status','antri','Menunggu','bi-hourglass-split')"
            class="filter-option w-full text-left px-4 py-2 text-sm text-sg-text hover:bg-gray-50 flex items-center gap-2.5 font-medium">
            <i class="bi bi-hourglass-split text-[#F97316] text-[13px]"></i> Menunggu
          </button>
        </div>
        {{-- Hidden select untuk filterAntrian() --}}
        <select id="filter-status" class="hidden" onchange="filterAntrian()">
          <option value="semua">Semua Status</option>
          <option value="proses">Proses</option>
          <option value="antri">Menunggu</option>
        </select>
      </div>

      {{-- ============================================================ --}}
      {{-- FILTER KATEGORI - Custom dropdown pill                       --}}
      {{-- ============================================================ --}}
      <div class="relative" id="wrapper-filter-kategori">
        <button type="button"
          onclick="toggleDropdown('dropdown-kategori')"
          class="flex items-center gap-2 bg-white border border-sg-border rounded-xl px-3 py-2 text-sm shadow-sm hover:bg-gray-50 transition-colors w-full md:w-auto"
          id="btn-filter-kategori">
          <i class="bi bi-car-front text-sg-sub text-[14px]" id="icon-filter-kategori"></i>
          <span id="label-filter-kategori" class="font-semibold text-sg-text whitespace-nowrap">Semua Kategori</span>
          <i class="bi bi-chevron-down text-sg-sub text-[11px] ml-1 transition-transform duration-200" id="chevron-filter-kategori"></i>
        </button>
        <div id="dropdown-kategori"
          class="hidden absolute left-0 top-[calc(100%+6px)] z-50 bg-white border border-sg-border rounded-xl shadow-lg py-1.5 min-w-[170px]">
          <button type="button" onclick="setFilter('kategori','semua','Semua Kategori','bi-car-front')"
            class="filter-option w-full text-left px-4 py-2 text-sm text-sg-text hover:bg-gray-50 flex items-center gap-2.5 font-medium" data-active="true">
            <i class="bi bi-car-front text-sg-sub text-[13px]"></i> Semua Kategori
          </button>
          <button type="button" onclick="setFilter('kategori','mobil','Mobil','bi-car-front-fill')"
            class="filter-option w-full text-left px-4 py-2 text-sm text-sg-text hover:bg-gray-50 flex items-center gap-2.5 font-medium">
            <i class="bi bi-car-front-fill text-[#2563EB] text-[13px]"></i> Mobil
          </button>
          <button type="button" onclick="setFilter('kategori','motor','Motor','bi-bicycle')"
            class="filter-option w-full text-left px-4 py-2 text-sm text-sg-text hover:bg-gray-50 flex items-center gap-2.5 font-medium">
            <i class="bi bi-bicycle text-[#2563EB] text-[13px]"></i> Motor
          </button>
        </div>
        <select id="filter-kategori" class="hidden" onchange="filterAntrian()">
          <option value="semua">Semua Kategori</option>
          <option value="mobil">Mobil</option>
          <option value="motor">Motor</option>
        </select>
      </div>

      {{-- ============================================================ --}}
      {{-- FILTER LAYANAN - Custom dropdown pill                        --}}
      {{-- Deduplicate by nama_layanan, value = nama (bukan id)        --}}
      {{-- karena 1 nama layanan bisa ada untuk Mobil & Motor          --}}
      {{-- ============================================================ --}}
      @php
        $namaLayananUnik = collect($layanans ?? [])->pluck('nama_layanan')->unique()->values();
      @endphp
      <div class="relative col-span-2 md:col-span-1" id="wrapper-filter-layanan">
        <button type="button"
          onclick="toggleDropdown('dropdown-layanan')"
          class="flex items-center gap-2 bg-white border border-sg-border rounded-xl px-3 py-2 text-sm shadow-sm hover:bg-gray-50 transition-colors w-full md:w-auto"
          id="btn-filter-layanan">
          <i class="bi bi-tags text-sg-sub text-[14px]" id="icon-filter-layanan"></i>
          <span id="label-filter-layanan" class="font-semibold text-sg-text whitespace-nowrap truncate max-w-[160px]">Semua Layanan</span>
          <i class="bi bi-chevron-down text-sg-sub text-[11px] ml-1 transition-transform duration-200" id="chevron-filter-layanan"></i>
        </button>
        <div id="dropdown-layanan"
          class="hidden absolute left-0 top-[calc(100%+6px)] z-50 bg-white border border-sg-border rounded-xl shadow-lg py-1.5 min-w-[200px] max-h-[240px] overflow-y-auto">
          <button type="button" onclick="setFilter('layanan','semua','Semua Layanan','bi-tags')"
            class="filter-option w-full text-left px-4 py-2 text-sm text-sg-text hover:bg-gray-50 flex items-center gap-2.5 font-medium" data-active="true">
            <i class="bi bi-tags text-sg-sub text-[13px]"></i> Semua Layanan
          </button>
          @foreach($namaLayananUnik as $namaLayanan)
            <button type="button" onclick="setFilter('layanan','{{ $namaLayanan }}','{{ $namaLayanan }}','bi-droplet-fill')"
              class="filter-option w-full text-left px-4 py-2 text-sm text-sg-text hover:bg-gray-50 flex items-center gap-2.5 font-medium">
              <i class="bi bi-droplet-fill text-[#2563EB] text-[13px]"></i> {{ $namaLayanan }}
            </button>
          @endforeach
        </div>
        <select id="filter-layanan" class="hidden" onchange="filterAntrian()">
          <option value="semua">Semua Layanan</option>
          @foreach($namaLayananUnik as $namaLayanan)
            <option value="{{ $namaLayanan }}">{{ $namaLayanan }}</option>
          @endforeach
        </select>
      </div>

    </div>
    
    <button class="bg-[#2563EB] hover:bg-blue-700 text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex items-center gap-2 w-full lg:w-auto justify-center transition-colors shadow-sm flex-shrink-0">
      <i class="bi bi-plus-lg"></i> Tambah Antrian
    </button>
  </div>

  <div class="flex flex-col lg:flex-row gap-6 items-stretch">
    
    <div class="flex-1 bg-white border border-sg-border rounded-2xl shadow-sm overflow-hidden flex flex-col w-full lg:h-full">
      
      <div class="px-4 sm:px-6 py-5 border-b border-sg-border flex justify-between items-center bg-white flex-shrink-0">
        <h3 class="font-bold text-sg-text text-[14px] sm:text-[15px]">Antrian Aktif — <span id="display-tanggal">{{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('d F Y') }}</span></h3>
        <span class="bg-[#FFF7ED] text-[#F97316] text-[11px] font-bold px-3 py-1 rounded-full whitespace-nowrap"><span id="count-antrian">{{ count($antrians ?? []) }}</span> Antrian</span>
      </div>

      <div class="hidden lg:block overflow-x-auto flex-grow">
        <table class="w-full text-left border-collapse h-full">
          <thead>
            <tr class="text-[11px] font-bold text-sg-sub uppercase tracking-wider border-b border-sg-border">
              <th class="px-6 py-4 w-16">#</th>
              <th class="px-6 py-4">Pelanggan</th>
              <th class="px-6 py-4">Layanan</th>
              <th class="px-6 py-4">Jam</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-sg-border">
            
            @forelse ($antrians ?? [] as $index => $antrian)
              @php
                  $status = strtolower($antrian->status ?? '');
                  $isProses = $status === 'proses';
                  $kategori = strtolower($antrian->layanan->kategori ?? '');
                  $namaLayanan = $antrian->layanan->nama_layanan ?? '';
                  
                  $rawTanggal = trim($antrian->tanggal ?? '');
                  $tanggalOnly = \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d');
                  $jamOnly = '00:00';

                  if (!empty($rawTanggal)) {
                      // Normalisasi nama bulan agar dikenali oleh Carbon secara universal
                      $idMonths = ['januari', 'februari', 'maret', 'mei', 'juni', 'juli', 'agustus', 'oktober', 'desember'];
                      $enMonths = ['january', 'february', 'march', 'may', 'june', 'july', 'august', 'october', 'december'];
                      $normalizedTanggal = str_ireplace($idMonths, $enMonths, $rawTanggal);
                      
                      try {
                          $parsed = \Carbon\Carbon::parse($normalizedTanggal)->timezone('Asia/Jakarta');
                          $tanggalOnly = $parsed->format('Y-m-d');
                          $jamOnly = $parsed->format('H:i');
                      } catch (\Exception $e) {
                          // Fallback jika parsing tetap gagal
                          $pattern = '/^(\d{1,2})\s+([A-Za-z]+)\s+(\d{4})/';
                          if (preg_match($pattern, $rawTanggal, $matches)) {
                              $day = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
                              $monthStr = strtolower($matches[2]);
                              $year = $matches[3];
                              $months = [
                                  'januari' => '01', 'jan' => '01', 'january' => '01',
                                  'februari' => '02', 'feb' => '02', 'february' => '02',
                                  'maret' => '03', 'mar' => '03', 'march' => '03',
                                  'april' => '04', 'apr' => '04',
                                  'mei' => '05', 'may' => '05',
                                  'juni' => '06', 'jun' => '06', 'june' => '06',
                                  'juli' => '07', 'jul' => '07', 'july' => '07',
                                  'agustus' => '08', 'agu' => '08', 'aug' => '08', 'august' => '08',
                                  'september' => '09', 'sep' => '09',
                                  'oktober' => '10', 'okt' => '10', 'oct' => '10', 'october' => '10',
                                  'november' => '11', 'nov' => '11',
                                  'desember' => '12', 'des' => '12', 'dec' => '12', 'december' => '12'
                              ];
                              $monthNum = $months[$monthStr] ?? '01';
                              $tanggalOnly = "$year-$monthNum-$day";
                              
                              if (preg_match('/(\d{2}:\d{2})/', $rawTanggal, $timeMatches)) {
                                  $jamOnly = $timeMatches[1];
                              }
                          }
                      }
                  }
              @endphp
              
              <tr class="hover:bg-gray-50 transition-colors antrian-row-desktop" 
                  data-status="{{ $status }}" 
                  data-kategori="{{ $kategori }}" 
                  data-layanan="{{ $namaLayanan }}" 
                  data-tanggal="{{ $tanggalOnly }}">
                
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="w-8 h-8 rounded-full bg-[#2563EB] text-white flex items-center justify-center font-bold text-[13px] row-number">
                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                  </div>
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="font-bold text-[14px] text-sg-text">{{ $antrian->nama_pelanggan }}</div>
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap text-[13px] text-sg-text font-medium">
                  {{ $antrian->layanan->nama_layanan ?? 'Layanan Umum' }}
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap text-[13px] text-sg-text font-medium">
                  {{ $jamOnly }}
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap">
                  @if($isProses)
                    <span class="inline-flex px-3 py-1 rounded-full text-[11px] font-bold bg-[#EEF2FF] text-[#4F46E5]">Proses</span>
                  @else
                    <span class="inline-flex px-3 py-1 rounded-full text-[11px] font-bold bg-[#FFF7ED] text-[#F97316]">Menunggu</span>
                  @endif
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap text-right">
                  @if($isProses)
                    <form action="{{ route('pesanan.selesai', $antrian->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tandai antrian selesai dikerjakan?')">
                      @csrf @method('PATCH')
                      <button type="submit" class="border border-[#BBF7D0] bg-[#F0FDF4] text-[#16A34A] hover:bg-[#DCFCE7] rounded-lg px-3 py-1.5 text-[12px] font-bold transition-colors flex items-center gap-1.5 ml-auto">
                        <i class="bi bi-check2 text-sm"></i> Selesai
                      </button>
                    </form>
                  @else
                    <button type="button" class="border border-[#BFDBFE] bg-[#EFF6FF] text-[#2563EB] rounded-lg px-3 py-1.5 text-[12px] font-bold flex items-center gap-1.5 opacity-60 cursor-not-allowed ml-auto" title="Menunggu antrian sebelumnya selesai">
                      <i class="bi bi-play-fill text-sm"></i> Mulai
                    </button>
                  @endif
                </td>
              </tr>
            @empty
              <tr id="empty-state-db-desktop">
                <td colspan="6" class="px-6 py-12 text-center text-sg-sub text-sm">
                  Tidak ada antrian aktif saat ini.
                </td>
              </tr>
            @endforelse
            
            <tr id="empty-state-filter-desktop" style="display: none;">
              <td colspan="6" class="px-6 py-12 text-center text-sg-sub text-sm">
                Tidak ada antrian yang sesuai dengan filter.
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="block lg:hidden flex-grow divide-y divide-sg-border bg-gray-50/50">
        @forelse ($antrians ?? [] as $index => $antrian)
          @php
              $status = strtolower($antrian->status ?? '');
              $isProses = $status === 'proses';
              $kategori = strtolower($antrian->layanan->kategori ?? '');
              $namaLayanan = $antrian->layanan->nama_layanan ?? '';
              
              $rawTanggal = trim($antrian->tanggal ?? '');
              $tanggalOnly = \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d');
              $jamOnly = '00:00';

              if (!empty($rawTanggal)) {
                  $idMonths = ['januari', 'februari', 'maret', 'mei', 'juni', 'juli', 'agustus', 'oktober', 'desember'];
                  $enMonths = ['january', 'february', 'march', 'may', 'june', 'july', 'august', 'october', 'december'];
                  $normalizedTanggal = str_ireplace($idMonths, $enMonths, $rawTanggal);
                  
                  try {
                      $parsed = \Carbon\Carbon::parse($normalizedTanggal)->timezone('Asia/Jakarta');
                      $tanggalOnly = $parsed->format('Y-m-d');
                      $jamOnly = $parsed->format('H:i');
                  } catch (\Exception $e) {
                      $pattern = '/^(\d{1,2})\s+([A-Za-z]+)\s+(\d{4})/';
                      if (preg_match($pattern, $rawTanggal, $matches)) {
                          $day = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
                          $monthStr = strtolower($matches[2]);
                          $year = $matches[3];
                          $months = [
                              'januari' => '01', 'jan' => '01', 'january' => '01',
                              'februari' => '02', 'feb' => '02', 'february' => '02',
                              'maret' => '03', 'mar' => '03', 'march' => '03',
                              'april' => '04', 'apr' => '04',
                              'mei' => '05', 'may' => '05',
                              'juni' => '06', 'jun' => '06', 'june' => '06',
                              'juli' => '07', 'jul' => '07', 'july' => '07',
                              'agustus' => '08', 'agu' => '08', 'aug' => '08', 'august' => '08',
                              'september' => '09', 'sep' => '09',
                              'oktober' => '10', 'okt' => '10', 'oct' => '10', 'october' => '10',
                              'november' => '11', 'nov' => '11',
                              'desember' => '12', 'des' => '12', 'dec' => '12', 'december' => '12'
                          ];
                          $monthNum = $months[$monthStr] ?? '01';
                          $tanggalOnly = "$year-$monthNum-$day";
                          
                          if (preg_match('/(\d{2}:\d{2})/', $rawTanggal, $timeMatches)) {
                              $jamOnly = $timeMatches[1];
                          }
                      }
                  }
              }
          @endphp
          
          <div class="p-4 bg-white antrian-row-mobile"
               data-status="{{ $status }}" 
               data-kategori="{{ $kategori }}" 
               data-layanan="{{ $namaLayanan }}" 
               data-tanggal="{{ $tanggalOnly }}">
            
            <div class="flex justify-between items-start mb-3">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#2563EB] text-white flex items-center justify-center font-bold text-[13px] flex-shrink-0 row-number">
                  {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                </div>
                <div>
                  <div class="font-bold text-[14px] text-sg-text leading-tight">{{ $antrian->nama_pelanggan }}</div>
                  <div class="text-[12px] text-sg-sub mt-0.5">{{ $antrian->layanan->nama_layanan ?? 'Layanan Umum' }}</div>
                </div>
              </div>
              
              @if($isProses)
                <span class="inline-flex px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#EEF2FF] text-[#4F46E5] flex-shrink-0 mt-0.5">Proses</span>
              @else
                <span class="inline-flex px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#FFF7ED] text-[#F97316] flex-shrink-0 mt-0.5">Menunggu</span>
              @endif
            </div>

            <div class="flex justify-between items-center bg-[#FAFBFD] p-3 rounded-xl border border-sg-border/50 mb-3">
              <span class="text-[12px] text-sg-sub font-medium">Jam Kedatangan</span>
              <span class="font-bold text-[13px] text-sg-text"><i class="bi bi-clock mr-1 text-sg-sub"></i> {{ $jamOnly }}</span>
            </div>

            <div class="flex w-full">
              @if($isProses)
                <form action="{{ route('pesanan.selesai', $antrian->id) }}" method="POST" class="w-full" onsubmit="return confirm('Tandai antrian selesai dikerjakan?')">
                  @csrf @method('PATCH')
                  <button type="submit" class="w-full border border-[#BBF7D0] bg-[#F0FDF4] text-[#16A34A] hover:bg-[#DCFCE7] rounded-xl px-4 py-2.5 text-[13px] font-bold transition-colors flex items-center justify-center gap-2">
                    <i class="bi bi-check2 text-base"></i> Selesai
                  </button>
                </form>
              @else
                <button type="button" class="w-full border border-[#BFDBFE] bg-[#EFF6FF] text-[#2563EB] rounded-xl px-4 py-2.5 text-[13px] font-bold flex items-center justify-center gap-2 opacity-60 cursor-not-allowed" title="Menunggu antrian sebelumnya selesai">
                  <i class="bi bi-play-fill text-base"></i> Mulai
                </button>
              @endif
            </div>
            
          </div>
        @empty
          <div id="empty-state-db-mobile" class="p-8 text-center">
            <p class="text-sg-sub text-sm">Tidak ada antrian aktif saat ini.</p>
          </div>
        @endforelse
        
        <div id="empty-state-filter-mobile" class="p-8 text-center" style="display: none;">
          <p class="text-sg-sub text-sm">Tidak ada antrian sesuai filter.</p>
        </div>
      </div>

    </div>

    <div class="w-full lg:w-[320px] bg-white border border-sg-border rounded-2xl shadow-sm p-4 sm:p-5 flex flex-col lg:h-full flex-shrink-0">
      
      @php
          $listJam = $jamOperasionals ?? collect([]);
          if ($listJam->isEmpty()) {
              $jamStatis = [
                  '08:00 - 09:00', '09:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00', '12:00 - 13:00',
                  '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00', '16:00 - 17:00',
                  '17:00 - 18:00', '18:00 - 19:00', '19:00 - 20:00'
              ];
              foreach($jamStatis as $index => $js) {
                  $listJam->push((object)[
                      'id' => 'statis-' . $index,
                      'jam' => $js,
                      'is_active' => true
                  ]);
              }
          }
          $allOffCount = collect($listJam)->where('is_active', false)->count();
          $isMasterOn = $allOffCount < count($listJam); 
      @endphp

      <div class="flex justify-between items-center mb-4 flex-shrink-0">
        <h3 class="font-bold text-sg-text text-[15px]">Jam Operasional</h3>
        
        <button type="button" class="transition-colors flex items-center justify-center {{ $isMasterOn ? 'text-sg-green hover:text-green-700' : 'text-sg-sub hover:text-gray-600' }}" 
                id="master-toggle-btn"
                data-status="{{ $isMasterOn ? 'on' : 'off' }}"
                onclick="openToggleSemuaJamModal(this)" 
                title="{{ $isMasterOn ? 'Tutup Semua Jam' : 'Buka Semua Jam' }}">
          <i class="bi {{ $isMasterOn ? 'bi-toggle-on' : 'bi-toggle-off' }} text-[26px]"></i>
        </button>
      </div>
      
      <div class="flex flex-col gap-3 overflow-y-auto pr-1 flex-1 max-h-[400px] lg:max-h-none">
        
        @foreach($listJam as $jam)
          @php $isActive = $jam->is_active; @endphp
          
          <div class="border border-sg-border {{ $isActive ? 'bg-white' : 'bg-gray-50 opacity-60' }} rounded-xl p-3 sm:p-3.5 flex justify-between items-center flex-shrink-0 transition-all duration-300 jam-card">
            <div class="font-bold {{ $isActive ? 'text-sg-text' : 'text-sg-sub line-through' }} text-[13px] jam-teks">{{ $jam->jam }}</div>
            <button type="button" class="transition-colors flex items-center justify-center {{ $isActive ? 'text-sg-green hover:text-green-700' : 'text-sg-sub hover:text-gray-600' }} btn-jam-individu" 
                    data-id="{{ $jam->id }}"
                    data-jam="{{ $jam->jam }}" 
                    data-status="{{ $isActive ? 'on' : 'off' }}"
                    onclick="openToggleJamModal(this)" 
                    title="{{ $isActive ? 'Tutup Jam Ini' : 'Buka Jam Ini' }}">
              <i class="bi {{ $isActive ? 'bi-toggle-on' : 'bi-toggle-off' }} text-[24px]"></i>
            </button>
          </div>
        @endforeach

      </div>
    </div>
  </div>

  {{-- Modal Toggle Jam Individu --}}
  <div id="modal-toggle-jam" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] sm:w-full max-w-sm bg-white rounded-2xl shadow-2xl mx-auto">
    <div class="p-6 text-center">
      <div id="toggle-jam-icon-container" class="w-16 h-16 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 bg-orange-100 text-orange-600">
        <i id="toggle-jam-icon" class="bi bi-exclamation-triangle"></i>
      </div>
      <h5 id="toggle-jam-title" class="font-display font-bold text-[19px] mb-2">Tutup Jam Operasional?</h5>
      <p class="text-sm text-sg-sub mb-6">
        Anda yakin ingin <span id="toggle-jam-action-text" class="font-bold">menutup</span> jadwal <strong id="toggle-jam-teks" class="text-sg-text"></strong>?
      </p>
      <div class="flex gap-2 justify-center">
        <button type="button" class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-gray-50 transition-colors" onclick="closeModal()">Batal</button>
        <button type="button" id="toggle-jam-submit-btn" class="bg-orange-500 text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-orange-600 transition-colors" onclick="confirmToggleJam()">Ya, Tutup</button>
      </div>
    </div>
  </div>

  {{-- Modal Toggle Semua Jam --}}
  <div id="modal-toggle-semua-jam" class="modal-panel hidden fixed z-[2001] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] sm:w-full max-w-sm bg-white rounded-2xl shadow-2xl mx-auto">
    <div class="p-6 text-center">
      <div id="toggle-semua-icon-container" class="w-16 h-16 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 bg-orange-100 text-orange-600">
        <i id="toggle-semua-icon" class="bi bi-exclamation-triangle"></i>
      </div>
      <h5 id="toggle-semua-title" class="font-display font-bold text-[19px] mb-2">Tutup Semua Jam?</h5>
      <p class="text-sm text-sg-sub mb-6">
        Anda yakin ingin <span id="toggle-semua-action-text" class="font-bold">menutup</span> <strong>seluruh</strong> jadwal operasional hari ini?
      </p>
      <div class="flex gap-2 justify-center">
        <button type="button" class="bg-white text-sg-text border border-sg-border font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-gray-50 transition-colors" onclick="closeModal()">Batal</button>
        <button type="button" id="toggle-semua-submit-btn" class="bg-orange-500 text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-orange-600 transition-colors" onclick="confirmToggleSemuaJam()">Ya, Tutup Semua</button>
      </div>
    </div>
  </div>

</div>

<script>

  // ============================================================
  // FILTER TANGGAL — Helper functions untuk custom date pill
  // ============================================================

  function formatLabelTanggal(dateStr) {
    // dateStr format: 'YYYY-MM-DD'
    const today = new Date();
    const todayStr = today.toISOString().split('T')[0];

    const yesterday = new Date(today);
    yesterday.setDate(today.getDate() - 1);
    const yesterdayStr = yesterday.toISOString().split('T')[0];

    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    const tomorrowStr = tomorrow.toISOString().split('T')[0];

    const [year, month, day] = dateStr.split('-');
    const bulanSingkat = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const labelTanggal = `${parseInt(day)} ${bulanSingkat[parseInt(month) - 1]} ${year}`;

    if (dateStr === todayStr)     return `Hari Ini, ${parseInt(day)} ${bulanSingkat[parseInt(month) - 1]}`;
    if (dateStr === yesterdayStr) return `Kemarin, ${parseInt(day)} ${bulanSingkat[parseInt(month) - 1]}`;
    if (dateStr === tomorrowStr)  return `Besok, ${parseInt(day)} ${bulanSingkat[parseInt(month) - 1]}`;
    return labelTanggal;
  }

  function onTanggalChange() {
    const val = document.getElementById('filter-tanggal').value;

    // Update label pill
    document.getElementById('label-tanggal').innerText = formatLabelTanggal(val);

    // Update teks header "Antrian Aktif — ..."
    const [year, month, day] = val.split('-');
    const bulanPanjang = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    document.getElementById('display-tanggal').innerText = `${parseInt(day)} ${bulanPanjang[parseInt(month) - 1]} ${year}`;

    filterAntrian();
  }

  function shiftTanggal(delta) {
    const input = document.getElementById('filter-tanggal');
    const current = new Date(input.value);
    current.setDate(current.getDate() + delta);
    // Format manual agar tidak kena timezone offset
    const y = current.getFullYear();
    const m = String(current.getMonth() + 1).padStart(2, '0');
    const d = String(current.getDate()).padStart(2, '0');
    input.value = `${y}-${m}-${d}`;
    onTanggalChange();
  }

  // ============================================================
  // CUSTOM DROPDOWN FILTER
  // ============================================================

  function toggleDropdown(id) {
    const all = ['dropdown-status', 'dropdown-kategori', 'dropdown-layanan'];
    all.forEach(ddId => {
      const dd = document.getElementById(ddId);
      const key = ddId.replace('dropdown-', '');
      const chevron = document.getElementById('chevron-filter-' + key);
      if (ddId === id) {
        const isHidden = dd.classList.contains('hidden');
        dd.classList.toggle('hidden', !isHidden);
        if (chevron) chevron.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
      } else {
        dd.classList.add('hidden');
        if (chevron) chevron.style.transform = 'rotate(0deg)';
      }
    });
  }

  // Tutup semua dropdown kalau klik di luar
  document.addEventListener('click', function(e) {
    const wrappers = ['wrapper-filter-status', 'wrapper-filter-kategori', 'wrapper-filter-layanan'];
    const clickedInside = wrappers.some(id => {
      const el = document.getElementById(id);
      return el && el.contains(e.target);
    });
    if (!clickedInside) {
      ['dropdown-status', 'dropdown-kategori', 'dropdown-layanan'].forEach(ddId => {
        document.getElementById(ddId)?.classList.add('hidden');
        const key = ddId.replace('dropdown-', '');
        const chevron = document.getElementById('chevron-filter-' + key);
        if (chevron) chevron.style.transform = 'rotate(0deg)';
      });
    }
  });

  function setFilter(key, value, label, icon) {
    // Update label & icon pill
    document.getElementById('label-filter-' + key).innerText = label;
    document.getElementById('icon-filter-' + key).className = icon + ' text-[14px] ' + (value === 'semua' ? 'text-sg-sub' : 'text-[#2563EB]');

    // Highlight border pill kalau ada filter aktif
    const btn = document.getElementById('btn-filter-' + key);
    if (value === 'semua') {
      btn.classList.remove('border-[#2563EB]', 'bg-[#EFF6FF]');
      btn.classList.add('border-sg-border', 'bg-white');
    } else {
      btn.classList.remove('border-sg-border', 'bg-white');
      btn.classList.add('border-[#2563EB]', 'bg-[#EFF6FF]');
    }

    // Sync ke hidden select asli lalu trigger filterAntrian
    const select = document.getElementById('filter-' + key);
    select.value = value;
    select.dispatchEvent(new Event('change'));

    // Tandai active state di option list
    const dropdown = document.getElementById('dropdown-' + key);
    dropdown.querySelectorAll('.filter-option').forEach(opt => {
      opt.removeAttribute('data-active');
      opt.classList.remove('bg-[#EFF6FF]', 'text-[#2563EB]', 'font-bold');
    });
    // Highlight item yang dipilih
    const allOpts = dropdown.querySelectorAll('.filter-option');
    allOpts.forEach(opt => {
      if (opt.getAttribute('onclick')?.includes(`'${value}'`)) {
        opt.setAttribute('data-active', 'true');
        opt.classList.add('bg-[#EFF6FF]', 'text-[#2563EB]', 'font-bold');
      }
    });

    // Tutup dropdown
    dropdown.classList.add('hidden');
    const chevron = document.getElementById('chevron-filter-' + key);
    if (chevron) chevron.style.transform = 'rotate(0deg)';
  }

  // ============================================================
  // FILTER ANTRIAN
  // ============================================================

  function filterAntrian() {
    const valTanggal = document.getElementById('filter-tanggal').value;
    const valStatus = document.getElementById('filter-status').value;
    const valKategori = document.getElementById('filter-kategori').value;
    const valLayanan = document.getElementById('filter-layanan').value;

    const desktopRows = document.querySelectorAll('.antrian-row-desktop');
    const mobileRows = document.querySelectorAll('.antrian-row-mobile');
    
    const emptyStateDesktop = document.getElementById('empty-state-filter-desktop');
    const emptyStateMobile = document.getElementById('empty-state-filter-mobile');
    
    let visibleCount = 0;

    desktopRows.forEach((row, index) => {
      const rowTanggal = row.getAttribute('data-tanggal');
      const rowStatus = row.getAttribute('data-status');
      const rowKategori = row.getAttribute('data-kategori');
      const rowLayanan = row.getAttribute('data-layanan');

      const matchTanggal = (!valTanggal) || (rowTanggal === valTanggal);
      const matchStatus = (valStatus === 'semua') || (rowStatus === valStatus);
      const matchKategori = (valKategori === 'semua') || (rowKategori === valKategori);
      const matchLayanan = (valLayanan === 'semua') || (rowLayanan === valLayanan);

      if (matchTanggal && matchStatus && matchKategori && matchLayanan) {
        row.style.display = '';
        if(mobileRows[index]) mobileRows[index].style.display = '';
        visibleCount++;
        
        const numStr = visibleCount.toString().padStart(2, '0');
        row.querySelector('.row-number').innerText = numStr;
        if(mobileRows[index]) mobileRows[index].querySelector('.row-number').innerText = numStr;
      } else {
        row.style.display = 'none';
        if(mobileRows[index]) mobileRows[index].style.display = 'none';
      }
    });

    document.getElementById('count-antrian').innerText = visibleCount;

    if (desktopRows.length > 0) {
      if (visibleCount === 0) {
        if(emptyStateDesktop) emptyStateDesktop.style.display = '';
        if(emptyStateMobile) emptyStateMobile.style.display = 'block';
      } else {
        if(emptyStateDesktop) emptyStateDesktop.style.display = 'none';
        if(emptyStateMobile) emptyStateMobile.style.display = 'none';
      }
    }
  }

  // ============================================================
  // JAM OPERASIONAL — Toggle state helpers
  // ============================================================

  function setJamIndividuState(btn, targetStatus) {
    const icon = btn.querySelector('i');
    const card = btn.closest('.jam-card');
    const teks = card.querySelector('.jam-teks');

    if (targetStatus === 'off') {
      btn.setAttribute('data-status', 'off');
      icon.className = 'bi bi-toggle-off text-[24px] text-sg-sub hover:text-gray-600';
      card.className = 'border border-sg-border bg-gray-50 opacity-60 rounded-xl p-3 sm:p-3.5 flex justify-between items-center flex-shrink-0 transition-all duration-300 jam-card';
      teks.className = 'font-bold text-sg-sub line-through text-[13px] jam-teks';
      btn.title = "Buka Jam Ini";
    } else {
      btn.setAttribute('data-status', 'on');
      icon.className = 'bi bi-toggle-on text-[24px] text-sg-green hover:text-green-700';
      card.className = 'border border-sg-border bg-white rounded-xl p-3 sm:p-3.5 flex justify-between items-center flex-shrink-0 transition-all duration-300 jam-card';
      teks.className = 'font-bold text-sg-text text-[13px] jam-teks';
      btn.title = "Tutup Jam Ini";
    }
  }

  function syncMasterButtonState() {
    const allBtns = document.querySelectorAll('.btn-jam-individu');
    const masterBtn = document.getElementById('master-toggle-btn');
    const masterIcon = masterBtn.querySelector('i');
    
    let offCount = 0;
    allBtns.forEach(btn => {
      if (btn.getAttribute('data-status') === 'off') offCount++;
    });

    if (offCount === allBtns.length) {
      masterBtn.setAttribute('data-status', 'off');
      masterIcon.className = 'bi bi-toggle-off text-[26px] text-sg-sub hover:text-gray-600';
      masterBtn.title = "Buka Semua Jam";
    } else {
      masterBtn.setAttribute('data-status', 'on');
      masterIcon.className = 'bi bi-toggle-on text-[26px] text-sg-green hover:text-green-700';
      masterBtn.title = "Tutup Semua Jam";
    }
  }

  let currentToggleBtn = null;

  function openToggleJamModal(btn) {
    currentToggleBtn = btn;
    const jam = btn.getAttribute('data-jam');
    const status = btn.getAttribute('data-status');

    document.getElementById('toggle-jam-teks').innerText = jam;

    const titleEl = document.getElementById('toggle-jam-title');
    const actionTextEl = document.getElementById('toggle-jam-action-text');
    const iconContainer = document.getElementById('toggle-jam-icon-container');
    const iconEl = document.getElementById('toggle-jam-icon');
    const submitBtn = document.getElementById('toggle-jam-submit-btn');

    if (status === 'on') {
      titleEl.innerText = "Tutup Jadwal Ini?";
      actionTextEl.innerText = "menutup";
      iconContainer.className = "w-16 h-16 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 bg-orange-100 text-orange-600";
      iconEl.className = "bi bi-exclamation-triangle";
      submitBtn.className = "bg-orange-500 text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-orange-600 transition-colors";
      submitBtn.innerText = "Ya, Tutup";
    } else {
      titleEl.innerText = "Buka Jadwal Ini?";
      actionTextEl.innerText = "membuka";
      iconContainer.className = "w-16 h-16 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 bg-sg-greenlt text-sg-green";
      iconEl.className = "bi bi-check-circle";
      submitBtn.className = "bg-sg-green text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-green-700 transition-colors";
      submitBtn.innerText = "Ya, Buka";
    }

    openModal('modal-toggle-jam');
  }

  function confirmToggleJam() {
    if (!currentToggleBtn) return;
    const jamId = currentToggleBtn.getAttribute('data-id');
    const status = currentToggleBtn.getAttribute('data-status');
    const targetStatus = (status === 'on') ? 'off' : 'on';
    
    if (jamId.startsWith('statis-')) {
      setJamIndividuState(currentToggleBtn, targetStatus);
      syncMasterButtonState();
      closeModal();
      return;
    }

    fetch(`/jam-operasional/${jamId}/toggle`, {
      method: 'PATCH',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
      }
    }).then(response => {
      if(response.ok) {
        setJamIndividuState(currentToggleBtn, targetStatus);
        syncMasterButtonState();
      } else {
        alert("Gagal memperbarui database!");
      }
    });
    
    closeModal();
  }

  function openToggleSemuaJamModal(btn) {
    const status = btn.getAttribute('data-status');

    const titleEl = document.getElementById('toggle-semua-title');
    const actionTextEl = document.getElementById('toggle-semua-action-text');
    const iconContainer = document.getElementById('toggle-semua-icon-container');
    const iconEl = document.getElementById('toggle-semua-icon');
    const submitBtn = document.getElementById('toggle-semua-submit-btn');

    if (status === 'on') {
      titleEl.innerText = "Tutup Semua Jadwal?";
      actionTextEl.innerText = "menutup";
      iconContainer.className = "w-16 h-16 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 bg-orange-100 text-orange-600";
      iconEl.className = "bi bi-exclamation-triangle";
      submitBtn.className = "bg-orange-500 text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-orange-600 transition-colors";
      submitBtn.innerText = "Ya, Tutup Semua";
    } else {
      titleEl.innerText = "Buka Semua Jadwal?";
      actionTextEl.innerText = "membuka";
      iconContainer.className = "w-16 h-16 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 bg-sg-greenlt text-sg-green";
      iconEl.className = "bi bi-check-circle";
      submitBtn.className = "bg-sg-green text-white font-semibold rounded-xl px-5 py-2.5 text-sm flex-1 hover:bg-green-700 transition-colors";
      submitBtn.innerText = "Ya, Buka Semua";
    }

    openModal('modal-toggle-semua-jam');
  }

  function confirmToggleSemuaJam() {
    const masterBtn = document.getElementById('master-toggle-btn');
    const status = masterBtn.getAttribute('data-status');
    const targetStatus = (status === 'on') ? 'off' : 'on';
    const allIndividualBtns = document.querySelectorAll('.btn-jam-individu');

    let isStatis = false;
    if (allIndividualBtns.length > 0 && allIndividualBtns[0].getAttribute('data-id').startsWith('statis-')) {
      isStatis = true;
    }

    if (isStatis) {
      if (targetStatus === 'off') {
        masterBtn.setAttribute('data-status', 'off');
        masterBtn.querySelector('i').className = 'bi bi-toggle-off text-[26px] text-sg-sub hover:text-gray-600';
        masterBtn.title = "Buka Semua Jam";
      } else {
        masterBtn.setAttribute('data-status', 'on');
        masterBtn.querySelector('i').className = 'bi bi-toggle-on text-[26px] text-sg-green hover:text-green-700';
        masterBtn.title = "Tutup Semua Jam";
      }
      allIndividualBtns.forEach(btn => setJamIndividuState(btn, targetStatus));
      closeModal();
      return;
    }

    fetch('/jam-operasional/toggle-all', {
      method: 'PATCH',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ status: targetStatus })
    }).then(response => {
      if(response.ok) {
        if (targetStatus === 'off') {
          masterBtn.setAttribute('data-status', 'off');
          masterBtn.querySelector('i').className = 'bi bi-toggle-off text-[26px] text-sg-sub hover:text-gray-600';
          masterBtn.title = "Buka Semua Jam";
        } else {
          masterBtn.setAttribute('data-status', 'on');
          masterBtn.querySelector('i').className = 'bi bi-toggle-on text-[26px] text-sg-green hover:text-green-700';
          masterBtn.title = "Tutup Semua Jam";
        }

        allIndividualBtns.forEach(btn => {
          setJamIndividuState(btn, targetStatus);
        });
      } else {
        alert("Gagal memperbarui database!");
      }
    });

    closeModal();
  }

  // ============================================================
  // INISIALISASI AWAL
  // ============================================================
  document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi label tanggal pada custom pill
    const val = document.getElementById('filter-tanggal').value;
    document.getElementById('label-tanggal').innerText = formatLabelTanggal(val);

    filterAntrian();
  });
</script>