@extends('layouts.app')

@section('title', 'Jurusan SIJA - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#F8F9FA] min-h-screen text-slate-800 font-sans">

    <!-- ==================== 1. HERO SECTION JURUSAN ==================== -->
    <section class="relative pt-32 sm:pt-40 pb-16 overflow-hidden bg-gradient-to-br from-[#EAEAEA] via-[#F4F4F4] to-white">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-gray-200/40 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Sisi Kiri: 3D Karakter / Bintang Jurusan di atas Podium -->
                <div class="lg:col-span-5 flex justify-center items-center" data-aos="zoom-in">
                    <div class="relative w-full max-w-[340px] sm:max-w-[380px]">
                        <img src="{{ asset('images/jurusan/jurusan.webp') }}" 
                             alt="3D Karakter Jurusan SMK Telkom Sidoarjo" 
                             class="w-full h-auto object-contain select-none drop-shadow-xl"
                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}';" loading="eager" decoding="async" fetchpriority="high" width="404" height="244">
                    </div>
                </div>

                <!-- Sisi Kanan: Teks & Headline Profil Jurusan -->
                <div class="lg:col-span-7 space-y-5 text-center lg:text-left" data-aos="fade-left">
                    <div class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500">
                        <span>Program</span>
                        <span>&gt;</span>
                        <span class="text-gray-900 font-bold">jurusan</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-[1.1] tracking-tight">
                        Profil <span style="color: #C8102E !important;">Jurusan</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-xl mx-auto lg:mx-0 font-normal">
                        PT Garuda Telekomunikasi Indonesia merupakan perusahaan yang bergerak di bidang telekomunikasi dan teknologi informasi. Perusahaan ini menyediakan layanan terintegrasi yang mencakup pengembangan dan pengelolaan infrastruktur telekomunikasi serta solusi teknologi informasi untuk mendukung kebutuhan operasional bisnis secara efektif dan berkelanjutan.
                    </p>

                    <div class="pt-2 flex justify-center lg:justify-start">
                        <a href="#kompetensi-detail" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
                            Jelajahi
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Garis Pemisah Aksen Merah Horizontal -->
    <div class="w-full flex justify-center py-6 bg-white">
        <div class="w-72 h-1.5 rounded-full" style="background-color: #C8102E !important;"></div>
    </div>

    <!-- ==================== 2. SECTION SWITCHER JURUSAN & CONTAINER KOMPETENSI ==================== -->
    <section id="kompetensi-detail" class="py-12 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
        
        <!-- Heading Atas -->
        <h2 class="text-2xl sm:text-3xl font-extrabold text-center text-slate-900 leading-snug mb-8">
            Membangun Kompetensi<br>Sesuai Minat dan Bakat Siswa.
        </h2>

        <!-- Switcher Toggle Group (Panah, SIJA, TJAT, Panah) -->
        <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mb-12 select-none">
            <a href="{{ route('jurusan.tjat') }}" class="w-9 h-9 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:text-[#C8102E] hover:border-[#C8102E] transition">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </a>

            <!-- Tombol SIJA (AKTIF MERAH TELKOM) -->
            <a href="{{ route('jurusan.sija') }}" 
               style="background-color: #C8102E !important; color: #ffffff !important;"
               class="px-6 sm:px-8 py-2.5 rounded-full font-bold text-xs sm:text-sm shadow-md transition-all">
                SIJA
            </a>

            <!-- Tombol TJAT (INAKTIF OUTLINE) -->
            <a href="{{ route('jurusan.tjat') }}" 
               class="px-6 sm:px-8 py-2.5 rounded-full border border-gray-300 text-gray-700 hover:text-[#C8102E] hover:border-[#C8102E] font-bold text-xs sm:text-sm bg-white transition-all">
                TJAT
            </a>

            <a href="{{ route('jurusan.tjat') }}" class="w-9 h-9 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:text-[#C8102E] hover:border-[#C8102E] transition">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </a>
        </div>

        <!-- BIG BORDERED CARD DASHED (SIJA DETAIL) -->
        <div class="border-2 border-dashed border-red-300 rounded-[2.5rem] p-6 sm:p-10 lg:p-12 bg-white/60 mb-12 shadow-sm space-y-12">
            
            <!-- ROW 1: DESKRIPSI SIJA (KIRI) & FOTO SISWI SIJA (KANAN) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Kiri: Penjelasan SIJA -->
                <div class="lg:col-span-8 space-y-4">
                    <h3 class="text-2xl sm:text-3xl font-extrabold leading-tight">
                        <span style="color: #C8102E !important;">Sistem Informasi</span><br>
                        <span class="text-slate-900">Jaringan Dan Aplikasi</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed font-normal text-justify">
                        Merupakan kompetensi keahlian baru berbasis Teknologi Informasi dan Komunikasi pada program keahlian Teknik Komputer dan Informatika yang mulai dibuka pada Tahun Pelajaran 2017/2018 untuk program pendidikan SMK dengan pembelajaran Empat (4) Tahun. Sesuai dengan Keputusan Dirjen Dikdasmen Kemendikbud Nomor: 4678/D/KEP/MK/2016
                    </p>
                    <p class="text-xs sm:text-sm font-bold text-slate-900 pt-2">
                        &bull; 4 Tahun Pembelajaran
                    </p>
                </div>

                <!-- Kanan: Foto Siswi SIJA Berhijab Tunjuk Atas (images/jurusan/sija.webp) -->
                <div class="lg:col-span-4 flex justify-center items-center">
                    <div class="relative w-full max-w-[240px] sm:max-w-[270px]">
                        <img src="{{ asset('images/jurusan/sija.webp') }}" 
                             alt="Siswi SIJA" 
                             class="w-full h-auto object-contain select-none drop-shadow-md"
                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}';" loading="eager" decoding="async" fetchpriority="high" width="233" height="331">
                    </div>
                </div>
            </div>

            <!-- ROW 2: GURU PRODUKTIF SIJA (KIRI) & APA AJA YANG DIPELAJARI (KANAN) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start pt-6 border-t border-gray-100">
                
                <!-- Kiri: Foto Guru Produktif SIJA - Ibu Ike Yuliastuti -->
                <div class="lg:col-span-4 flex flex-col items-center">
                    <div class="w-full max-w-[230px] rounded-3xl overflow-hidden border border-gray-200 shadow-sm bg-gray-50 flex flex-col items-center">
                        <div class="w-full h-64 overflow-hidden flex items-center justify-center bg-gray-100">
                            <img src="{{ asset('images/profileguru/ike.webp') }}" 
                                 alt="Ike Yuliastuti - Guru Produktif SIJA" 
                                 class="w-full h-full object-cover object-top"
                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}';" loading="lazy" decoding="async" width="212" height="270">
                        </div>
                        <!-- Badge Merah Solid -->
                        <div class="w-full py-2.5 px-3 text-center text-white" style="background-color: #8B0000 !important;">
                            <h5 class="text-xs font-bold leading-tight">Ike Yuliastuti</h5>
                            <p class="text-[10px] text-white/80 font-normal">Guru Produktif SIJA</p>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Apa aja yang dipelajari? (Grid 3 Kolom) -->
                <div class="lg:col-span-8 space-y-4">
                    <h4 class="text-base sm:text-lg font-bold text-slate-900">Apa aja yang dipelajari?</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($subjects as $subj)
                            <x-subject-card :name="$subj" />
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

        <!-- ==================== 3. BANNER: KESULITAN MENCARI JURUSAN YANG COCOK? ==================== -->
        <div class="border-2 border-dashed border-red-300 rounded-3xl p-6 sm:p-7 bg-white shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4 mb-20">
            <h4 class="text-sm sm:text-base font-bold text-slate-900 text-center sm:text-left">
                Kesulitan mencari jurusan yang cocok?
            </h4>
            <a href="{{ route('jurufind') }}" 
               style="background-color: #C8102E !important; color: #ffffff !important;"
               class="px-6 py-2.5 rounded-xl font-bold text-xs sm:text-sm hover:opacity-90 transition active:scale-95 shrink-0 shadow-sm">
                Pakai Jurufind Sekarang! ➔
            </a>
        </div>

    </section>

</div>
@endsection