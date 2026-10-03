@extends('layouts.app')

@section('title', isset($guruDetail) ? 'Profil ' . $guruDetail['nama'] . ' - SMK Telkom Sidoarjo' : 'Profil Guru - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#F8F9FA] min-h-screen text-slate-800 font-sans">

@if(isset($guruDetail))
    {{-- =========================================================================
         BAGIAN 1: DETAIL GURU / WAKA / STAF (DESAIN FIGMA: Desktop - 42.png)
         ========================================================================= --}}
    <section class="relative pt-36 sm:pt-40 pb-24 overflow-hidden bg-gradient-to-br from-[#EAEAEA]/80 via-[#F4F4F4] to-white min-h-[85vh] flex items-center">
        <div class="absolute top-0 left-0 w-2/5 h-full bg-gradient-to-r from-gray-200/50 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
                
                <!-- Foto Portrait Guru -->
                <div class="lg:col-span-5 flex justify-center items-center" data-aos="zoom-in">
                    <div class="w-full max-w-[360px] sm:max-w-[400px] rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-white aspect-[3/4]">
                        <img src="{{ $guruDetail['foto'] ?? asset('images/profileguru/rachel.png') }}" 
                             alt="{{ $guruDetail['nama'] }}" 
                             class="w-full h-full object-cover object-top select-none transition-transform duration-500 hover:scale-105"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x520?text={{ urlencode($guruDetail['nama']) }}';">
                    </div>
                </div>

                <!-- Konten Biodata Guru Lengkap Sesuai Figma -->
                <div class="lg:col-span-7 space-y-6 text-left" data-aos="fade-left">
                    <p class="text-xs sm:text-sm text-gray-500 font-medium">
                        <a href="{{ url('/') }}" class="hover:text-red-700 transition">Tentang kami</a> 
                        &gt; 
                        <a href="{{ route('profil-guru.index') }}" class="hover:text-red-700 transition">Profil Guru</a> 
                        &gt; 
                        <span class="text-gray-900 font-bold">{{ $guruDetail['nama'] }}</span>
                    </p>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                        {{ $guruDetail['nama'] }}
                    </h1>

                    <p class="text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed font-normal max-w-2xl text-justify">
                        {{ $guruDetail['deskripsi'] }}
                    </p>

                    <!-- Grid 2 Kolom Informasi Profil Detail -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-7 gap-x-10 max-w-xl pt-2 border-t border-gray-200">
                        <div>
                            <h4 class="text-xs sm:text-sm font-bold tracking-tight mb-1" style="color: #C8102E !important;">
                                Pendidikan Terakhir
                            </h4>
                            <p class="text-xs sm:text-sm text-gray-700 font-medium">
                                {{ $guruDetail['pendidikan'] ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="text-xs sm:text-sm font-bold tracking-tight mb-1" style="color: #C8102E !important;">
                                Bidang Keahlian
                            </h4>
                            <p class="text-xs sm:text-sm text-gray-700 font-medium">
                                {{ $guruDetail['keahlian'] ?? ($guruDetail['mapel'] ?? '-') }}
                            </p>
                        </div>

                        <div>
                            <h4 class="text-xs sm:text-sm font-bold tracking-tight mb-1" style="color: #C8102E !important;">
                                Jabatan/Posisi
                            </h4>
                            <p class="text-xs sm:text-sm text-gray-700 font-medium">
                                {{ $guruDetail['jabatan'] }}
                            </p>
                        </div>

                        <div>
                            <h4 class="text-xs sm:text-sm font-bold tracking-tight mb-1" style="color: #C8102E !important;">
                                Kontak Profesional
                            </h4>
                            <p class="text-xs sm:text-sm text-gray-700 font-medium hover:text-[#C8102E] transition">
                                <a href="mailto:{{ $guruDetail['email'] }}" class="underline decoration-dotted">
                                    {{ $guruDetail['email'] }}
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('profil-guru.index') }}" 
                           class="inline-flex items-center gap-2 text-xs font-semibold text-gray-600 hover:text-[#C8102E] transition">
                            <span class="text-base leading-none">&larr;</span>
                            <span>Kembali ke Katalog Dewan Guru</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

@else
    {{-- =========================================================================
         BAGIAN 2: KATALOG LENGKAP PROFIL GURU (KODE ASLI ANDA 100% UTUH)
         ========================================================================= --}}

    <!-- Hero Section -->
    <section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16" data-aos="fade-in" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
            
            <!-- Frame Kiri: Ilustrasi Karakter Tim Pengajar -->
            <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('images/guru/hero-teachers.png') }}" alt="Ilustrasi Tim Pengajar" class="relative z-10 w-[340px] md:w-[420px] h-auto object-contain drop-shadow-2xl" onerror="this.onerror=null; this.src='{{ asset('images/home/program.png') }}';">
            </div>

            <!-- Teks Kanan -->
            <div class="md:order-2 order-1" data-aos="fade-right" data-aos-delay="400">
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
                
                <a href="#kepala-sekolah" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
                    Jelajahi 
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- Section Profil Kepala Sekolah -->
    <section id="kepala-sekolah" class="py-20 bg-white" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="border-2 border-dashed border-gray-300 rounded-[2.5rem] p-8 md:p-12 relative bg-gray-50/50 shadow-sm max-w-5xl mx-auto hover:border-red-700 transition-colors duration-300">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-10 items-center">
                    
                    <!-- Foto Kepala Sekolah (Clickable) -->
                    <div class="md:col-span-5 flex justify-center" data-aos="zoom-in" data-aos-delay="100">
                        <a href="{{ route('profil-guru.show', ['slug' => $kepalaSekolah['slug']]) }}" class="block group">
                            <div class="w-64 h-72 rounded-3xl overflow-hidden shadow-lg border-2 border-white bg-white">
                                <img src="{{ $kepalaSekolah['foto'] }}" alt="{{ $kepalaSekolah['nama'] }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                            </div>
                        </a>
                    </div>

                    <!-- Biodata Kepala Sekolah -->
                    <div class="md:col-span-7 space-y-4" data-aos="fade-left" data-aos-delay="200">
                        <span class="text-xs uppercase tracking-wider font-bold text-gray-400 block">
                            Kepala Sekolah <span class="text-red-700">SMK Telkom Sidoarjo</span>
                        </span>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">
                            <a href="{{ route('profil-guru.show', ['slug' => $kepalaSekolah['slug']]) }}" class="hover:text-red-700 transition">
                                {{ $kepalaSekolah['nama'] }}
                            </a>
                        </h2>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $kepalaSekolah['deskripsi'] }}</p>
                        
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

    <!-- Section Wakil Kepala Bidang (8 Card) -->
    <section class="py-20 bg-white" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-1">Wakil Kepala bidang</h2>
                <span class="text-red-700 font-bold uppercase tracking-widest text-sm">Smk Telkom Sidoarjo</span>
            </div>

            <div class="relative overflow-hidden px-4 py-6 max-w-6xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                <div id="wakaCarousel" class="flex transition-transform duration-500 ease-out gap-6">
                    @foreach($wakaBidang as $waka)
                        <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(25%-1.125rem)] shrink-0">
                            <a href="{{ route('profil-guru.show', ['slug' => $waka['slug']]) }}" class="block h-full group">
                                <div class="bg-white rounded-3xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                                    <div class="h-72 bg-gray-100 overflow-hidden">
                                        <img src="{{ $waka['foto'] }}" alt="{{ $waka['nama'] }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500" onerror="this.onerror=null; this.src='https://placehold.co/300x400?text=Waka';">
                                    </div>
                                    <div class="p-4 text-center bg-white group-hover:bg-red-50/50 transition">
                                        <h4 class="font-bold text-gray-900 text-sm group-hover:text-red-700 transition">{{ $waka['jabatan'] }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tombol dan Dots Otomatis -->
            <div class="flex items-center justify-center gap-6 mt-8" data-aos="fade-up">
                <button id="prevWaka" aria-label="Previous" class="btn-carousel-global w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
                <div id="wakaDots" class="flex flex-wrap items-center justify-center gap-2 max-w-lg"></div>
                <button id="nextWaka" aria-label="Next" class="btn-carousel-global w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Section Guru Produktif dan Non Produktif (29 Card) -->
    <section class="py-20 bg-gray-50" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-1">Guru Produktif dan Non Produktif</h2>
                <span class="text-red-700 font-bold uppercase tracking-widest text-sm">Smk Telkom Sidoarjo</span>
            </div>

            <div class="relative overflow-hidden px-4 py-6 max-w-6xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                <div id="guruCarousel" class="flex transition-transform duration-500 ease-out gap-6">
                    @foreach($guruMapel as $guru)
                        <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(25%-1.125rem)] shrink-0">
                            <a href="{{ route('profil-guru.show', ['slug' => $guru['slug']]) }}" class="block h-full group">
                                <div class="bg-white rounded-3xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                                    <div class="h-72 bg-gray-100 overflow-hidden">
                                        <img src="{{ $guru['foto'] }}" alt="{{ $guru['nama'] }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500" onerror="this.onerror=null; this.src='https://placehold.co/300x400?text=Guru';">
                                    </div>
                                    <div class="p-4 text-center bg-white group-hover:bg-red-50/50 transition">
                                        <h4 class="font-bold text-gray-900 text-sm group-hover:text-red-700 transition">{{ $guru['mapel'] }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tombol dan Dots Otomatis -->
            <div class="flex items-center justify-center gap-6 mt-8" data-aos="fade-up">
                <button id="prevGuru" aria-label="Previous" class="btn-carousel-global w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
                <div id="guruDots" class="flex flex-wrap items-center justify-center gap-2 max-w-lg"></div>
                <button id="nextGuru" aria-label="Next" class="btn-carousel-global w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Section Staff & Karyawan (6 Card) -->
    <section class="py-20 bg-white" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-1">Staff &amp; Karyawan</h2>
                <span class="text-red-700 font-bold uppercase tracking-widest text-sm">Smk Telkom Sidoarjo</span>
            </div>

            <div class="relative overflow-hidden px-4 py-6 max-w-6xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                <div id="staffCarousel" class="flex transition-transform duration-500 ease-out gap-6">
                    @foreach($staffKaryawan as $staff)
                        <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(25%-1.125rem)] shrink-0">
                            <a href="{{ route('profil-guru.show', ['slug' => $staff['slug']]) }}" class="block h-full group">
                                <div class="bg-white rounded-3xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                                    <div class="h-72 bg-gray-100 overflow-hidden">
                                        <img src="{{ $staff['foto'] }}" alt="{{ $staff['nama'] }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500" onerror="this.onerror=null; this.src='https://placehold.co/300x400?text=Staff';">
                                    </div>
                                    <div class="p-4 text-center bg-white group-hover:bg-red-50/50 transition">
                                        <h4 class="font-bold text-gray-900 text-sm group-hover:text-red-700 transition">{{ $staff['jabatan'] }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tombol dan Dots Otomatis -->
            <div class="flex items-center justify-center gap-6 mt-8" data-aos="fade-up">
                <button id="prevStaff" aria-label="Previous" class="btn-carousel-global w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
                <div id="staffDots" class="flex flex-wrap items-center justify-center gap-2 max-w-lg"></div>
                <button id="nextStaff" aria-label="Next" class="btn-carousel-global w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
    </section>

@endif

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        function setupSmoothCarousel(carouselId, prevId, nextId, dotsId, totalItems) {
            const carousel = document.getElementById(carouselId);
            const prevBtn = document.getElementById(prevId);
            const nextBtn = document.getElementById(nextId);
            const dotsContainer = document.getElementById(dotsId);

            if (!carousel || totalItems === 0) return;

            let currentIndex = 0;
            const gap = 24; 

            function getVisibleCards() {
                if (window.innerWidth >= 1024) return 4;
                if (window.innerWidth >= 640) return 2;
                return 1;
            }

            let visibleCards = getVisibleCards();
            let maxIndex = Math.max(0, totalItems - visibleCards);

            function generateDots() {
                if (!dotsContainer) return;
                dotsContainer.innerHTML = ''; 
                
                let numDots = maxIndex + 1;
                
                if (numDots <= 1) {
                    dotsContainer.style.display = 'none';
                    return;
                } else {
                    dotsContainer.style.display = 'flex';
                }
                
                for(let i = 0; i < numDots; i++) {
                    const span = document.createElement('span');
                    span.className = 'rounded-full transition-all cursor-pointer h-2.5 ' + (i === currentIndex ? 'bg-red-700 w-6' : 'bg-gray-300 w-2.5 hover:bg-gray-400');
                    span.addEventListener('click', () => {
                        currentIndex = i;
                        update();
                    });
                    dotsContainer.appendChild(span);
                }
            }

            function update() {
                const cardElement = carousel.querySelector('div.shrink-0');
                if(!cardElement) return;
                
                const cardWidth = cardElement.offsetWidth;
                const offset = currentIndex * (cardWidth + gap);
                carousel.style.transform = `translateX(-${offset}px)`;

                if (dotsContainer) {
                    const dots = dotsContainer.querySelectorAll('span');
                    dots.forEach((dot, index) => {
                        if (index === currentIndex) {
                            dot.className = 'rounded-full transition-all cursor-pointer h-2.5 bg-red-700 w-6';
                        } else {
                            dot.className = 'rounded-full transition-all cursor-pointer h-2.5 bg-gray-300 w-2.5 hover:bg-gray-400';
                        }
                    });
                }
            }

            window.addEventListener('resize', () => {
                let newVisible = getVisibleCards();
                if(newVisible !== visibleCards) {
                    visibleCards = newVisible;
                    maxIndex = Math.max(0, totalItems - visibleCards);
                    if(currentIndex > maxIndex) currentIndex = maxIndex;
                    generateDots();
                    update();
                }
            });

            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    if (currentIndex < maxIndex) {
                        currentIndex++;
                    } else {
                        currentIndex = 0; 
                    }
                    update();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    if (currentIndex > 0) {
                        currentIndex--;
                    } else {
                        currentIndex = maxIndex; 
                    }
                    update();
                });
            }

            generateDots();
            update();
        }

        // Setup Carousel dengan jumlah kartu yang tepat:
        setupSmoothCarousel('wakaCarousel', 'prevWaka', 'nextWaka', 'wakaDots', {{ count($wakaBidang ?? []) }});     // Tepat 8 Card
        setupSmoothCarousel('guruCarousel', 'prevGuru', 'nextGuru', 'guruDots', {{ count($guruMapel ?? []) }});     // Tepat 29 Card
        setupSmoothCarousel('staffCarousel', 'prevStaff', 'nextStaff', 'staffDots', {{ count($staffKaryawan ?? []) }}); // Tepat 6 Card
    });
</script>
@endpush