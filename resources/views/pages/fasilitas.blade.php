@extends('layouts.app')

@section('title', 'Fasilitas - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
       <!-- Frame Kiri: Model 3D Isometrik Gedung Kampus -->
        <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2">
            <img src="{{ asset('images/fasilitas/sekolah3d.png') }}" alt="Model Isometrik Kampus" class="relative z-10 w-[380px] md:w-[480px] h-auto object-contain drop-shadow-2xl">
        </div>

        <!-- Teks Kanan -->
        <div class="md:order-2 order-1">
            <div class="text-sm text-gray-500 font-medium mb-3 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-red-700 transition">Tentang kami</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-gray-900 font-semibold">Fasilitas</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                Fasilitas
            </h1>
            
            <p class="text-gray-600 text-sm md:text-base mb-8 leading-relaxed">
                SMK Telkom Sidoarjo menyediakan fasilitas modern yang lengkap untuk mendukung pembelajaran Teknologi dan Informatika (TI). Kami memiliki Laboratorium (Lab) praktik up-to-date (Lab Komputer, Jaringan, Telekomunikasi) dengan perangkat standar industri. Fasilitas ini memastikan siswa mendapat pengalaman praktikal maksimal, membuat lulusan siap kerja dan unggul dalam keterampilan teknis.
            </p>
            
            <a href="#katalog-fasilitas" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95">
                Jelajahi 
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

<!-- Section Fasilitas Penunjang (15 Total Cards, 3 Visible, Proper Spacing) -->
<section id="katalog-fasilitas" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Fasilitas Penunjang <span class="text-red-700">Belajar dan Berkarya Smk Telkom Sidoarjo</span>
            </h2>
        </div>

        <!-- Carousel Container (Diberi padding horizontal agar card kanan-kiri tidak terpotong) -->
        <div class="relative overflow-hidden px-4 py-6">
            <div id="facilityCarousel" class="flex transition-transform duration-500 ease-out gap-6">
                
                @php
                    // 15 Total Kartu Fasilitas
                    $allFacilities = [
                        ['title' => 'Aula', 'desc' => 'Aula multifungsi yang digunakan untuk kegiatan sekolah seperti seminar, workshop, pertemuan wali murid, hingga acara internal dan eksternal sekolah.', 'img' => 'images/fasilitas/aula.png'],
                        ['title' => 'Gedung SMK Telkom Sidoarjo', 'desc' => 'Gedung utama SMK Telkom Sidoarjo yang representatif dengan desain modern serta fasilitas lengkap untuk menunjang kegiatan akademik.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Kantin', 'desc' => 'Kantin merupakan fasilitas sekolah untuk tempat makan dan ruang bersosialisasi yang bersih dan nyaman dilengkapi sistem transaksi cashless.', 'img' => 'images/fasilitas/kantin.png'],
                        ['title' => 'Laboratorium Komputer 1', 'desc' => 'Lab komputer dengan spesifikasi tinggi untuk mendukung praktik pemrograman, desain grafis, dan pengembangan perangkat lunak.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Laboratorium Jaringan', 'desc' => 'Laboratorium khusus perutean, switching, dan konfigurasi perangkat jaringan komputer standar industri.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Perpustakaan Digital', 'desc' => 'Pusat literasi dengan koleksi buku fisik dan e-book lengkap serta ruang baca ber-AC yang nyaman.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Lapangan Olahraga', 'desc' => 'Area outdoor yang luas untuk kegiatan olahraga basket, futsal, upacara bendera, dan kegiatan ekstrakurikuler.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Masjid Sekolah', 'desc' => 'Sarana ibadah yang luas, bersih, dan representatif untuk kegiatan keagamaan dan pembentukan karakter siswa.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Ruang UKS', 'desc' => 'Unit Kesehatan Sekolah yang siaga memberikan pertolongan pertama dan pemeriksaan kesehatan rutin.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Studio Multimedia', 'desc' => 'Studio kreatif untuk produksi konten video, podcast, fotografi, dan penyiaran digital berbasis modern.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Ruang Bimbingan Konseling', 'desc' => 'Ruang konsultasi privat yang nyaman bagi siswa untuk pengembangan diri dan perencanaan karier.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Area Parkir Luas', 'desc' => 'Fasilitas parkir kendaraan bermotor yang aman, tertib, dan terpantau sistem keamanan CCTV 24 jam.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Inkubator Bisnis / UPJ', 'desc' => 'Wadah pelatihan kewirausahaan dan proyek riil bagi siswa untuk mengasah kemampuan enterpreneurship.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Ruang OSIS & Ekstrakurikuler', 'desc' => 'Pusat koordinasi organisasi siswa dan kegiatan pengembangan bakat minat siswa.', 'img' => 'images/fasilitas/gedung-utama.png'],
                        ['title' => 'Klinik Jaringan & Perangkat', 'desc' => 'Pusat servis mandiri tempat siswa mempraktikkan troubleshooting hardware dan perbaikan jaringan.', 'img' => 'images/fasilitas/gedung-utama.png'],
                    ];
                @endphp

                @foreach($allFacilities as $index => $fac)
                    <div class="w-full md:w-[calc(33.333%-1rem)] shrink-0">
                        <div class="border-2 border-dashed border-gray-300 rounded-[2.5rem] p-6 bg-white relative hover:shadow-xl hover:border-red-700 transition-all duration-300 flex flex-col justify-between h-full group">
                            <div>
                                <div class="h-48 bg-gray-50 rounded-2xl mb-6 overflow-hidden flex items-center justify-center border border-gray-100">
                                    <img src="{{ asset($fac['img']) }}" alt="{{ $fac['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
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

        <!-- Carousel Navigation (Tombol Panah Proporsional & 15 Titik Dots) -->
        <div class="flex items-center justify-center gap-6 mt-12">
            <button id="prevSlide" class="w-9 h-9 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>
            
            <div id="carouselDots" class="flex items-center gap-1.5 flex-wrap max-w-md justify-center">
                @for($i = 0; $i < 13; $i++)
                    <span class="w-2.5 h-2.5 rounded-full {{ $i === 0 ? 'bg-red-700 w-5' : 'bg-gray-300' }} transition-all cursor-pointer" data-slide="{{ $i }}"></span>
                @endfor
            </div>

            <button id="nextSlide" class="w-9 h-9 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>
        </div>

    </div>
</section>

<!-- Section Lab Tour -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <div class="text-center mb-16">
            <span class="text-red-700 font-bold uppercase tracking-widest text-sm block mb-2">Lab Tour</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Masuki Dunia <span class="text-red-700">Laboratorium</span> yang Siap Mengasah <span class="text-red-700">Skill</span> dan <span class="text-red-700">Inovasi Siswa</span>
            </h2>
        </div>

        <div class="space-y-16">
            <!-- Baris 1: Gedung RPS Hall -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 space-y-4">
                    <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900">
                        Gedung <span class="text-red-700">RPS Hall</span>
                    </h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Gedung RPS sebagai pusat pengembangan teknologi dua lantai di SMK Telkom Sidoarjo. Dilengkapi aula luas dengan videotron modern serta dua ruang IoT untuk eksperimen dan riset.
                    </p>
                    <div class="pt-2">
                        <a href="#" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-red-800 transition-all shadow-sm hover:shadow-md active:scale-95">
                            Room Tour 
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-7">
                    <div class="rounded-3xl overflow-hidden shadow-lg border border-gray-100 bg-white">
                        <img src="{{ asset('images/fasilitas/rps.png') }}" alt="Gedung RPS Hall" class="w-full h-[320px] object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>

            <!-- Baris 2: Laboratorium IoT -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 order-2 lg:order-1">
                    <div class="rounded-3xl overflow-hidden shadow-lg border border-gray-100 bg-white">
                        <img src="{{ asset('images/fasilitas/lab.png') }}" alt="Laboratorium IoT" class="w-full h-[320px] object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
                <div class="lg:col-span-5 space-y-4 order-1 lg:order-2">
                    <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900">
                        Laboratorium <span class="text-red-700">IoT</span>
                    </h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Tempat siswa berkreasi dengan perangkat pintar dan sistem otomatisasi. Dilengkapi peralatan sensor, mikrokontroler, dan jaringan untuk menciptakan inovasi berbasis Internet of Things.
                    </p>
                    <div class="pt-2">
                        <a href="#" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-red-800 transition-all shadow-sm hover:shadow-md active:scale-95">
                            Room Tour 
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('facilityCarousel');
        const prevBtn = document.getElementById('prevSlide');
        const nextBtn = document.getElementById('nextSlide');
        const dots = document.querySelectorAll('#carouselDots span');
        
        if (!carousel) return;

        let currentIndex = 0;
        const totalCards = 15;
        const visibleCards = 3;
        const maxIndex = totalCards - visibleCards; // Total 13 slide pergeseran (0 s.d 12)

        function updateCarousel() {
            // Menghitung persentase geser berdasarkan lebar 1 card (33.333% + gap)
            const movePercentage = (currentIndex * (100 / visibleCards));
            carousel.style.transform = `translateX(-${movePercentage}%)`;

            // Update dots active state
            dots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.remove('bg-gray-300', 'w-2.5');
                    dot.classList.add('bg-red-700', 'w-5');
                } else {
                    dot.classList.remove('bg-red-700', 'w-5');
                    dot.classList.add('bg-gray-300', 'w-2.5');
                }
            });
        }

        nextBtn.addEventListener('click', () => {
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateCarousel();
            } else {
                currentIndex = 0; // Loop kembali ke awal jika sudah di ujung
                updateCarousel();
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            } else {
                currentIndex = maxIndex; // Lompat ke ujung akhir jika di awal
                updateCarousel();
            }
        });

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                updateCarousel();
            });
        });
    });
</script>
@endpush