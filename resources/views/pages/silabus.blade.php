@extends('layouts.app')

@section('title', 'Silabus Pembelajaran ' . $silabus['code'] . ' - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#F8F9FA] min-h-screen text-slate-800 font-sans pt-32 sm:pt-36 pb-24 overflow-x-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- ==================== 1. HEADER NAVIGASI BALIK (BACK PILL BUTTON) ==================== -->
        <div class="mb-6" data-aos="fade-right">
            <a href="{{ route('career-center.index') }}" 
               style="background-color: #B91C1C !important; color: #ffffff !important;"
               class="px-5 py-2 rounded-full font-semibold text-xs sm:text-sm inline-flex items-center gap-2 hover:opacity-90 transition shadow-sm active:scale-95">
                <span class="text-sm font-bold">&larr;</span>
                <span>Program &gt; Career Center</span>
            </a>
        </div>

        <!-- ==================== 2. KARTU IDENTITAS PROGRAM JURUSAN ==================== -->
        <div class="border border-red-300 rounded-2xl py-4 px-6 text-center bg-white shadow-sm max-w-4xl mx-auto mb-6" data-aos="fade-up">
            <h2 class="text-sm sm:text-base font-bold text-gray-900 tracking-tight">
                {{ $silabus['title'] }}
            </h2>
            <p class="text-[11px] sm:text-xs text-gray-500 font-medium mt-0.5">
                {{ $silabus['duration'] }}
            </p>
        </div>

        <!-- ==================== 3. BIG BANNER MERAH TELKOM (HERO JURUSAN) ==================== -->
        <div class="rounded-3xl p-6 sm:p-10 text-white relative overflow-hidden shadow-lg max-w-5xl mx-auto mb-8" 
             style="background-color: #B91C1C !important;" data-aos="zoom-in">
            <div class="grid grid-cols-1 {{ !empty($silabus['hero_image']) ? 'md:grid-cols-12' : '' }} gap-6 items-center relative z-10">
                
                <!-- Teks Banner -->
                <div class="{{ !empty($silabus['hero_image']) ? 'md:col-span-8' : '' }} space-y-3 text-left">
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white">
                        {{ $silabus['code'] }}
                    </h1>
                    <p class="text-xs sm:text-sm text-white/95 leading-relaxed font-normal text-justify">
                        {{ $silabus['hero_desc'] }}
                    </p>
                </div>

                <!-- Foto Siswi Hero (Hanya untuk SIJA Sesuai Figma) -->
                @if(!empty($silabus['hero_image']))
                    <div class="md:col-span-4 flex justify-center items-center">
                        <div class="w-full max-w-[220px] sm:max-w-[260px] aspect-square rounded-2xl overflow-hidden flex items-center justify-center">
                            <img src="{{ $silabus['hero_image'] }}" 
                                 alt="{{ $silabus['code'] }}" 
                                 class="w-full h-full object-contain select-none drop-shadow-md">
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <!-- ==================== 4. TIGA KARTU SPESIFIKASI BERBINGKAI DASHED ==================== -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6 max-w-5xl mx-auto mb-16" data-aos="fade-up">
            
            <!-- Card 1: Peluang Karir -->
            <div class="border border-dashed border-red-400 rounded-2xl p-4 sm:p-5 bg-white flex items-center gap-4 hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-red-600 shrink-0">
                    <i data-lucide="briefcase" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-900 mb-0.5">Peluang Karir</h4>
                    <p class="text-[11px] sm:text-xs text-gray-500 font-medium leading-snug">
                        {{ $silabus['spec_career'] }}
                    </p>
                </div>
            </div>

            <!-- Card 2: Kompetensi -->
            <div class="border border-dashed border-red-400 rounded-2xl p-4 sm:p-5 bg-white flex items-center gap-4 hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-red-600 shrink-0">
                    <i data-lucide="cpu" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-900 mb-0.5">Kompetensi</h4>
                    <p class="text-[11px] sm:text-xs text-gray-500 font-medium leading-snug">
                        {{ $silabus['spec_competency'] }}
                    </p>
                </div>
            </div>

            <!-- Card 3: Jalur Lanjutan -->
            <div class="border border-dashed border-red-400 rounded-2xl p-4 sm:p-5 bg-white flex items-center gap-4 hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-red-600 shrink-0">
                    <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-900 mb-0.5">Jalur Lanjutan</h4>
                    <p class="text-[11px] sm:text-xs text-gray-500 font-medium leading-snug">
                        {{ $silabus['spec_path'] }}
                    </p>
                </div>
            </div>

        </div>

        <!-- ==================== 5. SECTION SILABUS PEMBELAJARAN (VIEWER DOKUMEN) ==================== -->
        <div class="text-center mb-10" data-aos="fade-up">
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                <span style="color: #C8102E !important;">SILABUS</span> 
                <span class="text-gray-900">PEMBELAJARAN</span>
            </h2>
        </div>

        <!-- Container Viewer dengan Aksen Garis Merah Melintang Khas Figma -->
        <div class="relative max-w-5xl mx-auto mb-20 px-2 sm:px-6" data-aos="zoom-in">
            
            <!-- Aksen Garis Merah Melintang Luar Sesuai Desain Figma -->
            <div class="absolute -top-6 -left-8 w-24 h-24 border-t-2 border-l-2 border-red-600 pointer-events-none hidden md:block"></div>
            <div class="absolute -top-6 -right-8 w-24 h-24 border-t-2 border-r-2 border-red-600 pointer-events-none hidden md:block"></div>
            <div class="absolute -bottom-6 -left-8 w-24 h-24 border-b-2 border-l-2 border-red-600 pointer-events-none hidden md:block"></div>
            <div class="absolute -bottom-6 -right-8 w-24 h-24 border-b-2 border-r-2 border-red-600 pointer-events-none hidden md:block"></div>

            <!-- Box Viewer Kurikulum Interaktif -->
            <div class="w-full bg-[#EEEEEE] rounded-3xl border border-gray-300 shadow-inner p-6 sm:p-10 min-h-[440px] sm:min-h-[520px] flex flex-col justify-between">
                
                <!-- Header Toolbar Dokumen -->
                <div class="flex flex-col sm:flex-row items-center justify-between pb-6 border-b border-gray-300 gap-4">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                        <span class="w-3 h-3 rounded-full bg-green-500"></span>
                        <span class="text-xs font-bold text-gray-700 ml-2">Kurikulum Merdeka SMK Telkom Sidoarjo &bull; {{ $silabus['code'] }}</span>
                    </div>

                    <a href="#kontak" 
                       style="background-color: #C8102E !important; color: #ffffff !important;"
                       class="px-5 py-2 rounded-xl text-xs font-bold hover:opacity-90 transition active:scale-95 shadow-sm inline-flex items-center gap-2">
                        <i data-lucide="download" class="w-3.5 h-3.5"></i>
                        <span>Download Silabus PDF</span>
                    </a>
                </div>

                <!-- Konten Rincian Semester Silabus Pembelajaran -->
                <div class="py-8 grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach($silabus['curriculum_semesters'] as $curr)
                        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold tracking-wider uppercase px-2.5 py-0.5 rounded-full bg-red-50 text-red-700 inline-block mb-2">
                                    {{ $curr['sem'] }}
                                </span>
                                <h4 class="text-xs sm:text-sm font-bold text-gray-900 leading-snug">
                                    Fokus Capaian Pembelajaran
                                </h4>
                                <p class="text-xs text-gray-600 mt-1 leading-relaxed">
                                    {{ $curr['focus'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Footer Dokumen -->
                <div class="pt-4 border-t border-gray-300 text-center text-xs text-gray-500 font-medium">
                    Terakreditasi A &bull; Standar Kompetensi Kerja Nasional Indonesia (SKKNI) &bull; Teaching Factory Telkom Schools
                </div>

            </div>

        </div>

        <!-- ==================== 6. SECTION CERITA ALUMNI DI SIJA / TJAT ==================== -->
        <div class="text-center mb-8" data-aos="fade-up">
            <h3 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                Cerita Alumni <span class="text-black font-extrabold">di</span> 
                <span style="color: #C8102E !important;">{{ $silabus['code'] }}</span>
            </h3>
        </div>

        <!-- Testimonial Box Berbingkai Dashed -->
        <div class="border border-dashed border-gray-400 rounded-3xl p-6 sm:p-8 max-w-3xl mx-auto bg-white flex flex-col sm:flex-row items-center gap-6 sm:gap-8 shadow-sm mb-6" data-aos="zoom-in">
            
            <!-- Foto Alumni dalam Frame Belah Ketupat Merah Miring Sesuai Figma -->
            <div class="relative w-28 h-28 sm:w-32 sm:h-32 shrink-0 flex items-center justify-center">
                <div class="absolute inset-0 rounded-2xl transform rotate-45 shadow-md" style="background-color: #C8102E !important;"></div>
                <img src="{{ $silabus['alumni_photo'] }}" 
                     alt="Alumni" 
                     class="relative z-10 w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-xl"
                     onerror="this.onerror=null; this.src='{{ asset('images/career/career1.png') }}';">
            </div>

            <!-- Teks Kutipan & Author -->
            <div class="flex-1 text-center sm:text-left space-y-3">
                <p class="text-gray-800 font-medium text-sm sm:text-base italic leading-relaxed">
                    "{{ $silabus['alumni_quote'] }}"
                </p>
                <div>
                    <span class="text-xs font-bold text-gray-900 block">
                        &mdash; {{ $silabus['alumni_name'] }}
                    </span>
                </div>
                <!-- Ikon LinkedIn Hitam Persegi -->
                <div class="pt-1 flex justify-center sm:justify-start">
                    <span class="w-6 h-6 rounded bg-black text-white flex items-center justify-center text-xs font-bold shadow-sm">
                        in
                    </span>
                </div>
            </div>

        </div>

        <!-- Pagination Dots Sesuai Figma -->
        <div class="flex justify-center items-center gap-2 mb-10">
            <span class="w-2.5 h-2.5 rounded-full" style="background-color: #C8102E !important;"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-gray-300"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-gray-300"></span>
        </div>

    </div>
</div>
@endsection