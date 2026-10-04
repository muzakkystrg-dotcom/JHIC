@extends('layouts.app')

@section('title', 'Program TS21 - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#F8F9FA] min-h-screen text-slate-800 font-sans">

    <!-- ==================== 1. HERO SECTION PROGRAM TS21 ==================== -->
    <section class="relative pt-40 pb-16 overflow-hidden bg-gradient-to-br from-[#EAEAEA] via-[#F4F4F4] to-white">
        <!-- Aksen Geometris Diagonal Latar Belakang Khas SKOMDA -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-gray-200/40 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Sisi Kiri: Foto Siswi Berhijab MacBook Hitam Dalam Frame Kubah Merah Putus-Putus -->
                <div class="lg:col-span-5 flex justify-center items-center" data-aos="zoom-in">
                    <div class="relative w-full max-w-[340px] sm:max-w-[400px]">
                        <!-- Garis Kubah Putus-Putus Pemanis Khas Figma -->
                        <div class="absolute inset-0 border-2 border-dashed border-gray-400 rounded-t-full rounded-b-3xl transform scale-105 pointer-events-none"></div>
                        
                        <!-- Gambar Siswi Hero TS21 -->
                        <div class="relative z-10 w-full overflow-hidden flex items-end justify-center">
                            <img src="{{ $ts21Data['hero']['image'] }}" 
                                 alt="Siswi Program TS21 SMK Telkom Sidoarjo" 
                                 class="w-full h-auto object-contain select-none drop-shadow-2xl"
                                 onerror="this.onerror=null; this.src='{{ asset('images/career/career.webp') }}';" loading="eager" decoding="async" fetchpriority="high">
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan: Headline & Deskripsi -->
                <div class="lg:col-span-7 space-y-5 text-center lg:text-left" data-aos="fade-left">
                    <!-- Breadcrumb -->
                    <div class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500">
                        <span>Program</span>
                        <span>&gt;</span>
                        <span class="text-gray-900 font-bold">Program TS21</span>
                    </div>

                    <!-- Headline Judul -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-[1.1] tracking-tight">
                        Program TS21
                    </h1>

                    <!-- Paragraf Deskripsi -->
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-xl mx-auto lg:mx-0 font-normal">
                        {{ $ts21Data['hero']['description'] }}
                    </p>

                    <!-- Tombol CTA Jelajahi -->
                    <div class="pt-2 flex justify-center lg:justify-start">
                        <a href="#detail-ts21" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
                            Jelajahi
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Garis Pemisah Aksen Merah Horizontal Khas SKOMDA -->
    <div class="w-full flex justify-center py-6 bg-white">
        <div class="w-72 h-1.5 rounded-full" style="background-color: #C8102E !important;"></div>
    </div>

    <!-- ==================== 2. SECTION ARTIKEL: LANGKAH MENUJU SEKOLAH 4.0 ==================== -->
    <section id="detail-ts21" class="py-16 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24" data-aos="fade-up">
        
        <!-- Header Judul Section Sesuai Figma -->
        <div class="text-center mb-14">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-snug">
                <span style="color: #C8102E !important;">TS.21</span> SMK Telkom Sidoarjo: Langkah Menuju Sekolah 4.0
            </h2>
        </div>

        <!-- Dua Paragraf Komprehensif Narasi Kurikulum TS.21 -->
        <div class="space-y-8 text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed font-normal text-justify mb-24">
            <p>
                {{ $ts21Data['content']['paragraphs'][0] }}
            </p>

            <p>
                {{ $ts21Data['content']['paragraphs'][1] }}
            </p>
        </div>

    </section>

</div>
@endsection