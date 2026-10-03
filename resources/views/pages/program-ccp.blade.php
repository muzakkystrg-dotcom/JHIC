@extends('layouts.app')

@section('title', 'Program CCP - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#F8F9FA] min-h-screen text-slate-800 font-sans">

    <!-- ==================== 1. HERO SECTION PROGRAM CCP ==================== -->
    <section class="relative pt-40 pb-16 overflow-hidden bg-gradient-to-br from-[#EAEAEA] via-[#F4F4F4] to-white">
        <!-- Aksen Geometris Diagonal Latar Belakang Khas SKOMDA -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-gray-200/40 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Sisi Kiri: Foto Siswi Berhijab Pose Berpikir Dalam Frame Kubah Merah Putus-putus -->
                <div class="lg:col-span-5 flex justify-center items-center" data-aos="zoom-in">
                    <div class="relative w-full max-w-[340px] sm:max-w-[400px]">
                        <!-- Garis Kubah Putus-Putus Pemanis Khas Figma -->
                        <div class="absolute inset-0 border-2 border-dashed border-gray-400 rounded-t-full rounded-b-3xl transform scale-105 pointer-events-none"></div>
                        
                        <!-- Gambar Siswi Hero CCP -->
                        <div class="relative z-10 w-full overflow-hidden flex items-end justify-center">
                            <img src="{{ $ccpData['hero']['image'] }}" 
                                 alt="Siswi Program CCP SMK Telkom Sidoarjo" 
                                 class="w-full h-auto object-contain select-none drop-shadow-2xl"
                                 onerror="this.onerror=null; this.src='{{ asset('images/career/career.png') }}';">
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan: Headline & Deskripsi -->
                <div class="lg:col-span-7 space-y-5 text-center lg:text-left" data-aos="fade-left">
                    <!-- Breadcrumb -->
                    <div class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500">
                        <span>Program</span>
                        <span>&gt;</span>
                        <span class="text-gray-900 font-bold">Program CCP</span>
                    </div>

                    <!-- Headline Judul -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-[1.1] tracking-tight">
                        Program CCP
                    </h1>

                    <!-- Paragraf Deskripsi -->
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-xl mx-auto lg:mx-0 font-normal">
                        {{ $ccpData['hero']['description'] }}
                    </p>

                    <!-- Tombol CTA Jelajahi -->
                    <div class="pt-2 flex justify-center lg:justify-start">
                        <a href="#detail-ccp" 
                           style="background-color: #C8102E !important; color: #ffffff !important;"
                           class="inline-flex items-center gap-2.5 px-8 py-3 hover:opacity-90 font-bold text-xs sm:text-sm rounded-xl shadow-md transition-all duration-200 active:scale-95 cursor-pointer">
                            <span>Jelajahi</span>
                            <span class="text-base leading-none">➔</span>
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

    <!-- ==================== 2. SECTION PROGRAM PENDIDIKAN CCP (3 PILAR UTAMA) ==================== -->
    <section id="detail-ccp" class="py-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24" data-aos="fade-up">
        
        <!-- Header Judul Section -->
        <div class="text-center mb-14">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">
                Program Pendidikan CCP
            </h2>
        </div>

        <!-- Grid 2 Kolom Asimetris Sesuai Desain Figma Desktop - 30 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch mb-24">
            
            <!-- KOLOM KIRI: 2 CARD BERTUMPUK (CHARACTER & PROCESS) -->
            <div class="flex flex-col gap-8 justify-between">
                
                <!-- CARD 1: PROGRAM CHARACTER -->
                <div class="border border-red-500/80 rounded-2xl p-6 sm:p-8 bg-white shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-start">
                    <h3 class="text-lg sm:text-xl font-bold mb-3" style="color: #C8102E !important;">
                        {{ $ccpData['pillars']['character']['title'] }}
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-4 text-justify font-normal">
                        {{ $ccpData['pillars']['character']['desc'] }}
                    </p>
                    <ul class="space-y-2 text-xs sm:text-sm text-gray-800 font-medium list-none">
                        @foreach($ccpData['pillars']['character']['items'] as $item)
                            <li class="flex items-start gap-2">
                                <span class="text-gray-900 font-bold">•</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- CARD 2: PROGRAM PROCESS -->
                <div class="border border-red-500/80 rounded-2xl p-6 sm:p-8 bg-white shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-start">
                    <h3 class="text-lg sm:text-xl font-bold mb-3" style="color: #C8102E !important;">
                        {{ $ccpData['pillars']['process']['title'] }}
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-4 text-justify font-normal">
                        {{ $ccpData['pillars']['process']['desc'] }}
                    </p>
                    <ul class="space-y-2 text-xs sm:text-sm text-gray-800 font-medium list-none">
                        @foreach($ccpData['pillars']['process']['items'] as $item)
                            <li class="flex items-start gap-2">
                                <span class="text-gray-900 font-bold">•</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <!-- KOLOM KANAN: CARD TUNGGAL MEMANJANG (PROGRAM CONTENT) -->
            <div class="h-full">
                <div class="border border-red-500/80 rounded-2xl p-6 sm:p-8 bg-white shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-start h-full">
                    <h3 class="text-lg sm:text-xl font-bold mb-3" style="color: #C8102E !important;">
                        {{ $ccpData['pillars']['content']['title'] }}
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-8 text-justify font-normal">
                        {{ $ccpData['pillars']['content']['desc'] }}
                    </p>
                    <ul class="space-y-6 text-xs sm:text-sm text-gray-800 font-medium list-none">
                        @foreach($ccpData['pillars']['content']['items'] as $item)
                            <li class="flex items-start gap-2">
                                <span class="text-gray-900 font-bold">•</span>
                                <span class="leading-relaxed">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

    </section>

</div>
@endsection