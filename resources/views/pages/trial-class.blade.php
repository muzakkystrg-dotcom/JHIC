@extends('layouts.app')

@section('title', 'Trial Class - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section (Dilengkapi Animasi AOS) -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16" data-aos="fade-in" data-aos-duration="1000">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: Murni Foto Siswi (Tanpa Background Merah & Dashed Outline) -->
        <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2" data-aos="zoom-in" data-aos-delay="200">
            <!-- Foto Siswi (Mengambil dari folder images/trial/trial.png) -->
            <img src="{{ asset('images/trial/trial.png') }}" alt="Siswi Trial Class" class="relative z-10 w-[260px] md:w-[320px] h-auto object-contain drop-shadow-2xl">
        </div>

        <!-- Teks Kanan -->
        <div class="md:order-2 order-1" data-aos="fade-right" data-aos-delay="400">
            <div class="text-sm text-gray-500 font-medium mb-3 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-red-700 transition">Informasi</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-gray-900 font-semibold">Trial Class</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                Trial Class
            </h1>
            
            <p class="text-gray-600 text-sm md:text-base mb-8 leading-relaxed">
                Ikuti Trial Class kami untuk merasakan langsung suasana, metode pengajaran, dan fasilitas unggulan SMK Telkom Sidoarjo. Dapatkan gambaran jelas tentang jurusan dan lingkungan belajar kami sebelum Anda memutuskan. Jelajahi jadwal dan daftar Trial Class sekarang!
            </p>
            
            <a href="#ikuti-trial" class="btn-primary-global mt-4">
                Jelajahi 
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

<!-- Garis Pemisah Aksen Merah Horizontal -->
<div class="w-full flex justify-center py-6 bg-white" data-aos="fade-up">
    <div class="w-72 h-1.5 bg-red-700 rounded-full"></div>
</div>

<!-- Section Ikuti Trial Class & Search Bar -->
<section id="ikuti-trial" class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-5xl mx-auto px-4 sm:px-8">
        
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">
                Ikuti <span class="text-red-700">Trial Class</span> dan Temukan Potensi Terbaikmu!
            </h2>
        </div>

        <!-- Form Pencarian Jadwal (Dashed Border Input + Tombol Cari Merah) -->
        <form action="{{ route('trial-class.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4 mb-16" data-aos="fade-up" data-aos-delay="100">
            <div class="relative w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Jadwal atau Topik Trial Class..." class="w-full pl-12 pr-4 py-4 rounded-2xl border-2 border-dashed border-gray-400 bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-red-700 text-sm font-medium text-gray-700 shadow-inner">
                <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-4 top-4.5"></i>
            </div>
            <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800 transition shadow-md active:scale-95 shrink-0">
                Cari
            </button>
        </form>

        <!-- Grid Kartu Sesi Trial Class -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="200">
            @forelse($classes as $item)
                <div class="border-2 border-dashed border-gray-300 rounded-3xl p-6 bg-white relative hover:shadow-xl hover:border-red-700 transition-all duration-300 flex flex-col justify-between h-full group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-red-50 text-red-700 text-xs font-bold px-3 py-1 rounded-full">
                                Jurusan {{ $item['jurusan'] }}
                            </span>
                            <span class="text-xs text-gray-400 font-semibold flex items-center gap-1">
                                <i data-lucide="users" class="w-3.5 h-3.5"></i> {{ $item['kuota'] }}
                            </span>
                        </div>
                        <h3 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-red-700 transition-colors">
                            {{ $item['judul'] }}
                        </h3>
                        <div class="space-y-2 text-xs text-gray-500 mt-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="calendar" class="w-4 h-4 text-red-600 shrink-0"></i>
                                <span>{{ $item['tanggal'] }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-4 h-4 text-red-600 shrink-0"></i>
                                <span>{{ $item['jam'] }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="user" class="w-4 h-4 text-red-600 shrink-0"></i>
                                <span>Instruktur: {{ $item['instruktur'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-50 flex justify-end">
                        <a href="#" class="btn-pill-small">
                            Daftar Sesi <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 py-12 text-center text-gray-500 italic bg-gray-50 rounded-2xl border border-gray-200">
                    <div class="flex flex-col items-center justify-center gap-2">
                        <i data-lucide="search-x" class="w-8 h-8 text-gray-300"></i>
                        <span>Jadwal atau topik Trial Class yang Anda cari tidak ditemukan.</span>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection