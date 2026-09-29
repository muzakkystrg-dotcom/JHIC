<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMK Telkom Sidoarjo')</title>
    <link rel="icon" href="{{ asset('images/home/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.546.0/dist/umd/lucide.min.js"></script>
    <script src="{{ asset('assets/js/home.js') }}" defer></script>
    @stack('styles')
</head>
<body class="bg-[#FBFBFB] text-slate-800 font-sans antialiased selection:bg-red-700 selection:text-white">

<header class="fixed top-4 left-0 right-0 z-50 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.08)] px-6 sm:px-10 h-16 flex items-center justify-between">
      <!-- Brand Logo -->
      <a href="{{ url('/#beranda') }}" class="flex items-center gap-3 group">
        <img src="{{ asset('images/home/favicon.png') }}" alt="Logo SMK Telkom Sidoarjo" class="w-10 h-10 object-contain" />
        <div class="flex flex-col leading-tight">
          <span class="text-sm font-extrabold text-gray-900 tracking-tight">SMK Telkom</span>
          <span class="text-xs text-gray-500 font-semibold tracking-wide">Sidoarjo</span>
        </div>
      </a>

      <!-- Desktop Navigation -->
      <nav class="hidden lg:flex items-center gap-8 text-sm font-medium text-gray-600">
        <a href="{{ url('/#beranda') }}" class="text-red-700 font-bold hover:text-red-800 transition">Beranda</a>

        <!-- Dropdown: Tentang kami -->
        <div class="relative group py-2">
          <button class="flex items-center gap-1.5 hover:text-red-700 py-1 transition font-medium text-gray-700 {{ request()->routeIs('profile-sekolah.index') || request()->routeIs('mitra-industri.*') || request()->routeIs('fasilitas.*') || request()->routeIs('prestasi.*') || request()->routeIs('profil-guru.*') ? 'text-red-700 font-bold' : '' }}">
            <span>Tentang kami</span>
            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-gray-500 group-hover:rotate-180 group-hover:text-red-700 transition"></i>
          </button>
          
          <!-- Dropdown Wrapper dengan Hover Bridge -->
          <div class="absolute top-full left-0 pt-2 hidden group-hover:block z-50">
            <div class="w-60 bg-white rounded-xl shadow-xl border border-gray-100 py-2.5">
              
              <!-- Link Profil Sekolah -->
              <a href="{{ route('profile-sekolah.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('profile-sekolah.index') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="school" class="w-4 h-4 text-red-600"></i>
                Profile Sekolah
              </a>

              <!-- Link Hubungan Industri -->
              <a href="{{ route('mitra-industri.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('mitra-industri.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="briefcase" class="w-4 h-4 text-red-600"></i>
                Hubungan Industri
              </a>

              <!-- Link Fasilitas -->
              <a href="{{ route('fasilitas.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('fasilitas.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="monitor" class="w-4 h-4 text-red-600"></i>
                Fasilitas
              </a>

              <!-- Link Prestasi -->
              <a href="{{ route('prestasi.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('prestasi.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="trophy" class="w-4 h-4 text-red-600"></i>
                Prestasi
              </a>

              <!-- Link Profil Guru (Baru Ditambahkan) -->
              <a href="{{ route('profil-guru.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('profil-guru.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="users" class="w-4 h-4 text-red-600"></i>
                Profil Guru
              </a>

            </div>
          </div>
        </div>

        <!-- Button: JURUFIND -->
        <a href="/jurufind"
          class="px-6 py-2.5 text-sm font-bold text-white bg-red-700 rounded-full hover:bg-red-800 transition shadow-sm flex items-center gap-1.5 active:scale-95">
          <i data-lucide="compass" class="w-3.5 h-3.5"></i>
          <span>JURUFIND</span>
        </a>

        <!-- Dropdown: Program -->
        <div class="relative group py-2">
          <button class="flex items-center gap-1.5 hover:text-red-700 py-1 transition font-medium text-gray-700">
            <span>Program</span>
            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-gray-500 group-hover:rotate-180 group-hover:text-red-700 transition"></i>
          </button>
          <div class="absolute top-full left-0 pt-2 hidden group-hover:block z-50">
            <div class="w-64 bg-white rounded-xl shadow-xl border border-gray-100 py-2">
              <button onclick="openProgramDetail('SIJA')" class="w-full text-left px-4 py-2.5 hover:bg-red-50 hover:text-red-700 text-sm font-semibold text-gray-700 flex flex-col">
                <span class="font-bold text-gray-900">SIJA (4 Tahun)</span>
                <span class="text-[11px] text-gray-500 font-normal">Sistem Informasi Jaringan &amp; Aplikasi</span>
              </button>
              <button onclick="openProgramDetail('TJAT')" class="w-full text-left px-4 py-2.5 hover:bg-red-50 hover:text-red-700 text-sm font-semibold text-gray-700 flex flex-col border-t border-gray-50">
                <span class="font-bold text-gray-900">TJAT (3 Tahun)</span>
                <span class="text-[11px] text-gray-500 font-normal">Teknik Jaringan Akses Telekomunikasi</span>
              </button>
            </div>
          </div>
        </div>

        <!-- Dropdown: Informasi -->
        <div class="relative group py-2">
          <button class="flex items-center gap-1.5 hover:text-red-700 py-1 transition font-medium text-gray-700">
            <span>Informasi</span>
            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-gray-500 group-hover:rotate-180 group-hover:text-red-700 transition"></i>
          </button>
          <div class="absolute top-full left-0 pt-2 hidden group-hover:block z-50">
            <div class="w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2">
              <a href="{{ url('/#berita') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold text-gray-700">
                <i data-lucide="book-open" class="w-4 h-4 text-red-600"></i>
                Berita &amp; Artikel Terkini
              </a>
              <a href="{{ url('/#partner') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold text-gray-700">
                <i data-lucide="sparkles" class="w-4 h-4 text-red-600"></i>
                Mitra Industri &amp; BKK
              </a>
              <a href="{{ url('/#kontak') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold text-gray-700">
                <i data-lucide="phone-call" class="w-4 h-4 text-red-600"></i>
                Kontak &amp; Layanan Sekolah
              </a>
            </div>
          </div>
        </div>
      </nav>

      <!-- PPDB Button -->
      <a href="/ppdb"
        class="px-10 py-2.5 text-sm font-bold text-white bg-red-700 rounded-full shadow-lg hover:bg-red-800 transition transform hover:scale-105 active:scale-95 inline-flex items-center">
        PPDB
      </a>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer id="kontak" class="bg-white pt-16 pb-10 text-gray-600 text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">
        <!-- Kolom 1: Brand & Kontak -->
        <div class="lg:col-span-4 space-y-4">
          <div class="flex items-center gap-3">
            <img src="{{ asset('images/home/favicon.png') }}" alt="Logo SMK Telkom Sidoarjo" class="w-10 h-10 object-contain" />
            <div class="flex flex-col leading-tight">
              <span class="text-base font-extrabold text-gray-900 tracking-tight">SMK Telkom</span>
              <span class="text-xs text-gray-500 font-semibold tracking-wide">Sidoarjo</span>
            </div>
          </div>
          <p class="text-sm text-gray-600 leading-relaxed">Bersama SMK Telkom Sidoarjo, jadilah generasi tangguh, berakhlak, dan berwawasan digital.</p>
          <div class="space-y-2.5 text-sm text-gray-700 pt-1">
            <a href="mailto:informasi@smktelkom-sda.sch.id" class="flex items-center gap-2.5 hover:text-red-700 transition">
              <i data-lucide="mail" class="w-4 h-4 text-red-700 shrink-0"></i>
              <span>informasi@smktelkom-sda.sch.id</span>
            </a>
            <a href="https://wa.me/628113021919" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 hover:text-red-700 transition">
              <i data-lucide="phone" class="w-4 h-4 text-red-700 shrink-0"></i>
              <span>0811-3021-919</span>
            </a>
            <div class="flex items-start gap-2.5">
              <i data-lucide="map-pin" class="w-4 h-4 text-red-700 shrink-0 mt-0.5"></i>
              <span class="leading-relaxed">Jl. Raya Pecantingan Sekardangan, Kabupaten Sidoarjo, Jawa Timur</span>
            </div>
          </div>

          <!-- Logo-logo Mitra di Footer -->
          <div class="grid grid-cols-3 sm:grid-cols-5 gap-3 pt-3 items-center max-w-sm">
            <img src="{{ asset('images/footer/1. LOGO JHIC 2.0 1.png') }}" alt="Logo JHIC" class="h-7 w-auto object-contain">
            <img src="{{ asset('images/footer/2. Logo Jagoan Hosting 1.png') }}" alt="Logo Jagoan Hosting" class="h-7 w-auto object-contain">
            <img src="{{ asset('images/footer/3. KOMDIGI 1.png') }}" alt="Logo Komdigi" class="h-7 w-auto object-contain">
            <img src="{{ asset('images/footer/4. Garuda Spark Full Color 1.png') }}" alt="Logo Garuda Spark" class="h-7 w-auto object-contain">
            <img src="{{ asset('images/footer/5. LOGO NGALUP 1.png') }}" alt="Logo Ngalup" class="h-7 w-auto object-contain">
          </div>

          <p class="text-[11px] text-gray-400 pt-2">Copyright © 2026 All right reserved | SKOMDA</p>
        </div>

        <!-- Kolom 2: Menu Utama -->
        <div class="lg:col-span-2 space-y-3">
          <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Menu Utama</h4>
          <ul class="space-y-2.5 text-sm">
            <li><a href="{{ url('/#beranda') }}" class="hover:text-red-700 transition">Beranda</a></li>
            <li><a href="{{ route('profile-sekolah.index') }}" class="hover:text-red-700 transition">Profil Sekolah</a></li>
            <li><a href="{{ url('/#jurusan') }}" class="hover:text-red-700 transition">Profil Jurusan</a></li>
            <li><a href="{{ url('/jurufind') }}" class="hover:text-red-700 transition">Tes Minat Bakat</a></li>
            <li><a href="/ppdb" class="hover:text-red-700 transition font-bold">PPDB</a></li>
          </ul>
        </div>

        <!-- Kolom 3: Berita Sekolah -->
        <div class="lg:col-span-3 space-y-3">
          <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Berita Sekolah:</h4>
          <ul class="space-y-2.5 text-sm">
            <li><a href="{{ url('/#berita') }}" class="hover:text-red-700 transition">Kegiatan Sekolah</a></li>
            <li><a href="{{ route('prestasi.index') }}" class="hover:text-red-700 transition">Prestasi</a></li>
            <li><a href="{{ url('/#berita') }}" class="hover:text-red-700 transition">Karya &amp; Inovasi</a></li>
            <li><a href="{{ url('/#alumni') }}" class="hover:text-red-700 transition">Alumni</a></li>
            <li><a href="{{ route('mitra-industri.index') }}" class="hover:text-red-700 transition">Kemitraan &amp; Kerjasama</a></li>
            <li><a href="{{ route('fasilitas.index') }}" class="hover:text-red-700 transition">Fasilitas</a></li>
          </ul>
        </div>

        <!-- Kolom 4: Lokasi Sekolah -->
        <div class="lg:col-span-3 space-y-3">
          <div class="flex items-center justify-between">
            <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Lokasi Sekolah</h4>
            <a href="https://maps.google.com/?q=SMK+Telkom+Sidoarjo" target="_blank" rel="noopener noreferrer" class="text-xs text-red-700 hover:underline flex items-center gap-1 font-bold">
              <span>Buka Google Maps</span>
              <i data-lucide="external-link" class="w-3 h-3"></i>
            </a>
          </div>
          <div class="rounded-2xl overflow-hidden border border-gray-200 h-40 bg-gray-100">
            <iframe title="Peta Lokasi SMK Telkom Sidoarjo"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.3331718817345!2d112.72382461019685!3d-7.428315273142277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e6b528b97d2d%3A0xb35359a60e03cfec!2sSMK%20Telkom%20Sidoarjo!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
              class="w-full h-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>

      <!-- Sub-row: Aplikasi Siswa & Statistik -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-10 mt-10 border-t border-gray-100 text-xs">
        <div>
          <h5 class="font-bold text-gray-900 mb-2">Aplikasi Siswa</h5>
          <div class="flex flex-wrap items-center gap-2.5 text-gray-500 font-medium">
            <span class="hover:text-red-700 underline cursor-pointer">DigiYouth</span><span>•</span>
            <span class="hover:text-red-700 underline cursor-pointer">MyLms</span><span>•</span>
            <span class="hover:text-red-700 underline cursor-pointer">SiAkad</span><span>•</span>
            <span class="hover:text-red-700 underline cursor-pointer">Invert</span>
          </div>
        </div>
        <div>
          <h5 class="font-bold text-gray-900 mb-2">Statistik Pengunjung</h5>
          <p class="text-gray-600 space-x-1">
            <span>Pengunjung Hari Ini: <b class="text-gray-800">142</b></span><span class="text-gray-300">|</span>
            <span>Bulan Ini: <b class="text-gray-800">3,890</b></span><span class="text-gray-300">|</span>
            <span>Tahun Ini: <b class="text-gray-800">45,210</b></span>
          </p>
        </div>
      </div>
    </div>
</footer>

<script>
    if (window.lucide) {
        lucide.createIcons();
    }
</script>

@stack('scripts')
</body>
</html>