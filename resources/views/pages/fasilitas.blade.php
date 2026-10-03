@extends('layouts.app')

@section('title', 'Fasilitas - SMK Telkom Sidoarjo')

@section('content')

    <!-- Hero Section (Dengan animasi Fade-In) -->
    <section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16"
        data-aos="fade-in" data-aos-duration="1000">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">

            <!-- Frame Kiri: Model 3D Isometrik Gedung Kampus (Animasi Zoom-In) -->
            <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2"
                data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('images/fasilitas/sekolah3d.webp') }}" alt="Model Isometrik Kampus"
                    class="relative z-10 w-[380px] md:w-[480px] h-auto object-contain drop-shadow-2xl" loading="eager" decoding="async" fetchpriority="high" width="430" height="307">
            </div>

            <!-- Teks Kanan (Animasi Fade-Right) -->
            <div class="md:order-2 order-1" data-aos="fade-right" data-aos-delay="400">
                <div class="text-sm text-gray-500 font-medium mb-3 flex items-center gap-2">
                    <a href="{{ url('/') }}" class="hover:text-red-700 transition">Tentang kami</a>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    <span class="text-gray-900 font-semibold">Fasilitas</span>
                </div>

                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                    Fasilitas
                </h1>

                <p class="text-gray-600 text-sm md:text-base mb-8 leading-relaxed">
                    SMK Telkom Sidoarjo menyediakan fasilitas modern yang lengkap untuk mendukung pembelajaran Teknologi dan
                    Informatika (TI). Kami memiliki Laboratorium (Lab) praktik up-to-date (Lab Komputer, Jaringan,
                    Telekomunikasi) dengan perangkat standar industri. Fasilitas ini memastikan siswa mendapat pengalaman
                    praktikal maksimal, membuat lulusan siap kerja dan unggul dalam keterampilan teknis.
                </p>

                <a href="#katalog-fasilitas"
                    class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
                    Jelajahi
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- Section Fasilitas Penunjang (Disesuaikan dengan 8 Fasilitas Baru) -->
    <section id="katalog-fasilitas" class="py-20 bg-white" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">

            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                    Fasilitas Penunjang <span class="text-red-700">Belajar dan Berkarya Smk Telkom Sidoarjo</span>
                </h2>
            </div>

            @php
                $allFacilities = [
                    [
                        'title' => 'Gedung',
                        'desc' => 'Gedung utama sekolah dengan rancangan arsitektur modern berstandar industri digital, dilengkapi sistem pencahayaan dan sirkulasi udara optimal.',
                        'img' => 'images/fasilitas/gedung.webp'
                    ],
                    [
                        'title' => 'Kantin',
                        'desc' => 'Area kantin bersih dan higienis yang menyediakan beragam kuliner bergizi seimbang dengan dukungan transaksi digital cashless.',
                        'img' => 'images/fasilitas/kantin.webp'
                    ],
                    [
                        'title' => 'Lab AI',
                        'desc' => 'Laboratorium mutakhir komputasi tinggi untuk eksplorasi kecerdasan buatan, machine learning, computer vision, dan deep learning.',
                        'img' => 'images/fasilitas/labai.webp'
                    ],
                    [
                        'title' => 'Lab IoT',
                        'desc' => 'Pusat riset dan perakitan perangkat Internet of Things yang dilengkapi sensor modern, mikrokontroler, dan simulator otomatisasi.',
                        'img' => 'images/fasilitas/labiot.webp'
                    ],
                    [
                        'title' => 'Lab Komputer',
                        'desc' => 'Laboratorium komputer berperforma tinggi untuk praktik rekayasa perangkat lunak, pemrograman web, UI/UX, dan administrasi jaringan.',
                        'img' => 'images/fasilitas/labkom.webp'
                    ],
                    [
                        'title' => 'Lapangan Basket',
                        'desc' => 'Lapangan olahraga outdoor multifungsi berstandar turnamen untuk kegiatan olahraga bola basket, futsal, dan aktivitas fisik siswa.',
                        'img' => 'images/fasilitas/lapbasket.webp'
                    ],
                    [
                        'title' => 'OC Besar',
                        'desc' => 'Outdoor Class berkapasitas besar untuk presentasi proyek industri, diskusi kolaboratif antarjurusan, dan workshop.',
                        'img' => 'images/fasilitas/ocbsr.webp'
                    ],
                    [
                        'title' => 'OC Kecil',
                        'desc' => 'Outdoor Class privat dan nyaman untuk koordinasi tim kecil, bimbingan proyek portofolio, serta mentoring industri.',
                        'img' => 'images/fasilitas/ockecil.webp'
                    ],
                ];
            @endphp

            <!-- Carousel Container -->
            <div class="relative overflow-hidden px-4 py-6" data-aos="fade-up" data-aos-delay="200">
                <div id="facilityCarousel" class="flex transition-transform duration-500 ease-out gap-6">
                    @foreach($allFacilities as $fac)
                        <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] shrink-0">
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-[2.5rem] p-6 bg-white relative hover:shadow-xl hover:border-red-700 transition-all duration-300 flex flex-col justify-between h-full group">
                                <div>
                                    <div
                                        class="h-48 bg-gray-50 rounded-2xl mb-6 overflow-hidden flex items-center justify-center border border-gray-100">
                                        <img src="{{ asset($fac['img']) }}" alt="{{ $fac['title'] }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}';" loading="eager" decoding="async" fetchpriority="high">
                                    </div>
                                    <h3 class="font-bold text-xl text-gray-900 mb-3">{{ $fac['title'] }}</h3>
                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        {{ $fac['desc'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Carousel Navigation (Panah & Dots Dinamis) -->
            <div class="flex items-center justify-center gap-6 mt-12" data-aos="fade-up">
                <button id="prevSlide" aria-label="Previous Slide"
                    class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>

                <div id="carouselDots" class="flex items-center gap-1.5 flex-wrap max-w-md justify-center">
                    <!-- Di-render dinamis oleh JavaScript -->
                </div>

                <button id="nextSlide" aria-label="Next Slide"
                    class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>
            </div>

        </div>
    </section>

    <!-- Section Lab Tour (Sesuai Preferensi Anda) -->
    <section class="py-20 bg-gray-50" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">

            <!-- Header Lab Tour -->
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-red-700 font-bold uppercase tracking-widest text-sm block mb-2">Lab Tour</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                    Masuki Dunia <span class="text-red-700">Laboratorium</span> yang Siap Mengasah <span
                        class="text-red-700">Skill</span> dan <span class="text-red-700">Inovasi Siswa</span>
                </h2>
            </div>

            <div class="space-y-16">

                <!-- Baris 1: Gedung RPS Hall -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center" data-aos="fade-right">
                    <div class="lg:col-span-5 space-y-4">
                        <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900">
                            Gedung <span class="text-red-700">RPS Hall</span>
                        </h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                            Gedung RPS sebagai pusat pengembangan teknologi dua lantai di SMK Telkom Sidoarjo. Dilengkapi
                            aula luas dengan videotron modern serta dua ruang IoT untuk eksperimen dan riset.
                        </p>
                    </div>
                    <div class="lg:col-span-7" data-aos="zoom-in" data-aos-delay="200">
                        <div class="rounded-3xl overflow-hidden shadow-lg border border-gray-100 bg-white">
                            <img src="{{ asset('images/fasilitas/rps.webp') }}" alt="Gedung RPS Hall"
                                class="w-full aspect-[4/3] object-cover hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async" width="478" height="300">
                        </div>
                    </div>
                </div>

                <!-- Baris 2: Laboratorium IoT -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center" data-aos="fade-left">
                    <div class="lg:col-span-7 order-2 lg:order-1" data-aos="zoom-in" data-aos-delay="200">
                        <div class="rounded-3xl overflow-hidden shadow-lg border border-gray-100 bg-white">
                            <img src="{{ asset('images/fasilitas/labiot.webp') }}" alt="Laboratorium IoT"
                                class="w-full aspect-[4/3] object-cover hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async" width="1125" height="1500">
                        </div>
                    </div>
                    <div class="lg:col-span-5 space-y-4 order-1 lg:order-2">
                        <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900">
                            Laboratorium <span class="text-red-700">IoT</span>
                        </h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                            Tempat siswa berkreasi dengan perangkat pintar dan sistem otomatisasi. Dilengkapi peralatan
                            sensor, mikrokontroler, dan jaringan untuk menciptakan inovasi berbasis Internet of Things.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carousel = document.getElementById('facilityCarousel');
            const prevBtn = document.getElementById('prevSlide');
            const nextBtn = document.getElementById('nextSlide');
            const dotsContainer = document.getElementById('carouselDots');

            if (!carousel || !dotsContainer) return;

            const totalCards = {{ count($allFacilities) }};
            let currentIndex = 0;

            function getVisibleCards() {
                if (window.innerWidth >= 1024) return 3;
                if (window.innerWidth >= 640) return 2;
                return 1;
            }

            function getMaxIndex() {
                return Math.max(0, totalCards - getVisibleCards());
            }

            function renderDots() {
                dotsContainer.innerHTML = '';
                const maxIndex = getMaxIndex();
                const totalDots = maxIndex + 1;

                for (let i = 0; i < totalDots; i++) {
                    const dot = document.createElement('span');
                    dot.className = `transition-all cursor-pointer h-2.5 rounded-full ${i === currentIndex ? 'bg-red-700 w-5' : 'bg-gray-300 w-2.5'
                        }`;
                    dot.addEventListener('click', () => {
                        currentIndex = i;
                        updateCarousel();
                    });
                    dotsContainer.appendChild(dot);
                }
            }

            function updateCarousel() {
                const visibleCards = getVisibleCards();
                const movePercentage = currentIndex * (100 / visibleCards);
                carousel.style.transform = `translateX(-${movePercentage}%)`;

                Array.from(dotsContainer.children).forEach((dot, index) => {
                    if (index === currentIndex) {
                        dot.className = 'transition-all cursor-pointer h-2.5 rounded-full bg-red-700 w-5';
                    } else {
                        dot.className = 'transition-all cursor-pointer h-2.5 rounded-full bg-gray-300 w-2.5';
                    }
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    const maxIndex = getMaxIndex();
                    currentIndex = (currentIndex < maxIndex) ? currentIndex + 1 : 0;
                    updateCarousel();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    const maxIndex = getMaxIndex();
                    currentIndex = (currentIndex > 0) ? currentIndex - 1 : maxIndex;
                    updateCarousel();
                });
            }

            window.addEventListener('resize', () => {
                if (currentIndex > getMaxIndex()) {
                    currentIndex = getMaxIndex();
                }
                renderDots();
                updateCarousel();
            });

            renderDots();
            updateCarousel();
        });
    </script>
@endpush