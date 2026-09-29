@extends('layouts.app')

@section('title', 'Profil Guru - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: Ilustrasi Karakter Tim Pengajar -->
        <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2">
            <img src="{{ asset('images/guru/hero-teachers.png') }}" alt="Ilustrasi Tim Pengajar" class="relative z-10 w-[340px] md:w-[420px] h-auto object-contain drop-shadow-2xl">
        </div>

        <!-- Teks Kanan -->
        <div class="md:order-2 order-1">
            <div class="text-sm text-gray-500 font-medium mb-3 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-red-700 transition">Tentang kami</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-gray-900 font-semibold">Profil Guru</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                Profil Guru
            </h1>
            
            <p class="text-gray-600 text-sm md:text-base mb-8 leading-relaxed">
                Tim pengajar kami adalah para profesional berdedikasi dengan keahlian di bidang Teknologi dan Informatika, serta berpengalaman di industri. Mereka siap membimbing siswa dengan metode inovatif dan mendukung pengembangan potensi maksimal.
            </p>
            
            <a href="#kepala-sekolah" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95">
                Jelajahi 
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

<!-- Section Profil Kepala Sekolah -->
<section id="kepala-sekolah" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <!-- Dashed Container -->
        <div class="border-2 border-dashed border-gray-300 rounded-[2.5rem] p-8 md:p-12 relative bg-gray-50/50 shadow-sm max-w-5xl mx-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 items-center">
                
                <!-- Foto Kepala Sekolah -->
                <div class="md:col-span-5 flex justify-center">
                    <div class="w-64 h-72 rounded-3xl overflow-hidden shadow-lg border-2 border-white bg-white">
                        <img src="{{ $kepalaSekolah['foto'] }}" alt="{{ $kepalaSekolah['nama'] }}" class="w-full h-full object-cover object-top">
                    </div>
                </div>

                <!-- Detail Biodata -->
                <div class="md:col-span-7 space-y-4">
                    <span class="text-xs uppercase tracking-wider font-bold text-gray-400 block">
                        Kepala Sekolah <span class="text-red-700">SMK Telkom Sidoarjo</span>
                    </span>
                    
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">
                        {{ $kepalaSekolah['nama'] }}
                    </h2>
                    
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $kepalaSekolah['deskripsi'] }}
                    </p>

                    <!-- Grid Info 2 Kolom -->
                    <div class="grid grid-cols-2 gap-4 pt-3 border-t border-gray-200 text-sm">
                        <div>
                            <span class="text-gray-400 block text-xs">Pendidikan Terakhir</span>
                            <span class="font-bold text-gray-800">{{ $kepalaSekolah['pendidikan'] }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block text-xs">Bidang Keahlian</span>
                            <span class="font-bold text-gray-800">{{ $kepalaSekolah['keahlian'] }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block text-xs">Jabatan/Posisi</span>
                            <span class="font-bold text-gray-800">{{ $kepalaSekolah['jabatan'] }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block text-xs">Motto</span>
                            <span class="font-semibold text-red-700 italic">"{{ $kepalaSekolah['motto'] }}"</span>
                        </div>
                    </div>

                    <div class="pt-2 text-xs font-semibold text-gray-500 flex items-center gap-2">
                        <i data-lucide="mail" class="w-4 h-4 text-red-700"></i>
                        <span>{{ $kepalaSekolah['email'] }}</span>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

<!-- Section Wakil Kepala Bidang (Slider / Carousel) -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-1">
                Wakil Kepala bidang
            </h2>
            <span class="text-red-700 font-bold uppercase tracking-widest text-sm">Smk Telkom Sidoarjo</span>
        </div>

        <!-- Carousel Container -->
        <div class="relative overflow-hidden px-4 py-6 max-w-6xl mx-auto">
            <div id="wakaCarousel" class="flex transition-transform duration-500 ease-out gap-6">
                @foreach($wakaBidang as $waka)
                    <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(25%-1.125rem)] shrink-0">
                        <div class="bg-white rounded-3xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                            <div class="h-72 bg-gray-100 overflow-hidden">
                                <img src="{{ $waka['foto'] }}" alt="{{ $waka['nama'] }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4 text-center bg-white">
                                <h4 class="font-bold text-gray-900 text-sm">{{ $waka['jabatan'] }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Navigation Waka -->
        <div class="flex items-center justify-center gap-6 mt-8">
            <button id="prevWaka" class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>
            <div id="wakaDots" class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-red-700 w-6 transition-all cursor-pointer"></span>
                <span class="w-3 h-3 rounded-full bg-gray-300 transition-all cursor-pointer"></span>
            </div>
            <button id="nextWaka" class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>
        </div>

    </div>
</section>

<!-- Section Guru Produktif dan Non Produktif (Slider / Carousel) -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-1">
                Guru Produktif dan Non Produktif
            </h2>
            <span class="text-red-700 font-bold uppercase tracking-widest text-sm">Smk Telkom Sidoarjo</span>
        </div>

        <!-- Carousel Container -->
        <div class="relative overflow-hidden px-4 py-6 max-w-6xl mx-auto">
            <div id="guruCarousel" class="flex transition-transform duration-500 ease-out gap-6">
                @foreach($guruMapel as $guru)
                    <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(25%-1.125rem)] shrink-0">
                        <div class="bg-white rounded-3xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                            <div class="h-72 bg-gray-100 overflow-hidden">
                                <img src="{{ $guru['foto'] }}" alt="{{ $guru['nama'] }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4 text-center bg-white">
                                <h4 class="font-bold text-gray-900 text-sm">{{ $guru['mapel'] }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Navigation Guru -->
        <div class="flex items-center justify-center gap-6 mt-8">
            <button id="prevGuru" class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>
            <div id="guruDots" class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-red-700 w-6 transition-all cursor-pointer"></span>
                <span class="w-3 h-3 rounded-full bg-gray-300 transition-all cursor-pointer"></span>
            </div>
            <button id="nextGuru" class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Setup Carousel Function
        function setupCarousel(carouselId, prevId, nextId, dotsId, totalSlides) {
            const carousel = document.getElementById(carouselId);
            const prevBtn = document.getElementById(prevId);
            const nextBtn = document.getElementById(nextId);
            const dots = document.querySelectorAll(`#${dotsId} span`);

            if (!carousel) return;

            let currentIndex = 0;

            function update() {
                const offset = -currentIndex * 100;
                carousel.style.transform = `translateX(${offset}%)`;

                dots.forEach((dot, index) => {
                    if (index === currentIndex) {
                        dot.classList.remove('bg-gray-300', 'w-3');
                        dot.classList.add('bg-red-700', 'w-6');
                    } else {
                        dot.classList.remove('bg-red-700', 'w-6');
                        dot.classList.add('bg-gray-300', 'w-3');
                    }
                });
            }

            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % totalSlides;
                update();
            });

            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                update();
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentIndex = index;
                    update();
                });
            });
        }

        // Inisialisasi Carousel Waka & Guru
        setupCarousel('wakaCarousel', 'prevWaka', 'nextWaka', 'wakaDots', 2);
        setupCarousel('guruCarousel', 'prevGuru', 'nextGuru', 'guruDots', 2);
    });
</script>
@endpush