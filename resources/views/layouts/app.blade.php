<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMK Telkom Sidoarjo')</title>
    <link rel="icon" href="{{ asset('images/home/favicon.webp') }}">
    {{-- Font self-hosted: preload agar teks tidak menunggu (no Google Fonts / gstatic) --}}
    <link rel="preload" href="{{ asset('fonts/plus-jakarta-sans-latin.woff2') }}" as="font" type="font/woff2" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#FBFBFB] text-slate-800 font-sans antialiased selection:bg-red-700 selection:text-white flex flex-col min-h-screen">

<!-- ==================== HEADER & NAVBAR RESPONSIF ==================== -->
<header class="fixed top-2 sm:top-4 left-0 right-0 z-50 px-3 sm:px-6">
    <div class="max-w-7xl mx-auto bg-white/95 backdrop-blur-md rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.08)] px-3 sm:px-6 lg:px-8 h-14 sm:h-16 flex items-center justify-between border border-gray-100 relative">

      <!-- Brand Logo -->
      <a href="{{ url('/#beranda') }}" class="flex items-center gap-2 sm:gap-3 group shrink-0">
        <img src="{{ asset('images/home/favicon.webp') }}" alt="Logo SMK Telkom Sidoarjo" class="w-8 h-8 sm:w-10 sm:h-10 object-contain" loading="eager" decoding="async" fetchpriority="high" width="423" height="415">
        <div class="flex flex-col leading-tight">
          <span class="text-xs sm:text-sm font-extrabold text-gray-900 tracking-tight">SMK Telkom</span>
          <span class="text-[10px] sm:text-xs text-gray-500 font-semibold tracking-wide">Sidoarjo</span>
        </div>
      </a>

      <!-- Desktop Navigation (Tampil di Layar 1024px+) -->
      <nav class="hidden lg:flex items-center gap-3 lg:gap-4 xl:gap-8 text-[13px] xl:text-sm font-medium text-gray-600 min-w-0">
        <a href="{{ url('/#beranda') }}" class="whitespace-nowrap hover:text-red-700 transition {{ request()->routeIs('home') ? 'text-red-700 font-bold' : 'text-gray-700 font-medium' }}">Beranda</a>

        <!-- Dropdown: Tentang kami -->
        <div class="relative group py-2">
          <button class="flex items-center gap-1.5 py-1 whitespace-nowrap transition {{ request()->routeIs('profile-sekolah.*') || request()->routeIs('mitra-industri.*') || request()->routeIs('fasilitas.*') || request()->routeIs('prestasi.*') || request()->routeIs('profil-guru.*') ? 'text-red-700 font-bold' : 'hover:text-red-700 font-medium text-gray-700' }}">
            <span>Tentang kami</span>
            <i data-lucide="chevron-down" class="w-3.5 h-3.5 group-hover:rotate-180 group-hover:text-red-700 transition {{ request()->routeIs('profile-sekolah.*') || request()->routeIs('mitra-industri.*') || request()->routeIs('fasilitas.*') || request()->routeIs('prestasi.*') || request()->routeIs('profil-guru.*') ? 'text-red-700' : 'text-gray-500' }}"></i>
          </button>
          <div class="absolute top-full left-0 pt-2 hidden group-hover:block group-focus-within:block z-50">
            <div class="w-60 max-w-[calc(100vw-2rem)] bg-white rounded-xl shadow-xl border border-gray-100 py-2.5">
              <a href="{{ route('profile-sekolah.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('profile-sekolah.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="school" class="w-4 h-4 text-red-600"></i> Profile Sekolah
              </a>
              <a href="{{ route('mitra-industri.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('mitra-industri.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="briefcase" class="w-4 h-4 text-red-600"></i> Hubungan Industri
              </a>
              <a href="{{ route('fasilitas.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('fasilitas.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="monitor" class="w-4 h-4 text-red-600"></i> Fasilitas
              </a>
              <a href="{{ route('prestasi.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('prestasi.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="trophy" class="w-4 h-4 text-red-600"></i> Prestasi
              </a>
              <a href="{{ route('profil-guru.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('profil-guru.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="users" class="w-4 h-4 text-red-600"></i> Profil Guru
              </a>
            </div>
          </div>
        </div>

        <!-- Button: JURUFIND -->
        <a href="/jurufind" class="px-4 xl:px-5 py-2 text-xs font-bold text-white bg-red-700 rounded-full hover:bg-red-800 transition shadow-sm flex items-center gap-1.5 active:scale-95 whitespace-nowrap">
          <i data-lucide="compass" class="w-3.5 h-3.5"></i> <span>JURUFIND</span>
        </a>

        <!-- Dropdown: Program -->
        <div class="relative group py-2">
          <button class="flex items-center gap-1.5 py-1 whitespace-nowrap transition {{ request()->routeIs('jurusan.*') || request()->routeIs('ekstrakurikuler.*') || request()->routeIs('digital-talent.*') || request()->routeIs('program-ccp.*') || request()->routeIs('program-ts21.*') ? 'text-red-700 font-bold' : 'hover:text-red-700 font-medium text-gray-700' }}">
            <span>Program</span>
            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-gray-500 group-hover:rotate-180 group-hover:text-red-700 transition"></i>
          </button>
          <div class="absolute top-full left-0 pt-2 hidden group-hover:block group-focus-within:block z-50">
            <div class="w-56 max-w-[calc(100vw-2rem)] bg-white rounded-xl shadow-xl border border-gray-100 py-2">
              <a href="{{ route('jurusan.sija') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('jurusan.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="graduation-cap" class="w-4 h-4 text-red-600"></i> Profil Jurusan
              </a>
              <a href="{{ route('ekstrakurikuler.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('ekstrakurikuler.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="trophy" class="w-4 h-4 text-red-600"></i> Ekstrakurikuler
              </a>
              <a href="{{ route('digital-talent.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('digital-talent.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="sparkles" class="w-4 h-4 text-red-600"></i> DTP (Digital Talent)
              </a>
                  <a href="{{ route('program-ccp.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('program-ccp.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="code-2" class="w-4 h-4 text-red-600"></i> Program CCP
              </a>
              <a href="{{ route('program-ts21.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('program-ts21.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="layers" class="w-4 h-4 text-red-600"></i> Program TS21
              </a>
            </div>
          </div>
        </div>

        <!-- Dropdown: Informasi -->
        <div class="relative group py-2">
          <button class="flex items-center gap-1.5 py-1 whitespace-nowrap transition {{ request()->routeIs('berita.*') || request()->routeIs('alumni.*') || request()->routeIs('penerapan-k3.*') || request()->routeIs('trial-class.*') ? 'text-red-700 font-bold' : 'hover:text-red-700 font-medium text-gray-700' }}">
            <span>Informasi</span>
            <i data-lucide="chevron-down" class="w-3.5 h-3.5 group-hover:rotate-180 group-hover:text-red-700 transition {{ request()->routeIs('berita.*') || request()->routeIs('alumni.*') || request()->routeIs('penerapan-k3.*') || request()->routeIs('trial-class.*') ? 'text-red-700' : 'text-gray-500' }}"></i>
          </button>
          <div class="absolute top-full right-0 lg:right-auto lg:left-0 pt-2 hidden group-hover:block group-focus-within:block z-50">
            <div class="w-56 max-w-[calc(100vw-2rem)] bg-white rounded-xl shadow-xl border border-gray-100 py-2">
              <a href="{{ route('berita.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('berita.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="newspaper" class="w-4 h-4 text-red-600"></i> Berita &amp; Artikel
              </a>
              <a href="{{ route('alumni.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('alumni.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="user-check" class="w-4 h-4 text-red-600"></i> Informasi Alumni
              </a>
              <a href="{{ route('penerapan-k3.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('penerapan-k3.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="shield-check" class="w-4 h-4 text-red-600"></i> Penerapan K3
              </a>
              <a href="{{ route('trial-class.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-sm font-semibold {{ request()->routeIs('trial-class.*') ? 'text-red-700 bg-red-50 font-bold' : 'text-gray-700' }}">
                <i data-lucide="laptop" class="w-4 h-4 text-red-600"></i> Trial Class
              </a>
            </div>
          </div>
        </div>

        <!-- Career Center -->
        <a href="{{ route('career-center.index') }}" class="whitespace-nowrap hover:text-red-700 transition {{ request()->routeIs('career-center.*') ? 'text-red-700 font-bold' : 'text-gray-700 font-medium' }}">
          Career Center
        </a>
      </nav>

      <!-- Kanan: Tombol PPDB & Hamburger Mobile -->
      <div class="flex items-center gap-2 sm:gap-3 shrink-0">
        <a href="/ppdb" class="px-4 sm:px-8 py-2 text-xs sm:text-sm font-bold text-white bg-red-700 rounded-full shadow-md hover:bg-red-800 transition transform hover:scale-105 active:scale-95 inline-flex items-center whitespace-nowrap">
          PPDB
        </a>

        <!-- Tombol Hamburger Mobile -->
        <button id="mobileMenuBtn" type="button" aria-label="Buka Menu" aria-controls="mobileMenuDropdown" aria-expanded="false" class="lg:hidden p-2 rounded-xl text-gray-700 hover:text-red-700 hover:bg-red-50 transition focus:outline-none">
          <i id="menuIconOpen" data-lucide="menu" class="w-6 h-6"></i>
        </button>
      </div>

    </div>

    <!-- ==================== MOBILE MENU DRAWER (SUPER RESPONSIF UNTUK HP) ==================== -->
    <div id="mobileMenuDropdown" class="hidden lg:hidden max-w-7xl mx-auto mt-2 bg-white/98 backdrop-blur-lg rounded-3xl shadow-2xl border border-gray-100 overflow-hidden transition-all duration-300">
      <div class="p-5 space-y-4 max-h-[78vh] overflow-y-auto">

        <a href="{{ url('/#beranda') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-bold text-gray-800 hover:bg-red-50 hover:text-red-700 transition">
          <span>Beranda</span>
          <i data-lucide="arrow-right" class="w-4 h-4 text-gray-400"></i>
        </a>

        <!-- Mobile Group: Tentang Kami -->
        <div class="border-t border-gray-100 pt-3">
          <span class="block px-3 py-1 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Tentang Kami</span>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 mt-1">
            <a href="{{ route('profile-sekolah.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="school" class="w-4 h-4 text-red-600 shrink-0"></i> Profil Sekolah
            </a>
            <a href="{{ route('mitra-industri.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="briefcase" class="w-4 h-4 text-red-600 shrink-0"></i> Hubungan Industri
            </a>
            <a href="{{ route('fasilitas.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="monitor" class="w-4 h-4 text-red-600 shrink-0"></i> Fasilitas
            </a>
            <a href="{{ route('prestasi.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="trophy" class="w-4 h-4 text-red-600 shrink-0"></i> Prestasi
            </a>
            <a href="{{ route('profil-guru.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="users" class="w-4 h-4 text-red-600 shrink-0"></i> Profil Guru
            </a>
          </div>
        </div>

        <!-- Mobile Group: Program -->
        <div class="border-t border-gray-100 pt-3">
          <span class="block px-3 py-1 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Program Kejuruan &amp; Tes</span>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 mt-1">
            <a href="{{ route('jurusan.sija') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="graduation-cap" class="w-4 h-4 text-red-600 shrink-0"></i> Jurusan SIJA &amp; TJAT
            </a>
            <a href="{{ route('ekstrakurikuler.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="trophy" class="w-4 h-4 text-red-600 shrink-0"></i> Ekstrakurikuler
            </a>
            <a href="{{ route('digital-talent.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="sparkles" class="w-4 h-4 text-red-600 shrink-0"></i> DTP (Digital Talent)
            </a>
            <a href="{{ route('program-ccp.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="code-2" class="w-4 h-4 text-red-600 shrink-0"></i> Program CCP
            </a>
            <a href="{{ route('program-ts21.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="layers" class="w-4 h-4 text-red-600 shrink-0"></i> Program TS21
            </a>
            <a href="/jurufind" class="px-3 py-2 rounded-lg text-xs font-bold text-white bg-red-700 hover:bg-red-800 flex items-center gap-2">
              <i data-lucide="compass" class="w-4 h-4 shrink-0"></i> Tes Minat Bakat (JURUFIND)
            </a>
          </div>
        </div>

        <!-- Mobile Group: Informasi -->
        <div class="border-t border-gray-100 pt-3">
          <span class="block px-3 py-1 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Informasi Publik</span>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 mt-1">
            <a href="{{ route('berita.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="newspaper" class="w-4 h-4 text-red-600 shrink-0"></i> Berita &amp; Artikel
            </a>
            <a href="{{ route('alumni.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="user-check" class="w-4 h-4 text-red-600 shrink-0"></i> Informasi Alumni
            </a>
            <a href="{{ route('penerapan-k3.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="shield-check" class="w-4 h-4 text-red-600 shrink-0"></i> Penerapan K3
            </a>
            <a href="{{ route('trial-class.index') }}" class="px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
              <i data-lucide="laptop" class="w-4 h-4 text-red-600 shrink-0"></i> Trial Class
            </a>
          </div>
        </div>

        <!-- Mobile Career Center -->
        <div class="border-t border-gray-100 pt-3 pb-1">
          <a href="{{ route('career-center.index') }}" class="block px-4 py-2.5 rounded-xl text-center text-xs font-bold text-red-700 bg-red-50 border border-red-200">
            Kunjungi Portal Career Center &rarr;
          </a>
        </div>

      </div>
    </div>
</header>

<!-- ==================== KONTEN UTAMA ==================== -->
<main class="flex-grow">
    @yield('content')
</main>

<!-- ==================== FOOTER RESPONSIF ==================== -->
<footer id="kontak" class="bg-white pt-14 pb-10 text-gray-600 text-sm border-t border-gray-100 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-10">

        <!-- Identitas Sekolah (Sangat mudah dihubungi ortu dari HP) -->
        <div class="lg:col-span-4 space-y-4">
          <div class="flex items-center gap-3">
            <img src="{{ asset('images/home/favicon.webp') }}" alt="Logo" class="w-10 h-10 object-contain shrink-0" loading="eager" decoding="async" fetchpriority="high" width="423" height="415">
            <div class="flex flex-col leading-tight">
              <span class="text-base font-extrabold text-gray-900 tracking-tight">SMK Telkom</span>
              <span class="text-xs text-gray-500 font-semibold tracking-wide">Sidoarjo</span>
            </div>
          </div>
          <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">Bersama SMK Telkom Sidoarjo, jadilah generasi tangguh, berakhlak, dan berwawasan digital.</p>
          <div class="space-y-2 text-xs sm:text-sm text-gray-700 pt-1">
            <a href="mailto:informasi@smktelkom-sda.sch.id" class="flex items-center gap-2.5 hover:text-red-700 transition">
              <i data-lucide="mail" class="w-4 h-4 text-red-700 shrink-0"></i> <span class="break-all">informasi@smktelkom-sda.sch.id</span>
            </a>
            <!-- Tombol WA Aktif (Klik langsung buka chat WA) -->
            <a href="https://wa.me/628113021919" target="_blank" class="flex items-center gap-2.5 hover:text-red-700 font-semibold text-gray-900 transition">
              <i data-lucide="phone" class="w-4 h-4 text-red-700 shrink-0"></i> <span>0811-3021-919 (WhatsApp Resmi)</span>
            </a>
            <div class="flex items-start gap-2.5">
              <i data-lucide="map-pin" class="w-4 h-4 text-red-700 shrink-0 mt-0.5"></i>
              <span class="leading-relaxed text-xs">Jl. Raya Pecantingan Sekardangan, Sidoarjo, Jawa Timur</span>
            </div>
          </div>
          <!-- Logo Partner Footer -->
          <div class="grid grid-cols-5 gap-2 pt-2 items-center max-w-xs">
            <img src="{{ asset('images/footer/1. LOGO JHIC 2.0 1.webp') }}" alt="JHIC" class="h-6 w-auto object-contain" loading="lazy" decoding="async" width="57" height="27">
            <img src="{{ asset('images/footer/2. Logo Jagoan Hosting 1.webp') }}" alt="Jagoan" class="h-6 w-auto object-contain" loading="lazy" decoding="async" width="57" height="18">
            <img src="{{ asset('images/footer/3. KOMDIGI 1.webp') }}" alt="Komdigi" class="h-6 w-auto object-contain" loading="lazy" decoding="async" width="47" height="34">
            <img src="{{ asset('images/footer/4. Garuda Spark Full Color 1.webp') }}" alt="Garuda" class="h-6 w-auto object-contain" loading="lazy" decoding="async" width="57" height="31">
            <img src="{{ asset('images/footer/5. LOGO NGALUP 1.webp') }}" alt="Ngalup" class="h-6 w-auto object-contain" loading="lazy" decoding="async" width="57" height="9">
          </div>
          <p class="text-[11px] text-gray-400 pt-2">Copyright &copy; {{ date('Y') }} All right reserved | SKOMDA</p>
        </div>

        <!-- Menu Utama -->
        <div class="lg:col-span-2 space-y-3">
          <h4 class="text-xs sm:text-sm font-bold text-gray-900 uppercase tracking-wider">Menu Utama</h4>
          <ul class="space-y-2 text-xs sm:text-sm">
            <li><a href="{{ url('/#beranda') }}" class="hover:text-red-700 transition">Beranda</a></li>
            <li><a href="{{ route('profile-sekolah.index') }}" class="hover:text-red-700 transition">Profil Sekolah</a></li>
            <li><a href="{{ url('/#jurusan') }}" class="hover:text-red-700 transition">Profil Jurusan</a></li>
            <li><a href="{{ url('/jurufind') }}" class="hover:text-red-700 transition">Tes Minat Bakat</a></li>
            <li><a href="{{ url('/ppdb') }}" class="hover:text-red-700 transition font-bold text-red-700">PPDB</a></li>
          </ul>
        </div>

        <!-- Berita Sekolah -->
        <div class="lg:col-span-3 space-y-3">
          <h4 class="text-xs sm:text-sm font-bold text-gray-900 uppercase tracking-wider">Berita &amp; Aktivitas:</h4>
          <ul class="space-y-2 text-xs sm:text-sm">
            <li><a href="{{ route('berita.index') }}" class="hover:text-red-700 transition">Kegiatan Sekolah</a></li>
            <li><a href="{{ route('prestasi.index') }}" class="hover:text-red-700 transition">Prestasi</a></li>
            <li><a href="{{ route('mitra-industri.index') }}" class="hover:text-red-700 transition">Kemitraan Industri</a></li>
            <li><a href="{{ route('fasilitas.index') }}" class="hover:text-red-700 transition">Fasilitas</a></li>
            <li><a href="{{ route('career-center.index') }}" class="hover:text-red-700 transition">Career Center</a></li>
          </ul>
        </div>

        <!-- Google Maps -->
        <div class="lg:col-span-3 space-y-3">
          <h4 class="text-xs sm:text-sm font-bold text-gray-900 uppercase tracking-wider">Lokasi Sekolah</h4>
          <div class="rounded-2xl overflow-hidden border border-gray-200 h-36 sm:h-40 bg-gray-100">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.3331718817345!2d112.72382461019685!3d-7.428315273142277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e6b528b97d2d%3A0xb35359a60e03cfec!2sSMK%20Telkom%20Sidoarjo!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
