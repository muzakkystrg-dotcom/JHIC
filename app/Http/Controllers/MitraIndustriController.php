@extends('layouts.app')

@section('title', 'Mitra Industri - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section (Diberi padding atas agar pas di bawah navbar) -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10 pb-16">
        
        <!-- Frame Kiri (Siswa) -->
        <div class="relative w-full h-[350px] md:h-[400px] flex justify-center items-center md:order-1 order-2">
            <!-- Background Shape Geometrik -->
            <div class="absolute inset-0 bg-gray-200 clip-rhombus shadow-inner transform -rotate-3 scale-95"></div>
            <!-- Foto Siswa Placeholder -->
            <img src="https://ui-avatars.com/api/?name=Siswa&background=random&size=400" alt="Siswa SMK Telkom" class="relative z-10 w-3/4 h-auto object-cover clip-rhombus shadow-lg border-4 border-white">
        </div>

        <!-- Teks Kanan -->
        <div class="md:order-2 order-1">
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
            
            <a href="#katalog" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95">
                Jelajahi 
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

<!-- Katalog Mitra Section -->
<section id="katalog" class="py-20 bg-[#FAFAFA]">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900">
                Temukan <span class="text-red-700">13+ Mitra Industri</span> kami Disini
            </h2>
        </div>

        <!-- Filter Input Search -->
        <div class="max-w-md mx-auto mb-10 relative">
            <input type="text" id="searchInput" placeholder="Cari nama mitra atau lokasi..." class="w-full pl-11 pr-4 py-3.5 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-red-700 focus:border-transparent shadow-sm text-sm font-medium text-gray-700">
            <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-4 top-3.5"></i>
        </div>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="partnerGrid">
            @foreach($mitras as $partner)
                <x-partner-card :partner="$partner" />
            @endforeach
        </div>
        
    </div>
</section>

@endsection