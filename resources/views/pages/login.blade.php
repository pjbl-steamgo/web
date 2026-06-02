<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SteamGo Admin – Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'sans-serif'],
            nunito: ['Nunito', 'sans-serif'],
          },
          colors: {
            navy: {
              DEFAULT: '#0D2B5E',
              mid: '#163B7C',
              dark: '#071830',
            },
            cyan: {
              DEFAULT: '#29B5E8',
              light: '#5ECFEF',
              dark: '#1A9DC8',
            },
          },
        }
      }
    }
  </script>

  <style>
    /* Gelembung Efek Bergerak */
    @keyframes floatUp {
      0%   { transform: translateY(0) scale(1); opacity: 0; }
      10%  { opacity: 1; }
      90%  { opacity: 0.7; }
      100% { transform: translateY(-110vh) scale(1.3); opacity: 0; }
    }
    .bubble-anim { animation: floatUp linear infinite; }
    
    @keyframes blobPulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.15); }
    }
    .blob-anim { animation: blobPulse 8s ease-in-out infinite; }

    /* Custom Checkbox Resetting */
    input[type="checkbox"] { -webkit-appearance: none; appearance: none; }
    input[type="checkbox"]:checked::after {
      content: '';
      position: absolute;
      left: 5px; top: 2px;
      width: 5px; height: 9px;
      border: 2px solid white;
      border-top: none; border-left: none;
      transform: rotate(45deg);
    }
  </style>
