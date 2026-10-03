@extends('layouts.app')

@section('title', 'Berita & Informasi - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section (Dilengkapi Animasi AOS) -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16" data-aos="fade-in" data-aos-duration="1000">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: Foto Siswa Murni (Mengambil dari folder images/berita/berita.webp) -->
        <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2" data-aos="zoom-in" data-aos-delay="200">
            <img src="{{ asset('images/berita/berita.webp') }}" alt="Siswa SMK Telkom" class="relative z-10 w-[260px] md:w-[320px] h-auto object-contain drop-shadow-2xl" loading="eager" decoding="async" fetchpriority="high" width="261" height="285">
        </div>

        <!-- Teks Kanan -->
        <div class="md:order-2 order-1" data-aos="fade-right" data-aos-delay="400">
            <div class="text-sm text-gray-500 font-medium mb-3 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-red-700 transition">Informasi</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-gray-900 font-semibold">Berita</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                Informasi Terkini dan <span class="text-red-700">Berita</span> Menarik SMK Telkom Sidoarjo
            </h1>
            
            <a href="#katalog-berita" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 mt-4 cursor-pointer">
                Jelajahi 
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

<!-- Section Katalog Berita & Search -->
<section id="katalog-berita" class="py-20 bg-gray-50" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <!-- Judul Section -->
        <div class="text-center mb-10" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Halaman Berita
            </h2>
        </div>

        <!-- Search Bar -->
        <div class="max-w-3xl mx-auto mb-10 relative" data-aos="fade-up" data-aos-delay="100">
            <input type="text" id="newsSearch" placeholder="Cari Berita" class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-200 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-red-700 text-sm font-medium text-gray-700">
            <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-4 top-4"></i>
        </div>

        <!-- Category Badges / Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-16" data-aos="fade-up" data-aos-delay="200">
            @foreach($categories as $index => $cat)
                <button class="category-btn px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm cursor-pointer {{ $index === 0 ? 'bg-red-700 text-white shadow-md' : 'bg-white text-gray-600 border border-dashed border-gray-300 hover:border-red-700 hover:text-red-700' }}" data-category="{{ $cat }}">
                    {{ $cat }}
                </button>
            @endforeach
        </div>

        <!-- Carousel / Grid Berita -->
        <div class="relative overflow-hidden px-2 py-4 mb-10" data-aos="fade-up" data-aos-delay="300">
            <div id="newsCarousel" class="flex transition-transform duration-500 ease-out gap-6">
                @foreach($beritas as $news)
                    <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] shrink-0 news-item" data-category="{{ $news['category'] }}">
                        <div class="border-2 border-dashed border-gray-300 rounded-[2.5rem] p-6 bg-white relative hover:shadow-xl hover:border-red-700 transition-all duration-300 flex flex-col justify-between h-full group">
                            <div>
                                <div class="h-48 bg-gray-100 rounded-2xl mb-6 overflow-hidden flex items-center justify-center border border-gray-100">
                                    <!-- Menampilkan thumbnail dari variabel array $news['thumbnail'] (asset('images/berita/juara.webp')) -->
                                    <img src="{{ $news['thumbnail'] }}" alt="Thumbnail Berita" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="eager" decoding="async" fetchpriority="high">
                                </div>
                                <div class="flex items-center justify-between text-xs font-semibold text-gray-400 mb-2">
                                    <span class="text-red-700">{{ $news['category'] }}</span>
                                    <span>{{ \Carbon\Carbon::parse($news['published_at'])->format('Y-m-d') }}</span>
                                </div>
                                <h3 class="font-bold text-base text-gray-900 mb-3 line-clamp-2 group-hover:text-red-700 transition-colors">
                                    {{ $news['title'] }}
                                </h3>
                            </div>
                            <div class="pt-4 border-t border-gray-50 flex justify-end">
                                <a href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-red-700 hover:text-red-800 border border-red-200 rounded-full px-4 py-2 hover:bg-red-50 transition cursor-pointer">
                                    Selengkapnya 
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Empty State jika pencarian tidak ditemukan -->
            <div id="emptyState" class="hidden text-center py-10 text-gray-500 italic">
                Berita tidak ditemukan.
            </div>
        </div>

        <!-- Carousel Navigation (Panah & Dots) -->
        <div class="flex items-center justify-center gap-6 mt-8" data-aos="fade-up" data-aos-delay="400">
            <button id="prevNews" aria-label="Previous" class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>
            
            <!-- Tempat Dots Otomatis -->
            <div id="newsDots" class="flex flex-wrap items-center justify-center gap-2 max-w-lg"></div>
            
            <button id="nextNews" aria-label="Next" class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Setup Carousel & Filter 
        function setupNewsFilterAndCarousel() {
            const carousel = document.getElementById('newsCarousel');
            const prevBtn = document.getElementById('prevNews');
            const nextBtn = document.getElementById('nextNews');
            const dotsContainer = document.getElementById('newsDots');
            const categoryBtns = document.querySelectorAll('.category-btn');
            const searchInput = document.getElementById('newsSearch');
            const emptyState = document.getElementById('emptyState');

            if (!carousel) return;

            let currentIndex = 0;
            const gap = 24; 
            let visibleItems = Array.from(carousel.querySelectorAll('.news-item')); 

            function getVisibleCardsCount() {
                if (window.innerWidth >= 1024) return 3; 
                if (window.innerWidth >= 640) return 2;  
                return 1;
            }

            function updateCarousel() {
                if (visibleItems.length === 0) {
                    dotsContainer.innerHTML = '';
                    carousel.style.display = 'none';
                    emptyState.classList.remove('hidden');
                    return;
                } else {
                    carousel.style.display = 'flex';
                    emptyState.classList.add('hidden');
                }

                let cardsPerView = getVisibleCardsCount();
                let maxIndex = Math.max(0, visibleItems.length - cardsPerView);
                if (currentIndex > maxIndex) currentIndex = maxIndex;

                dotsContainer.innerHTML = '';
                let numDots = maxIndex + 1;
                
                if (numDots > 1) {
                    dotsContainer.style.display = 'flex';
                    for(let i = 0; i < numDots; i++) {
                        const span = document.createElement('span');
                        span.className = 'rounded-full transition-all cursor-pointer h-2.5 ' + (i === currentIndex ? 'bg-red-700 w-6' : 'bg-gray-300 w-2.5 hover:bg-gray-400');
                        span.addEventListener('click', () => {
                            currentIndex = i;
                            applyTransform();
                        });
                        dotsContainer.appendChild(span);
                    }
                } else {
                    dotsContainer.style.display = 'none';
                }

                applyTransform();
            }

            function applyTransform() {
                if(visibleItems.length === 0) return;
                const cardWidth = visibleItems[0].offsetWidth;
                const offset = currentIndex * (cardWidth + gap);
                carousel.style.transform = `translateX(-${offset}px)`;

                if (dotsContainer) {
                    const dots = dotsContainer.querySelectorAll('span');
                    dots.forEach((dot, index) => {
                        dot.className = 'rounded-full transition-all cursor-pointer h-2.5 ' + (index === currentIndex ? 'bg-red-700 w-6' : 'bg-gray-300 w-2.5 hover:bg-gray-400');
                    });
                }
            }

            function filterData() {
                const query = searchInput ? searchInput.value.toLowerCase() : '';
                const activeCategory = document.querySelector('.category-btn.bg-red-700').getAttribute('data-category');
                const allCards = carousel.querySelectorAll('.news-item');
                
                visibleItems = [];

                allCards.forEach(card => {
                    const cat = card.getAttribute('data-category');
                    const title = card.querySelector('h3').innerText.toLowerCase();

                    const matchesCategory = (activeCategory === 'Semua' || cat === activeCategory);
                    const matchesQuery = title.includes(query);

                    if (matchesCategory && matchesQuery) {
                        card.style.display = 'block';
                        visibleItems.push(card);
                    } else {
                        card.style.display = 'none';
                    }
                });

                currentIndex = 0; 
                carousel.style.transform = `translateX(0px)`;
                updateCarousel();
            }

            categoryBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    categoryBtns.forEach(b => {
                        b.classList.remove('bg-red-700', 'text-white', 'shadow-md');
                        b.classList.add('bg-white', 'text-gray-600', 'border', 'border-dashed', 'border-gray-300');
                    });
                    btn.classList.remove('bg-white', 'text-gray-600', 'border', 'border-dashed', 'border-gray-300');
                    btn.classList.add('bg-red-700', 'text-white', 'shadow-md');
                    filterData();
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', filterData);
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    let cardsPerView = getVisibleCardsCount();
                    let maxIndex = Math.max(0, visibleItems.length - cardsPerView);
                    if (currentIndex < maxIndex) {
                        currentIndex++;
                    } else {
                        currentIndex = 0; 
                    }
                    applyTransform();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    let cardsPerView = getVisibleCardsCount();
                    let maxIndex = Math.max(0, visibleItems.length - cardsPerView);
                    if (currentIndex > 0) {
                        currentIndex--;
                    } else {
                        currentIndex = maxIndex; 
                    }
                    applyTransform();
                });
            }

            window.addEventListener('resize', updateCarousel);
            updateCarousel(); 
        }

        setupNewsFilterAndCarousel();
    });
</script>
@endpush