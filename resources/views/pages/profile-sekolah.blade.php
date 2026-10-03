@extends('layouts.app')

@section('title', 'Profile Sekolah - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section (Dengan animasi Fade-In) -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16" data-aos="fade-in" data-aos-duration="1000">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: Siswi Berjilbab (Animasi Zoom-In) -->
        <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2" data-aos="zoom-in" data-aos-delay="200">
            <img src="{{ asset('images/profile/siswi.webp') }}" alt="Siswi SMK Telkom" class="relative z-10 w-[260px] md:w-[320px] h-auto object-contain drop-shadow-2xl" loading="eager" decoding="async" fetchpriority="high" width="351" height="357">
        </div>

        <!-- Teks Kanan (Animasi Fade-Right) -->
        <div class="md:order-2 order-1" data-aos="fade-right" data-aos-delay="400">
            <div class="text-sm text-gray-500 font-medium mb-3 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-red-700 transition">Tentang kami</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-gray-900 font-semibold">Profile Sekolah</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                Profile <span class="text-red-700">Sekolah</span>
            </h1>
            
            <p class="text-gray-600 text-sm md:text-base mb-8 leading-relaxed">
                SMK Telkom Sidoarjo adalah SMK Teknologi dan Informatika di bawah Yayasan Pendidikan Telkom, berdiri tahun 2018 dengan akreditasi "A" dan standar ISO 21001:2018. Sekolah ini menawarkan jurusan TJAT dan SIJA, menggunakan Kurikulum Nasional Plus yang fokus melatih siswa siap bekerja dan terampil dalam mengoperasikan serta memelihara jaringan telekomunikasi sesuai kebutuhan industri.
            </p>
            
            <a href="#visi-misi" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
                Jelajahi 
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

<!-- Section Visi & Misi Sekolah (Animasi Fade-Up) -->
<section id="visi-misi" class="py-20 bg-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <!-- Outer Container dengan Dashed Corner Frame -->
        <div class="border-2 border-dashed border-gray-300 rounded-[2.5rem] p-8 md:p-12 relative bg-white shadow-sm hover:border-red-700 transition-colors duration-300">
            
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-10">
                Visi & Misi Sekolah
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                <!-- Sisi Kiri: Accordion Visi & Misi -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <!-- Visi Item -->
                    <div class="border-b border-gray-100 pb-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-red-700 text-white flex items-center justify-center shrink-0 mt-1 shadow-sm">
                                <i data-lucide="plus" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-gray-900 mb-1">Visi Sekolah</h3>
                                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                                    {{ $visiMisi['visi'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Misi Item -->
                    <div class="pb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-red-700 text-white flex items-center justify-center shrink-0 mt-1 shadow-sm">
                                <i data-lucide="plus" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-gray-900 mb-1">Misi Sekolah</h3>
                                <ol class="list-decimal list-inside space-y-2 text-gray-600 text-sm md:text-base leading-relaxed">
                                    @foreach($visiMisi['misi'] as $misi)
                                        <li>{{ $misi }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs italic text-gray-400 pt-4">
                        Visi dan misi ini menjadi arah langkah SMK Telkom Sidoarjo dalam mencetak generasi unggul di era digital.
                    </p>
                </div>

                <!-- Sisi Kanan: Ilustrasi 3D Buku Dokumen Merah (Animasi Zoom-In) -->
                <div class="lg:col-span-5 flex justify-center items-center" data-aos="zoom-in" data-aos-delay="300">
                    <img src="{{ asset('images/profile/buku.webp') }}" alt="Ilustrasi Buku Dokumen" class="w-64 md:w-80 h-auto object-contain drop-shadow-xl hover:scale-105 transition-transform duration-300" loading="eager" decoding="async" fetchpriority="high" width="253" height="296">
                </div>

            </div>

        </div>

    </div>
</section>

<!-- Section Terakreditasi A (Animasi Fade-Up) -->
<section class="py-12 bg-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <!-- Outer Container dengan Dashed Corner Frame -->
        <div class="border-2 border-dashed border-gray-300 rounded-[2.5rem] p-8 md:p-12 relative bg-white shadow-sm hover:border-red-700 transition-colors duration-300">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Sisi Kiri: Badge Medali Akreditasi A (Animasi Zoom-In) -->
                <div class="lg:col-span-5 flex justify-center" data-aos="zoom-in" data-aos-delay="100">
                    <img src="{{ asset('images/profile/akreditasi.webp') }}" alt="Terakreditasi A" class="w-56 md:w-64 h-auto object-contain drop-shadow-lg hover:rotate-3 transition-transform duration-300" loading="lazy" decoding="async" width="360" height="360">
                </div>

                <!-- Sisi Kanan: Teks Akreditasi & Tombol Lihat (Animasi Fade-Left) -->
                <div class="lg:col-span-7 space-y-4" data-aos="fade-left" data-aos-delay="200">
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">
                        Terakreditasi A
                    </h2>
                    
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Berdasarkan Keputusan Badan Akreditasi Nasional Sekolah/Madrasah Nomor: 1336/BAN-SM/SK/2021, menyatakan bahwa SMK Telkom Sidoarjo "Terakreditasi A (UNGGUL)." Dengan Nilai 93, Akreditasi SMK Telkom Sidoarjo berlaku sampai dengan 31 Desember 2026.
                    </p>

                    <div class="pt-2">
                        <a href="#" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-red-800 transition-all shadow-sm hover:shadow-md active:scale-95 cursor-pointer">
                            Lihat 
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

<!-- Section Struktur Organisasi (Animasi Fade-Up) -->
<section class="py-20 bg-gray-50" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Sisi Kiri: Teks Penjelasan -->
            <div class="lg:col-span-5 space-y-4" data-aos="fade-right">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 leading-tight">
                    Struktur Organisasi <br><span class="text-red-700">SMK Telkom Sidoarjo</span>
                </h2>
                
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    Diagram ini menyajikan Struktur Organisasi resmi SMK Telkom Sidoarjo, yang merinci pembagian tugas dan tanggung jawab unit kerja. Struktur ini berfungsi sebagai kerangka formal untuk memastikan koordinasi, efisiensi operasional, dan pencapaian target mutu sekolah (ISO 21001:2018).
                </p>
            </div>

            <!-- Sisi Kanan: Bagan / Diagram Struktur Organisasi (Animasi Zoom-In) -->
            <div class="lg:col-span-7 flex justify-center bg-white p-6 rounded-3xl border border-gray-100 shadow-sm" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('images/profile/struktur.webp') }}" alt="Bagan Struktur Organisasi" class="w-full h-auto object-contain cursor-pointer hover:opacity-95 transition-opacity" loading="lazy" decoding="async" width="469" height="466">
            </div>

        </div>

    </div>
</section>

@endsection