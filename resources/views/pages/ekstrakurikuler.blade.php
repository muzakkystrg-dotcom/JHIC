@extends('layouts.app')

@section('title', isset($ekstraDetail) ? 'Ekstrakurikuler ' . $ekstraDetail['nama'] . ' - SMK Telkom Sidoarjo' : 'Ekstrakurikuler & Club - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#F8F9FA] min-h-screen text-slate-800 font-sans">

@if(isset($ekstraDetail))
    {{-- =========================================================================
         BAGIAN 1: DETAIL EKSTRAKURIKULER & GALERI (DESAIN FIGMA: Desktop - 40.png)
         ========================================================================= --}}
    <div class="pt-32 sm:pt-40 pb-16 sm:pb-24">
        
        <!-- ==================== HERO SECTION DETAIL EKSTRAKURIKULER ==================== -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Sisi Kiri: Foto Utama Ekstrakurikuler (hero-paskib.png) -->
                <div class="lg:col-span-6" data-aos="fade-right">
                    <div class="w-full rounded-3xl overflow-hidden shadow-lg border border-gray-100 bg-white aspect-[4/3] sm:aspect-[16/11]">
                        <img src="{{ $ekstraDetail['hero_image'] }}" 
                             alt="{{ $ekstraDetail['nama'] }}" 
                             class="w-full h-full object-cover select-none transition-transform duration-500 hover:scale-105"
                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}';" loading="eager" decoding="async" fetchpriority="high">
                    </div>
                </div>

                <!-- Sisi Kanan: Breadcrumb, Judul Merah & Deskripsi -->
                <div class="lg:col-span-6 space-y-4 sm:space-y-6" data-aos="fade-left">
                    <p class="text-xs sm:text-sm text-gray-500 font-semibold tracking-wide">
                        <a href="{{ route('ekstrakurikuler.index') }}" class="hover:text-red-700 transition">Program</a> 
                        &gt; 
                        <a href="{{ route('ekstrakurikuler.index') }}" class="hover:text-red-700 transition">Ekstrakurikuler</a>
                    </p>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight" style="color: #C8102E !important;">
                        {{ $ekstraDetail['nama'] }}
                    </h1>

                    <p class="text-xs sm:text-sm md:text-base text-gray-700 leading-relaxed font-normal text-justify">
                        {{ $ekstraDetail['deskripsi'] }}
                    </p>
                </div>

            </div>
        </div>

        <!-- ==================== NAVIGASI PANAH MERAH MELINGKAR ==================== -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-14">
            <div class="flex items-center justify-between">
                <!-- Panah Kiri (Pindah ke Ekstrakurikuler Sebelumnya) -->
                <a href="{{ route('ekstrakurikuler.show', ['slug' => $prevSlug]) }}" 
                   aria-label="Ekstrakurikuler Sebelumnya"
                   style="background-color: #C8102E !important; color: #ffffff !important;"
                   class="w-10 h-10 sm:w-11 sm:h-11 rounded-full flex items-center justify-center shadow-md hover:bg-red-800 transition active:scale-95 cursor-pointer">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </a>

                <!-- Panah Kanan (Pindah ke Ekstrakurikuler Berikutnya) -->
                <a href="{{ route('ekstrakurikuler.show', ['slug' => $nextSlug]) }}" 
                   aria-label="Ekstrakurikuler Berikutnya"
                   style="background-color: #C8102E !important; color: #ffffff !important;"
                   class="w-10 h-10 sm:w-11 sm:h-11 rounded-full flex items-center justify-center shadow-md hover:bg-red-800 transition active:scale-95 cursor-pointer">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>

        <!-- ==================== SECTION GALERI KEGIATAN (8 KARTU FOTO) ==================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Galeri Kegiatan
                </h2>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-1">
                    Ekstrakurikuler <span style="color: #C8102E !important;">{{ $ekstraDetail['nama'] }}</span>
                </h3>
            </div>

            <!-- Responsive 4-Column Grid (8 Foto Dokumentasi Sesuai Figma) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($ekstraDetail['gallery'] as $index => $item)
                    <div onclick="openLightbox('{{ $item['image'] }}', '{{ $item['caption'] }}')"
                         class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 cursor-pointer flex flex-col">
                        <div class="w-full aspect-[4/3] overflow-hidden bg-gray-100">
                            <img src="{{ $item['image'] }}" 
                                 alt="{{ $item['caption'] }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}';" loading="eager" decoding="async" fetchpriority="high">
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-400">
                        <p class="text-sm font-medium">Dokumentasi kegiatan untuk ekstrakurikuler ini akan segera diperbarui.</p>
                    </div>
                @endforelse
            </div>

        </section>

    </div>

    <!-- ==================== LIGHTBOX MODAL PREVIEW FOTO ==================== -->
    <div id="lightboxModal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="relative max-w-4xl w-full flex flex-col items-center">
            <button onclick="closeLightbox()" aria-label="Tutup Preview" class="absolute -top-12 right-0 text-white hover:text-red-400 text-3xl font-bold transition focus:outline-none">
                &times;
            </button>
            <img id="lightboxImg" src="" alt="Preview Foto" class="max-h-[80vh] w-auto rounded-2xl shadow-2xl object-contain border-2 border-white/20" loading="lazy" decoding="async">
            <p id="lightboxCaption" class="text-white text-xs sm:text-sm font-medium mt-4 text-center bg-black/50 px-4 py-2 rounded-full"></p>
        </div>
    </div>

