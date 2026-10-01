@extends('layouts.app')

@section('title', 'Mitra Industri - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section (Dengan animasi Fade-In) -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16" data-aos="fade-in" data-aos-duration="1000">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: Foto Siswa (Animasi Zoom-In) -->
        <div class="relative w-full h-[380px] md:h-[420px] flex justify-center items-center md:order-1 order-2" data-aos="zoom-in" data-aos-delay="200">
            <img src="{{ asset('images/mitra/siswa.png') }}" alt="Siswa SMK Telkom" class="relative z-10 w-[300px] md:w-[350px] h-auto object-contain drop-shadow-xl">
        </div>

        <!-- Teks Kanan (Animasi Fade-Right) -->
        <div class="md:order-2 order-1" data-aos="fade-right" data-aos-delay="400">
            <div class="text-sm text-gray-500 font-medium mb-3 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-red-700 transition">Tentang kami</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-gray-900 font-semibold">Mitra industri</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                <span class="text-red-700 block mb-1">Mitra Industri</span> yang dipercaya oleh kami.
            </h1>
            
            <p class="text-gray-600 text-lg mb-8 leading-relaxed max-w-lg">
                Kami bekerja sama dengan berbagai perusahaan ternama untuk memastikan lulusan siap kerja dan terserap industri.
            </p>
            
            <a href="#katalog" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
                Jelajahi 
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

<!-- Katalog Mitra Section (Dengan animasi Fade-Up) -->
<section id="katalog" class="py-20 bg-[#FAFAFA]" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-extrabold text-gray-900">
                Temukan <span class="text-red-700">13+ Mitra Industri</span> kami Disini
            </h2>
        </div>

        <!-- Filter Input Search -->
        <div class="max-w-md mx-auto mb-10 relative" data-aos="fade-up" data-aos-delay="100">
            <input type="text" id="searchInput" placeholder="Cari nama mitra atau lokasi..." class="w-full pl-11 pr-4 py-3.5 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-red-700 focus:border-transparent shadow-sm text-sm font-medium text-gray-700 bg-white">
            <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-4 top-3.5"></i>
        </div>

        <!-- Grid Cards (Dengan efek muncul bertahap / stagger) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="partnerGrid">
            @foreach($mitras as $index => $partner)
                <div class="border-2 border-dashed border-gray-300 rounded-3xl p-6 bg-white relative hover:shadow-lg hover:border-red-700 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full group" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div>
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-32 h-12 flex items-center justify-start">
                                <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="max-h-full max-w-full object-contain transition-all duration-300">
                            </div>
                        </div>
                        <a href="{{ $partner['website'] }}" target="_blank" class="flex items-center gap-2 group-hover:text-red-700 transition-colors">
                            <h3 class="font-bold text-md text-gray-900 group-hover:text-red-700">{{ $partner['name'] }}</h3>
                            <i data-lucide="external-link" class="w-4 h-4 text-red-700 shrink-0"></i>
                        </a>
                        <div class="flex items-start gap-1 mt-2 text-xs text-gray-500">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400 mt-0.5 shrink-0"></i>
                            <span class="leading-tight">{{ $partner['location'] }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-4 line-clamp-4 leading-relaxed">
                            {{ $partner['description'] }}
                        </p>
                    </div>
                    <div class="mt-6 flex justify-end pt-4 border-t border-gray-50">
                        <a href="{{ $partner['website'] }}" class="bg-red-700 text-white text-xs px-4 py-1.5 rounded-full hover:bg-red-800 transition-colors flex items-center gap-1.5 shadow-sm font-medium">
                            Selengkapnya 
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
</section>

@endsection