</head>
<body class="font-sans min-h-screen bg-navy flex items-center justify-center overflow-x-hidden overflow-y-auto relative m-0 p-4 md:p-6">

  <div class="fixed inset-0 overflow-hidden z-0 pointer-events-none bg-[radial-gradient(ellipse_80%_60%_at_60%_40%,#163B7C_0%,#0D2B5E_60%,#071830_100%)]">
    <div class="bubble-anim absolute rounded-full opacity-0 bg-[rgba(41,181,232,0.55)] w-[14px] h-[14px] left-[10%] -bottom-5" style="animation-duration: 7s; animation-delay: 0s;"></div>
    <div class="bubble-anim absolute rounded-full opacity-0 bg-[rgba(94,207,239,0.35)] w-[22px] h-[22px] left-[25%] -bottom-5" style="animation-duration: 9s; animation-delay: 1.5s;"></div>
    <div class="bubble-anim absolute rounded-full opacity-0 bg-[rgba(41,181,232,0.70)] w-[10px] h-[10px] left-[42%] -bottom-5" style="animation-duration: 6s; animation-delay: 0.8s;"></div>
    <div class="bubble-anim absolute rounded-full opacity-0 bg-[rgba(94,207,239,0.25)] w-[30px] h-[30px] left-[60%] -bottom-5" style="animation-duration: 11s; animation-delay: 2.5s;"></div>
    <div class="bubble-anim absolute rounded-full opacity-0 bg-[rgba(41,181,232,0.80)] w-[8px] h-[8px] left-[78%] -bottom-5" style="animation-duration: 5s; animation-delay: 0.3s;"></div>
    <div class="bubble-anim absolute rounded-full opacity-0 bg-[rgba(255,255,255,0.18)] w-[18px] h-[18px] left-[88%] -bottom-5" style="animation-duration: 8s; animation-delay: 3s;"></div>
    <div class="bubble-anim absolute rounded-full opacity-0 bg-[rgba(41,181,232,0.45)] w-[12px] h-[12px] left-[5%] -bottom-5" style="animation-duration: 10s; animation-delay: 4s;"></div>
    <div class="bubble-anim absolute rounded-full opacity-0 bg-[rgba(94,207,239,0.20)] w-[26px] h-[26px] left-[50%] -bottom-5" style="animation-duration: 13s; animation-delay: 1s;"></div>
    <div class="bubble-anim absolute rounded-full opacity-0 bg-[rgba(255,255,255,0.30)] w-[6px] h-[6px] left-[35%] -bottom-5" style="animation-duration: 4.5s; animation-delay: 0.6s;"></div>
    <div class="bubble-anim absolute rounded-full opacity-0 bg-[rgba(41,181,232,0.50)] w-[20px] h-[20px] left-[70%] -bottom-5" style="animation-duration: 7.5s; animation-delay: 2s;"></div>
    
    <div class="blob-anim absolute rounded-full blur-[60px] bg-[rgba(41,181,232,0.12)] w-[420px] h-[420px] -top-20 -right-20"></div>
    <div class="blob-anim absolute rounded-full blur-[60px] bg-[rgba(94,207,239,0.08)] w-[300px] h-[300px] -bottom-15 -left-15" style="animation-delay: 2s;"></div>
  </div>

  <div class="relative z-10 flex w-full max-w-4xl min-h-[540px] rounded-[18px] overflow-hidden shadow-[0_32px_80px_rgba(13,43,94,0.18),0_8px_24px_rgba(13,43,94,0.10)] transition-all duration-700 max-[720px]:max-w-full max-[720px]:min-h-screen max-[720px]:rounded-none max-[720px]:m-0">
    
    <div class="flex-1 bg-gradient-to-br from-navy-mid via-navy to-navy-dark flex flex-col items-center justify-center p-8 relative overflow-hidden bg-no-repeat bg-center max-[720px]:hidden"
         style="background-image: url('data:image/svg+xml,%3Csvg width=\'400\' height=\'400\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'200\' cy=\'200\' r=\'180\' stroke=\'rgba(41,181,232,0.06)\' stroke-width=\'60\' fill=\'none\'/%3E%3Ccircle cx=\'200\' cy=\'200\' r=\'100\' stroke=\'rgba(41,181,232,0.04)\' stroke-width=\'40\' fill=\'none\'/%3E%3C/svg%3E'); background-size: cover;">
      
      <div class="w-[150px] h-[150px] bg-[#EEF4F8] rounded-full mb-6 flex items-center justify-center shadow-[0_0_35px_rgba(94,207,239,0.45),0_16px_40px_rgba(7,24,48,0.5)] border-4 border-[rgba(255,255,255,0.15)] overflow-hidden">
        <img class="w-full h-full object-cover rounded-full" src="{{ asset('images/admin-avatar.png') }}" alt="SteamGo Logo" />
      </div>

      <div class="font-nunito font-extrabold text-[1.65rem] text-white text-center leading-tight tracking-[-0.5px] mb-8">
        Admin<br/><span class="text-cyan font-black">SteamGo</span>
      </div>
      
      <div class="flex flex-col gap-2.5 w-full max-w-[230px]">
        <div class="flex items-center gap-2.5 py-2 px-4 bg-[rgba(41,181,232,0.12)] border border-[rgba(41,181,232,0.22)] rounded-[50px] text-[0.80rem] text-[rgba(255,255,255,0.80)] font-medium">
          <div class="w-6 h-6 bg-[rgba(41,181,232,0.25)] rounded-full flex items-center justify-center flex-shrink-0 text-cyan-light">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v5.25c0 .621-.504 1.125-1.125 1.125h-2.25A1.125 1.125 0 013 18.375v-5.25zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125v-9.75zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v14.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
          </div>
          Laporan & Analitik Real-time
        </div>
        <div class="flex items-center gap-2.5 py-2 px-4 bg-[rgba(41,181,232,0.12)] border border-[rgba(41,181,232,0.22)] rounded-[50px] text-[0.80rem] text-[rgba(255,255,255,0.80)] font-medium">
          <div class="w-6 h-6 bg-[rgba(41,181,232,0.25)] rounded-full flex items-center justify-center flex-shrink-0 text-cyan-light">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12M8.25 17.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 17.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
          </div>
          Manajemen Antrian Mudah
        </div>
        <div class="flex items-center gap-2.5 py-2 px-4 bg-[rgba(41,181,232,0.12)] border border-[rgba(41,181,232,0.22)] rounded-[50px] text-[0.80rem] text-[rgba(255,255,255,0.80)] font-medium">
          <div class="w-6 h-6 bg-[rgba(41,181,232,0.25)] rounded-full flex items-center justify-center flex-shrink-0 text-cyan-light">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-2.533-3.326 10.56 10.56 0 00-4.213-.914 10.56 10.56 0 00-4.213.914 4.125 4.125 0 00-2.533 3.326 9.337 9.337 0 004.12 1.022 9.38 9.38 0 002.625-.372zm3-13.378a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM6.502 7a4.474 4.474 0 012.259-3.894A4.5 4.5 0 003.75 7.5a4.5 4.5 0 004.127 4.477A4.474 4.474 0 016.502 7zM1.011 16.55A4.499 4.499 0 015.001 13a4.49 4.49 0 012.397 1.013 4.12 4.12 0 00-1.92 2.215 11.24 11.24 0 00-3.394-.852z"/></svg>
          </div>
          Data Pelanggan Lengkap
        </div>
      </div>
    </div>

    <div class="w-[430px] bg-white flex flex-col justify-center p-8 md:p-12 relative max-[720px]:w-full max-[720px]:min-h-screen max-[720px]:pt-32 max-[480px]:pt-36 max-[480px]:px-5
                before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:h-1 before:bg-gradient-to-r before:from-cyan before:to-cyan-light
                max-[720px]:after:content-[''] max-[720px]:after:block max-[720px]:after:w-[85px] max-[720px]:after:h-[85px] max-[720px]:after:absolute max-[720px]:after:top-7 max-[720px]:after:left-1/2 max-[720px]:after:-translate-x-1/2 max-[720px]:after:bg-white max-[720px]:after:bg-[url('{{ asset('images/admin-avatar.png') }}')] max-[720px]:after:bg-center max-[720px]:after:bg-[length:85%] max-[720px]:after:bg-no-repeat max-[720px]:after:rounded-full max-[720px]:after:shadow-[0_4px_16px_rgba(13,43,94,0.15)] max-[720px]:after:border max-[720px]:after:border-[#EEF4F8]">
      
      <div class="mb-8">
        <h2 class="font-nunito font-black text-[1.75rem] text-navy tracking-[-0.5px]">Selamat Datang 👋</h2>
        <p class="mt-1.5 text-[0.88rem] text-gray-500 font-medium">Masuk ke dashboard admin SteamGo</p>
      </div>

      <form id="loginForm" method="POST" action="{{ url('/login') }}" novalidate class="block">
        @csrf
        
        <div class="mb-4">
          <label for="username" class="block text-[0.80rem] font-bold text-navy uppercase tracking-[0.6px] mb-2">Username</label>
          <div class="relative group">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-[18px] h-[18px] text-gray-300 transition-colors duration-200 group-focus-within:text-cyan pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username admin" autocomplete="username" required
                   class="w-full h-[50px] py-0 pr-12 pl-[46px] border-2 {{ $errors->has('username') ? 'border-red-400' : 'border-[#EEF4F8]' }} rounded-xl font-sans text-[0.92rem] text-navy bg-[#F7FAFC] outline-none transition-all duration-200 focus:border-cyan focus:bg-white focus:shadow-[0_0_0_4px_rgba(41,181,232,0.12)] placeholder:text-gray-300"/>
          </div>
          @error('username')
            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="block text-[0.80rem] font-bold text-navy uppercase tracking-[0.6px] mb-2">Password</label>
          <div class="relative group">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-[18px] h-[18px] text-gray-300 transition-colors duration-200 group-focus-within:text-cyan pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            <input type="password" id="password" name="password" placeholder="Masukkan password" autocomplete="current-password" required
                   class="w-full h-[50px] py-0 pr-12 pl-[46px] border-2 border-[#EEF4F8] rounded-xl font-sans text-[0.92rem] text-navy bg-[#F7FAFC] outline-none transition-all duration-200 focus:border-cyan focus:bg-white focus:shadow-[0_0_0_4px_rgba(41,181,232,0.12)] placeholder:text-gray-300"/>
            <button type="button" class="toggle-pw absolute right-3.5 top-1/2 -translate-y-1/2 bg-none border-none cursor-pointer text-gray-300 p-1 flex items-center transition-colors duration-200 hover:text-cyan" id="togglePw" aria-label="Toggle password">
              <svg id="eyeIcon" class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>

        <button type="submit" class="w-full h-[50px] bg-gradient-to-br from-cyan to-cyan-dark border-none rounded-xl text-white font-nunito font-extrabold text-base tracking-[0.5px] cursor-pointer flex items-center justify-center gap-2.5 shadow-[0_8px_24px_rgba(41,181,232,0.40)] transition-all duration-200 relative overflow-hidden group hover:-translate-y-0.5 hover:shadow-[0_14px_36px_rgba(41,181,232,0.50)] hover:brightness-[1.05] active:translate-y-0" id="loginBtn">
          <span class="btn-text group-[.loading]:hidden">Masuk ke Dashboard</span>
          <svg class="btn-icon w-5 h-5 transition-transform duration-200 group-hover:translate-x-1 group-[.loading]:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          <div class="spinner hidden group-[.loading]:block w-5 h-5 border-[2.5px] border-[rgba(255,255,255,0.4)] border-t-white rounded-full animate-spin"></div>
        </button>

        <div class="flex items-center gap-3 my-5 before:content-[''] before:flex-1 before:h-[1px] before:bg-[#EEF4F8] after:content-[''] after:flex-1 after:h-[1px] after:bg-[#EEF4F8]">
          <span class="text-[0.75rem] text-gray-300 font-semibold whitespace-nowrap">SISTEM ADMIN STEAMGO</span>
        </div>
        
        <p class="text-center text-[0.76rem] text-gray-300">© 2026 <strong class="text-navy font-bold">SteamGo</strong>. Hak Cipta Dilindungi.</p>
      </form>
    </div>
  </div>

  <script>
    // Fitur Sembunyikan & Tampilkan Password
    const togglePw = document.getElementById('togglePw');
    const pwInput  = document.getElementById('password');
    const eyeIcon  = document.getElementById('eyeIcon');

    togglePw.addEventListener('click', () => {
      const isHidden = pwInput.type === 'password';
      pwInput.type = isHidden ? 'text' : 'password';
      eyeIcon.innerHTML = isHidden
        ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`
        : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    });

    // Efek Riak Gelombang Klik Tombol
    const btn = document.getElementById('loginBtn');
    btn.addEventListener('click', function(e) {
      const ripple = document.createElement('span');
      ripple.style.position = 'absolute';
      ripple.style.borderRadius = '50%';
      ripple.style.backgroundColor = 'rgba(255,255,255,0.3)';
      ripple.style.transform = 'scale(0)';
      ripple.style.transition = 'transform 0.6s linear, opacity 0.6s linear';
      ripple.style.pointerEvents = 'none';

      const rect = btn.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      
      ripple.style.width = `${size}px`;
      ripple.style.height = `${size}px`;
      ripple.style.left = `${e.clientX - rect.left - size / 2}px`;
      ripple.style.top = `${e.clientY - rect.top - size / 2}px`;
      
      btn.appendChild(ripple);
      
      requestAnimationFrame(() => {
        ripple.style.transform = 'scale(4)';
        ripple.style.opacity = '0';
      });

      setTimeout(() => ripple.remove(), 600);
    });

    // Modifikasi Validasi & Animasi Loading
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      const username = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value.trim();
      
      // HANYA hentikan pengiriman form jika input kosong
      if (!username || !password) {
        e.preventDefault();
        return;
      }
      
      // Jika form terisi, tambahkan animasi loading dan biarkan form TERKIRIM
      btn.classList.add('loading');
    });
  </script>
</body>
</html>