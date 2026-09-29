@extends('layouts.app')

@section('title', 'Berita & Informasi - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: Siswa Bergestur Tiga Jari (Folder: images/berita/siswa-berita.png) -->
        <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2">
            <!-- Lingkaran Merah di Background -->
            <div class="absolute w-[280px] h-[280px] md:w-[330px] md:h-[330px] bg-red-700 rounded-full shadow-xl"></div>
            <!-- Garis Putus-putus Melingkar -->
            <div class="absolute w-[310px] h-[310px] md:w-[360px] md:h-[360px] border-2 border-dashed border-gray-400 rounded-full pointer-events-none"></div>
            <!-- Foto Siswa -->
            <img src="{{ asset('images/berita/siswa-berita.png') }}" alt="Siswa SMK Telkom" class="relative z-10 w-[240px] md:w-[280px] h-auto object-contain drop-shadow-2xl">
        </div>

        <!-- Teks Kanan -->
        <div class="md:order-2 order-1">
            <div class="text-sm text-gray-500 font-medium mb-3 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-red-700 transition">Informasi</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-gray-900 font-semibold">Berita</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                Informasi Terkini dan <span class="text-red-700">Berita</span> Menarik SMK Telkom Sidoarjo
            </h1>
            
            <a href="#katalog-berita" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 mt-4">
                Jelajahi 
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

<!-- Section Katalog Berita & Search -->
<section id="katalog-berita" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <!-- Judul Section -->
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Halaman Berita
            </h2>
        </div>

        <!-- Search Bar -->
        <div class="max-w-3xl mx-auto mb-10 relative">
            <input type="text" id="newsSearch" placeholder="Cari Berita" class="w-full pl-12 pr-4 py-4 rounded-xl border border-gray-200 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-red-700 text-sm font-medium text-gray-700">
            <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-4 top-4"></i>
        </div>

        <!-- Category Badges / Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-16">
            @foreach($categories as $index => $cat)
                <button class="category-btn px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm cursor-pointer {{ $index === 0 ? 'bg-red-700 text-white shadow-md' : 'bg-white text-gray-600 border border-dashed border-gray-300 hover:border-red-700 hover:text-red-700' }}" data-category="{{ $cat }}">
                    {{ $cat }}
                </button>
            @endforeach
        </div>

        <!-- Carousel / Grid Berita -->
        <div class="relative overflow-hidden px-2 py-4 mb-10">
            <div id="newsCarousel" class="flex transition-transform duration-500 ease-out gap-6">
                @foreach($beritas as $news)
                    <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] shrink-0 news-item" data-category="{{ $news['category'] }}">
                        <div class="border-2 border-dashed border-gray-300 rounded-[2.5rem] p-6 bg-white relative hover:shadow-xl hover:border-red-700 transition-all duration-300 flex flex-col justify-between h-full group">
                            <div>
                                <div class="h-48 bg-gray-100 rounded-2xl mb-6 overflow-hidden flex items-center justify-center border border-gray-100">
                                    <img src="{{ $news['thumbnail'] }}" alt="{{ $news['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="flex items-center justify-between text-xs font-semibold text-gray-400 mb-2">
                                    <span class="text-red-700">{{ $news['category'] }}</span>
                                    <span>{{ \Carbon\Carbon::parse($news['published_at'])->format('Y-m-d H:i') }}</span>
                                </div>
                                <h3 class="font-bold text-base text-gray-900 mb-3 line-clamp-2 group-hover:text-red-700 transition-colors">
                                    {{ $news['title'] }}
                                </h3>
                            </div>
                            <div class="pt-4 border-t border-gray-50 flex justify-end">
                                <a href="#" class="bg-red-700 text-white text-xs px-4 py-2 rounded-full hover:bg-red-800 transition-colors flex items-center gap-1.5 shadow-sm font-bold">
                                    Selengkapnya 
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
            <button id="prevNews" class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>
            <div id="newsDots" class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-red-700 w-6 transition-all cursor-pointer"></span>
                <span class="w-3 h-3 rounded-full bg-gray-300 transition-all cursor-pointer"></span>
                <span class="w-3 h-3 rounded-full bg-gray-300 transition-all cursor-pointer"></span>
            </div>
            <button id="nextNews" class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Filter Kategori & Search
        const categoryBtns = document.querySelectorAll('.category-btn');
        const searchInput = document.getElementById('newsSearch');
        const newsItems = document.querySelectorAll('.news-item');

        let activeCategory = 'Semua';

        function filterNews() {
            const query = searchInput.value.toLowerCase();

            newsItems.forEach(item => {
                const category = item.getAttribute('data-category');
                const title = item.querySelector('h3').innerText.toLowerCase();

                const matchesCategory = (activeCategory === 'Semua' || category === activeCategory);
                const matchesQuery = title.includes(query);

                if (matchesCategory && matchesQuery) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        categoryBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                categoryBtns.forEach(b => {
                    b.classList.remove('bg-red-700', 'text-white', 'shadow-md');
                    b.classList.add('bg-white', 'text-gray-600', 'border', 'border-dashed', 'border-gray-300');
                });
                btn.classList.remove('bg-white', 'text-gray-600', 'border', 'border-dashed', 'border-gray-300');
                btn.classList.add('bg-red-700', 'text-white', 'shadow-md');

                activeCategory = btn.getAttribute('data-category');
                filterNews();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', filterNews);
        }

        // 2. Carousel Berita
        const carousel = document.getElementById('newsCarousel');
        const prevBtn = document.getElementById('prevNews');
        const nextBtn = document.getElementById('nextNews');
        const dots = document.querySelectorAll('#newsDots span');

        if (carousel) {
            let currentIndex = 0;
            const totalSlides = 3;

            function updateCarousel() {
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

            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex + 1) % totalSlides;
                    updateCarousel();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                    updateCarousel();
                });
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentIndex = index;
                    updateCarousel();
                });
            });
        }
    });
</script>
@endpush