</footer>

<script>
    // Ikon Lucide & AOS diinisialisasi dari resources/js/app.js (bundle Vite)

    // Toggle Mobile Drawer
    document.addEventListener('DOMContentLoaded', function() {
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileDropdown = document.getElementById('mobileMenuDropdown');

        if (mobileBtn && mobileDropdown) {
            // Sinkronkan atribut aksesibilitas dengan status tampil/sembunyi.
            const setExpanded = (isOpen) => {
                mobileBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                mobileBtn.setAttribute('aria-label', isOpen ? 'Tutup Menu' : 'Buka Menu');
            };

            mobileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const willOpen = mobileDropdown.classList.contains('hidden');
                mobileDropdown.classList.toggle('hidden');
                setExpanded(willOpen);
            });

            // Tutup dropdown saat user klik area di luar menu
            document.addEventListener('click', function(e) {
                if (!mobileDropdown.contains(e.target) && !mobileBtn.contains(e.target)) {
                    mobileDropdown.classList.add('hidden');
                    setExpanded(false);
                }
            });

            // Tutup drawer otomatis saat layar diperbesar ke desktop (>= 1024px),
            // agar tidak "nyangkut" terbuka saat rotate/resize.
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024 && !mobileDropdown.classList.contains('hidden')) {
                    mobileDropdown.classList.add('hidden');
                    setExpanded(false);
                }
            });
        }
    });
</script>

{{-- Widget chatbot global: muncul di semua halaman --}}
    <x-chatbot-widget />
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
    <script src="{{ asset('assets/js/chatbot.js') }}" defer></script>

@stack('scripts')
</body>
</html>
