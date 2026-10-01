@extends('layouts.app')

@section('title', 'Profil Guru - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16" data-aos="fade-in" data-aos-duration="1000">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: Ilustrasi Karakter Tim Pengajar -->
        <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2" data-aos="zoom-in" data-aos-delay="200">
            <img src="{{ asset('images/guru/hero-teachers.png') }}" alt="Ilustrasi Tim Pengajar" class="relative z-10 w-[340px] md:w-[420px] h-auto object-contain drop-shadow-2xl">
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
                
                <!-- Foto -->
                <div class="md:col-span-5 flex justify-center" data-aos="zoom-in" data-aos-delay="100">
                    <div class="w-64 h-72 rounded-3xl overflow-hidden shadow-lg border-2 border-white bg-white">
                        <img src="{{ $kepalaSekolah['foto'] }}" alt="{{ $kepalaSekolah['nama'] }}" class="w-full h-full object-cover object-top">
                    </div>
                </div>

                <!-- Biodata -->
                <div class="md:col-span-7 space-y-4" data-aos="fade-left" data-aos-delay="200">
                    <span class="text-xs uppercase tracking-wider font-bold text-gray-400 block">
                        Kepala Sekolah <span class="text-red-700">SMK Telkom Sidoarjo</span>
                    </span>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">{{ $kepalaSekolah['nama'] }}</h2>
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

<!-- Section Wakil Kepala Bidang -->
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

        <!-- Tombol dan Dots Otomatis -->
        <div class="flex items-center justify-center gap-6 mt-8" data-aos="fade-up">
            <button id="prevWaka" class="btn-carousel-global"><i data-lucide="chevron-left" class="w-5 h-5"></i></button>
            <div id="wakaDots" class="flex flex-wrap items-center justify-center gap-2 max-w-lg"></div>
            <button id="nextWaka" class="btn-carousel-global"><i data-lucide="chevron-right" class="w-5 h-5"></i></button>
        </div>
    </div>
</section>

<!-- Section Guru Produktif dan Non Produktif -->
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

        <!-- Tombol dan Dots Otomatis -->
        <div class="flex items-center justify-center gap-6 mt-8" data-aos="fade-up">
            <button id="prevGuru" class="btn-carousel-global"><i data-lucide="chevron-left" class="w-5 h-5"></i></button>
            <div id="guruDots" class="flex flex-wrap items-center justify-center gap-2 max-w-lg"></div>
            <button id="nextGuru" class="btn-carousel-global"><i data-lucide="chevron-right" class="w-5 h-5"></i></button>
        </div>
    </div>
</section>

<!-- Section Staff & Karyawan -->
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
                        <div class="bg-white rounded-3xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                            <div class="h-72 bg-gray-100 overflow-hidden">
                                <img src="{{ $staff['foto'] }}" alt="{{ $staff['nama'] }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4 text-center bg-white">
                                <h4 class="font-bold text-gray-900 text-sm">{{ $staff['jabatan'] }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tombol dan Dots Otomatis -->
        <div class="flex items-center justify-center gap-6 mt-8" data-aos="fade-up">
            <button id="prevStaff" class="btn-carousel-global"><i data-lucide="chevron-left" class="w-5 h-5"></i></button>
            <div id="staffDots" class="flex flex-wrap items-center justify-center gap-2 max-w-lg"></div>
            <button id="nextStaff" class="btn-carousel-global"><i data-lucide="chevron-right" class="w-5 h-5"></i></button>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Logika Carousel yang Sama, Seragam, dan Smooth per-item
        function setupSmoothCarousel(carouselId, prevId, nextId, dotsId, totalItems) {
            const carousel = document.getElementById(carouselId);
            const prevBtn = document.getElementById(prevId);
            const nextBtn = document.getElementById(nextId);
            const dotsContainer = document.getElementById(dotsId);

            if (!carousel) return;

            let currentIndex = 0;
            const gap = 24; 

            // Deteksi otomatis berapa kartu yang tampil
            function getVisibleCards() {
                if (window.innerWidth >= 1024) return 4;
                if (window.innerWidth >= 640) return 2;
                return 1;
            }

            let visibleCards = getVisibleCards();
            let maxIndex = Math.max(0, totalItems - visibleCards);

            // Bikin Dots Otomatis berdasarkan sisa geseran
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

            // Fungsi Update Geser (Smooth per Card)
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

        // Terapkan ke semua carousel (Otomatis membaca panjang array/kartu!)
        setupSmoothCarousel('wakaCarousel', 'prevWaka', 'nextWaka', 'wakaDots', {{ count($wakaBidang) }});
        setupSmoothCarousel('guruCarousel', 'prevGuru', 'nextGuru', 'guruDots', {{ count($guruMapel) }});
        setupSmoothCarousel('staffCarousel', 'prevStaff', 'nextStaff', 'staffDots', {{ count($staffKaryawan) }});
    });
</script>
@endpush