@else
    {{-- =========================================================================
         BAGIAN 2: KATALOG EKSTRAKURIKULER (DESAIN FIGMA: Desktop - 27.png)
         ========================================================================= --}}
    <!-- 1. Hero Section Ekstrakurikuler -->
    <section class="relative pt-32 sm:pt-40 pb-16 overflow-hidden bg-gradient-to-br from-[#EAEAEA] via-[#F4F4F4] to-white">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-gray-200/40 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Sisi Kiri: 3D Emblem Perisai Bintang -->
                <div class="lg:col-span-5 flex justify-center items-center" data-aos="zoom-in">
                    <div class="relative w-full max-w-[320px] sm:max-w-[360px]">
                        <img src="{{ asset('images/ekstra/ekstra.webp') }}" 
                             alt="Emblem Ekstrakurikuler SMK Telkom Sidoarjo" 
                             class="w-full h-auto object-contain select-none drop-shadow-2xl"
                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}';" loading="lazy" decoding="async">
                    </div>
                </div>

                <!-- Sisi Kanan: Headline & Deskripsi -->
                <div class="lg:col-span-7 space-y-5 text-center lg:text-left" data-aos="fade-left">
                    <div class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500">
                        <span>Program</span>
                        <span>&gt;</span>
                        <span class="text-gray-900 font-bold">Ekstrakurikuler</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-[1.1] tracking-tight">
                        Ekstrakurikuler
                    </h1>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-xl mx-auto lg:mx-0 font-normal">
                        SMK Telkom Sidoarjo menyediakan beragam ekstrakurikuler yang dirancang untuk mengembangkan minat, bakat, dan soft skill siswa di luar jam akademik. Temukan aktivitas yang sesuai dengan passion Anda dan kembangkan potensi terbaik bersama kami.
                    </p>

                    <div class="pt-2 flex justify-center lg:justify-start">
                        <a href="#kegiatan-ekstra" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
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

    <!-- 2. Section Kegiatan Ekstrakurikuler (Carousel 6 Card) -->
    <section id="kegiatan-ekstra" class="py-14 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24" data-aos="fade-up">
        
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Kegiatan <span style="color: #C8102E !important;">Ekstrakurikuler</span>
            </h2>
            <p class="text-base font-bold text-slate-900 mt-1">Smk Telkom Sidoarjo</p>
        </div>

        <div class="relative px-2 sm:px-6">

            <!-- Track Carousel -->
            <div class="overflow-hidden py-4">
                <div id="ekstraCarouselTrack" class="flex transition-transform duration-500 ease-out gap-6">
                    @foreach($ekstras as $item)
                        <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] shrink-0">
                            <div class="border-2 border-dashed border-gray-300 rounded-[2.5rem] p-5 sm:p-6 bg-white relative hover:shadow-xl hover:border-red-700 transition-all duration-300 flex flex-col justify-between h-full group">
                                <div>
                                    <div class="h-48 bg-gray-100 rounded-2xl mb-6 overflow-hidden flex items-center justify-center border border-gray-100">
                                        <img src="{{ $item['image'] }}"
                                             alt="{{ $item['name'] }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}';" loading="lazy" decoding="async">
                                    </div>
                                    <div class="flex items-center justify-between text-xs font-semibold text-gray-400 mb-2">
                                        <span class="text-red-700">Ekstrakurikuler</span>
                                    </div>
                                    <h3 class="font-bold text-base text-gray-900 mb-3 line-clamp-2 group-hover:text-red-700 transition-colors">
                                        {{ $item['name'] }}
                                    </h3>
                                </div>
                                <div class="pt-4 border-t border-gray-50 flex justify-end">
                                    <a href="{{ route('ekstrakurikuler.show', ['slug' => $item['slug']]) }}"
                                       class="inline-flex items-center gap-1.5 text-xs font-bold text-red-700 hover:text-red-800 border border-red-200 rounded-full px-4 py-2 hover:bg-red-50 transition cursor-pointer">
                                        Lihat
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Carousel Navigation (Panah & Dots) -->
            <div class="flex items-center justify-center gap-6 mt-8">
                <button onclick="prevEkstraSlide()"
                        aria-label="Previous"
                        class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>

                <!-- Tempat Dots Otomatis -->
                <div id="ekstraDotsContainer" class="flex flex-wrap items-center justify-center gap-2 max-w-lg"></div>

                <button onclick="nextEkstraSlide()"
                        aria-label="Next"
                        class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
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
    // Lightbox Modal Functions untuk Galeri Foto
    function openLightbox(imgSrc, caption) {
        const modal = document.getElementById('lightboxModal');
        const img = document.getElementById('lightboxImg');
        const cap = document.getElementById('lightboxCaption');
        if (!modal || !img) return;

        img.src = imgSrc;
        cap.textContent = caption || '';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const modal = document.getElementById('lightboxModal');
        if (!modal) return;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Carousel Slider Logic untuk Katalog Ekstrakurikuler
    document.addEventListener('DOMContentLoaded', function () {
        const track = document.getElementById('ekstraCarouselTrack');
        const dotsContainer = document.getElementById('ekstraDotsContainer');
        if (!track || !dotsContainer) return;

        const totalItems = {{ count($ekstras ?? []) }};
        let currentIndex = 0;

        function getItemsPerView() {
            if (window.innerWidth >= 1024) return 3;
            if (window.innerWidth >= 640) return 2;
            return 1;
        }

        function getMaxIndex() {
            return Math.max(0, totalItems - getItemsPerView());
        }

        function renderDots() {
            dotsContainer.innerHTML = '';
            const maxIndex = getMaxIndex();
            const totalDots = maxIndex + 1;

            for (let i = 0; i < totalDots; i++) {
                const dot = document.createElement('button');
                dot.setAttribute('aria-label', 'Slide ' + (i + 1));
                dot.className = 'rounded-full transition-all cursor-pointer h-2.5 ' + (
                    i === currentIndex ? 'bg-red-700 w-6' : 'bg-gray-300 w-2.5 hover:bg-gray-400'
                );
                dot.addEventListener('click', () => {
                    currentIndex = i;
                    updateSlider();
                });
                dotsContainer.appendChild(dot);
            }
        }

        function updateSlider() {
            const itemsPerView = getItemsPerView();
            const percentageStep = 100 / itemsPerView;
            
            track.style.transform = `translateX(-${currentIndex * percentageStep}%)`;

            Array.from(dotsContainer.children).forEach((dot, idx) => {
                if (idx === currentIndex) {
                    dot.className = 'rounded-full transition-all cursor-pointer h-2.5 bg-red-700 w-6';
                } else {
                    dot.className = 'rounded-full transition-all cursor-pointer h-2.5 bg-gray-300 w-2.5 hover:bg-gray-400';
                }
            });
        }

        window.prevEkstraSlide = function () {
            const maxIndex = getMaxIndex();
            currentIndex = currentIndex <= 0 ? maxIndex : currentIndex - 1;
            updateSlider();
        };

        window.nextEkstraSlide = function () {
            const maxIndex = getMaxIndex();
            currentIndex = currentIndex >= maxIndex ? 0 : currentIndex + 1;
            updateSlider();
        };

        window.addEventListener('resize', () => {
            if (currentIndex > getMaxIndex()) {
                currentIndex = getMaxIndex();
            }
            renderDots();
            updateSlider();
        });

        renderDots();
        updateSlider();
    });
</script>
@endpush