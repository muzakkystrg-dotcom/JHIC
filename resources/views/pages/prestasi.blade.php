@extends('layouts.app')

@section('title', 'Prestasi - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section (Dengan animasi Fade-In) -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16" data-aos="fade-in" data-aos-duration="1000">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: 3D Icon Trophy (Animasi Zoom-In) -->
        <div class="relative w-full h-[350px] md:h-[400px] flex justify-center items-center md:order-1 order-2" data-aos="zoom-in" data-aos-delay="200">
            <img src="{{ asset('images/prestasi/piala.webp') }}" alt="Piala Prestasi" class="relative z-10 w-[200px] md:w-[240px] h-auto object-contain drop-shadow-2xl" loading="eager" decoding="async" fetchpriority="high" width="206" height="273">
        </div>

        <!-- Teks Kanan (Animasi Fade-Right) -->
        <div class="md:order-2 order-1" data-aos="fade-right" data-aos-delay="400">
            <div class="text-sm text-gray-500 font-medium mb-3 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-red-700 transition">Tentang kami</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-gray-900 font-semibold">Prestasi</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                Prestasi
            </h1>
            
            <p class="text-gray-600 text-sm md:text-base mb-8 leading-relaxed">
                SMK Telkom Sidoarjo berkomitmen mengasah potensi akademik dan non-akademik siswa. Dengan lingkungan belajar yang kompetitif dan dukungan pembimbing profesional, kami mencetak Generasi Digital yang berani berinovasi dan siap menjadi juara. Prestasi regional dan nasional adalah bukti nyata kurikulum yang relevan dan pembinaan karakter yang kuat.
            </p>
            
            <a href="#grafik-prestasi" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
                Jelajahi 
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

<!-- Section Grafik Prestasi Siswa (Dengan animasi Fade-Up) -->
<section id="grafik-prestasi" class="py-20 bg-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Grafik Prestasi Siswa <span class="text-red-700">Smk Telkom Sidoarjo</span>
            </h2>
        </div>

        <!-- Card Container Grafik -->
        <div class="bg-white rounded-[2.5rem] p-6 md:p-10 shadow-xl border border-gray-100 max-w-5xl mx-auto" data-aos="zoom-in" data-aos-delay="200">
            <div class="relative h-[350px] w-full">
                <canvas id="achievementChart"></canvas>
            </div>

            <!-- Custom Legend -->
            <div class="flex flex-wrap items-center justify-center gap-8 mt-8 pt-6 border-t border-gray-100 text-sm font-medium text-gray-700">
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 rounded-full bg-red-600"></span>
                    <span>Kabupaten</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 rounded-full bg-red-600"></span>
                    <span>Provinsi</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 rounded-full bg-red-600"></span>
                    <span>Nasional</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 rounded-full bg-red-600"></span>
                    <span>Internasional</span>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Section Prestasi Siswa (Carousel / Slider Card dengan animasi Fade-Up) -->
<section class="py-20 bg-gray-50" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Prestasi Siswa <span class="text-red-700">Smk Telkom Sidoarjo</span>
            </h2>
        </div>

        <!-- Carousel Container -->
        <div class="relative overflow-hidden px-4 py-6" data-aos="fade-up" data-aos-delay="200">
            <div id="achievementCarousel" class="flex transition-transform duration-500 ease-out gap-8">
                
                @foreach($achievements as $ach)
                    <div class="w-full md:w-[calc(33.333%-1.33rem)] shrink-0">
                        <div class="border-2 border-dashed border-gray-300 rounded-[2.5rem] p-6 bg-white relative hover:shadow-xl hover:border-red-700 transition-all duration-300 flex flex-col justify-between h-full group">
                            <div>
                                <div class="h-56 bg-gray-100 rounded-2xl mb-6 overflow-hidden flex items-center justify-center border border-gray-100">
                                    <img src="{{ $ach->image ? asset($ach->image) : asset('images/prestasi/juara.webp') }}" alt="{{ $ach->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="eager" decoding="async" fetchpriority="high">
                                </div>
                                <span class="inline-block bg-red-50 text-red-700 text-xs font-bold px-3 py-1 rounded-full mb-3">
                                    {{ $ach->category }}
                                </span>
                                <p class="text-gray-700 text-sm leading-relaxed mb-6 font-medium">
                                    "{{ $ach->description }}"
                                </p>
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
        <div class="flex items-center justify-center gap-6 mt-12" data-aos="fade-up">
            <button id="prevAch" class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>
            
            <div id="achDots" class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-red-700 w-6 transition-all cursor-pointer" data-slide="0"></span>
                <span class="w-3 h-3 rounded-full bg-gray-300 transition-all cursor-pointer" data-slide="1"></span>
                <span class="w-3 h-3 rounded-full bg-gray-300 transition-all cursor-pointer" data-slide="2"></span>
            </div>

            <button id="nextAch" class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', async function() {
        // 1. Inisialisasi Chart.js Bar Chart (Chart.js diunduh on-demand via Vite)
        const Chart = await window.jhicLoadChart();
        const ctx = document.getElementById('achievementChart').getContext('2d');
        const chartData = @json($chartData);
        const chartMax = Math.max(...chartData.data, 1);
        const axisMax = Math.ceil(chartMax * 1.1) || 1;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    data: chartData.data,
                    backgroundColor: '#E53935',
                    borderRadius: 8,
                    barThickness: 50,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` Jumlah: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: axisMax,
                        ticks: {
                            stepSize: Math.max(1, Math.ceil(axisMax / 4)),
                            font: { family: 'Plus Jakarta Sans', size: 12 }
                        },
                        grid: {
                            color: '#F3F4F6',
                            borderDash: [4, 4]
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 13, weight: '600' }
                        }
                    }
                }
            }
        });

        // 2. Inisialisasi Carousel Prestasi Siswa
        const carousel = document.getElementById('achievementCarousel');
        const prevBtn = document.getElementById('prevAch');
        const nextBtn = document.getElementById('nextAch');
        const dots = document.querySelectorAll('#achDots span');

        if (carousel) {
            let currentIndex = 0;
            const totalSlides = 3;

            function updateAchCarousel() {
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
                    updateAchCarousel();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                    updateAchCarousel();
                });
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentIndex = index;
                    updateAchCarousel();
                });
            });
        }
    });
</script>
@endpush