@extends('layouts.app')

@section('title', isset($ekstraDetail) ? 'Ekstrakurikuler ' . $ekstraDetail['nama'] . ' - SMK Telkom Sidoarjo' : 'Ekstrakurikuler & Club - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#F8F9FA] min-h-screen text-slate-800 font-sans">

@if(isset($ekstraDetail))
    {{-- =========================================================================
         BAGIAN 1: DETAIL EKSTRAKURIKULER & GALERI (DESAIN FIGMA: Desktop - 40.png)
         ========================================================================= --}}
    <div class="pt-36 sm:pt-40 pb-24">
        
        <!-- ==================== HERO SECTION DETAIL EKSTRAKURIKULER ==================== -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Sisi Kiri: Foto Utama Ekstrakurikuler (hero-paskib.png) -->
                <div class="lg:col-span-6" data-aos="fade-right">
                    <div class="w-full rounded-3xl overflow-hidden shadow-lg border border-gray-100 bg-white aspect-[4/3] sm:aspect-[16/11]">
                        <img src="{{ $ekstraDetail['hero_image'] }}" 
                             alt="{{ $ekstraDetail['nama'] }}" 
                             class="w-full h-full object-cover select-none transition-transform duration-500 hover:scale-105"
                             onerror="this.onerror=null; this.src='{{ asset('images/ekstra/paskib.png') }}';">
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
                                 onerror="this.onerror=null; this.src='/images/ekstra/paskib/paskib1.png';">
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
            <img id="lightboxImg" src="" alt="Preview Foto" class="max-h-[80vh] w-auto rounded-2xl shadow-2xl object-contain border-2 border-white/20">
            <p id="lightboxCaption" class="text-white text-xs sm:text-sm font-medium mt-4 text-center bg-black/50 px-4 py-2 rounded-full"></p>
        </div>
    </div>

@else
    {{-- =========================================================================
         BAGIAN 2: KATALOG EKSTRAKURIKULER (DESAIN FIGMA: Desktop - 27.png)
         ========================================================================= --}}
    <!-- 1. Hero Section Ekstrakurikuler -->
    <section class="relative pt-40 pb-16 overflow-hidden bg-gradient-to-br from-[#EAEAEA] via-[#F4F4F4] to-white">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-gray-200/40 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Sisi Kiri: 3D Emblem Perisai Bintang -->
                <div class="lg:col-span-5 flex justify-center items-center" data-aos="zoom-in">
                    <div class="relative w-full max-w-[320px] sm:max-w-[360px]">
                        <img src="{{ asset('images/ekstra/logo-ekstra.png') }}" 
                             alt="Emblem Ekstrakurikuler SMK Telkom Sidoarjo" 
                             class="w-full h-auto object-contain select-none drop-shadow-2xl"
                             onerror="this.onerror=null; this.src='{{ asset('images/ekstra/ekstra.png') }}';">
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
                        <a href="#kegiatan-ekstra" 
                           style="background-color: #C8102E !important; color: #ffffff !important;"
                           class="inline-flex items-center gap-2.5 px-8 py-3 hover:opacity-90 font-bold text-xs sm:text-sm rounded-full shadow-md transition-all duration-200 active:scale-95 cursor-pointer">
                            <span>Jelajahi</span>
                            <span class="text-base leading-none">➔</span>
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
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Kegiatan <span style="color: #C8102E !important;">Ekstrakurikuler</span>
            </h2>
            <p class="text-base font-bold text-slate-900 mt-1">Smk Telkom Sidoarjo</p>
        </div>

        <div class="relative px-2 sm:px-6">
            
            <!-- Tombol Panah Kiri Slider -->
            <button onclick="prevEkstraSlide()" 
                    aria-label="Previous Slide"
                    style="background-color: #C8102E !important; color: #ffffff !important;"
                    class="absolute -left-2 sm:-left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:bg-red-800 transition active:scale-95 z-20 cursor-pointer">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>

            <!-- Tombol Panah Kanan Slider -->
            <button onclick="nextEkstraSlide()" 
                    aria-label="Next Slide"
                    style="background-color: #C8102E !important; color: #ffffff !important;"
                    class="absolute -right-2 sm:-right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:bg-red-800 transition active:scale-95 z-20 cursor-pointer">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>

            <!-- Track Carousel -->
            <div class="overflow-hidden py-4">
                <div id="ekstraCarouselTrack" class="flex transition-transform duration-500 ease-out gap-6">
                    @foreach($ekstras as $item)
                        <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] shrink-0">
                            <!-- KARTU EKSTRAKURIKULER (CORNER DASHED BRACKETS) -->
                            <div class="relative p-5 bg-white transition-all duration-300 hover:-translate-y-1 select-none shadow-sm">
                                <div class="absolute top-0 left-0 w-8 h-8 border-t-2 border-l-2 border-dashed border-gray-400 pointer-events-none"></div>
                                <div class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-dashed border-gray-400 pointer-events-none"></div>
                                <div class="absolute bottom-0 left-0 w-8 h-8 border-b-2 border-l-2 border-dashed border-gray-400 pointer-events-none"></div>
                                <div class="absolute bottom-0 right-0 w-8 h-8 border-b-2 border-r-2 border-dashed border-gray-400 pointer-events-none"></div>

                                <div class="space-y-4">
                                    <div class="w-full aspect-[2/1] overflow-hidden rounded-md bg-gray-100 flex items-center justify-center">
                                        <img src="{{ $item['image'] }}" 
                                             alt="{{ $item['name'] }}" 
                                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                             onerror="this.onerror=null; this.src='https://placehold.co/400x200?text=Ekstrakurikuler';">
                                    </div>

                                    <!-- Tombol Lihat ➔ Mengarah ke Halaman Detail & Galeri -->
                                    <div class="flex items-center justify-between pt-1">
                                        <h4 class="text-sm font-bold text-gray-900 tracking-tight">{{ $item['name'] }}</h4>
                                        <a href="{{ route('ekstrakurikuler.show', ['slug' => $item['slug']]) }}" 
                                           style="background-color: #C8102E !important; color: #ffffff !important;" 
                                           class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded hover:bg-red-800 transition active:scale-95 shadow-sm">
                                            <span>Lihat</span>
                                            <span class="text-xs leading-none">➔</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Dots Pagination Indikator -->
            <div id="ekstraDotsContainer" class="flex items-center justify-center gap-2 mt-8"></div>

        </div>

    </section>

    <!-- 3. Section Kegiatan Club -->
    <section class="py-14 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Kegiatan <span style="color: #C8102E !important;">Club</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto mb-16">
            @foreach($clubs as $club)
                <div class="relative p-5 bg-white transition-all duration-300 hover:-translate-y-1 select-none shadow-sm">
                    <div class="absolute top-0 left-0 w-8 h-8 border-t-2 border-l-2 border-dashed border-gray-400 pointer-events-none"></div>
                    <div class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-dashed border-gray-400 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 w-8 h-8 border-b-2 border-l-2 border-dashed border-gray-400 pointer-events-none"></div>
                    <div class="absolute bottom-0 right-0 w-8 h-8 border-b-2 border-r-2 border-dashed border-gray-400 pointer-events-none"></div>

                    <div class="space-y-4">
                        <div class="w-full aspect-[2/1] bg-gray-300 rounded-md flex items-center justify-center"></div>
                        <div class="pt-1">
                            <h4 class="text-sm font-bold text-gray-900 tracking-tight">{{ $club['name'] }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
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
                dot.className = `transition-all duration-300 rounded-full h-2.5 cursor-pointer ${
                    i === currentIndex ? 'w-2.5 bg-[#C8102E]' : 'w-2.5 bg-gray-300 hover:bg-gray-400'
                }`;
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
                    dot.className = 'transition-all duration-300 rounded-full h-2.5 cursor-pointer w-2.5 bg-[#C8102E]';
                } else {
                    dot.className = 'transition-all duration-300 rounded-full h-2.5 cursor-pointer w-2.5 bg-gray-300 hover:bg-gray-400';
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