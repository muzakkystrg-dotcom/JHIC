@extends('layouts.app')

@section('title', isset($mitraDetail) ? 'Detail Mitra - ' . $mitraDetail['nama'] : 'Hubungan Industri - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#F8F9FA] min-h-screen text-slate-800 font-sans">

@if(isset($mitraDetail))
    {{-- =========================================================================
         TAMPILAN DETAIL MITRA INDUSTRI (DESAIN MASTER FIGMA: Desktop - 15.png)
         ========================================================================= --}}
    <div class="pt-36 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- 1. Tombol Kembali di Pojok Kiri Atas -->
            <div class="mb-8" data-aos="fade-right">
                <a href="{{ route('mitra-industri.index') }}" 
                   class="inline-flex items-center text-xs sm:text-sm font-semibold text-gray-600 hover:text-[#C8102E] transition gap-2">
                    <span class="text-base leading-none">&larr;</span>
                    <span>Mitra Industri - {{ Str::limit($mitraDetail['nama'], 22) }}</span>
                </a>
            </div>

            <!-- 2. Hero Section Profil Perusahaan (Dual Column) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center mb-10">
                
                <!-- Sisi Kiri: Informasi Perusahaan -->
                <div class="lg:col-span-8 space-y-6" data-aos="fade-right">
                    
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                        {{ $mitraDetail['nama'] }}
                    </h1>

                    <div class="flex items-start gap-2.5 text-xs sm:text-sm text-gray-600 max-w-2xl">
                        <i data-lucide="map-pin" class="w-4 h-4 text-gray-500 shrink-0 mt-0.5"></i>
                        <span class="leading-relaxed">{{ $mitraDetail['alamat'] }}</span>
                    </div>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-2xl font-normal text-justify">
                        {{ $mitraDetail['deskripsi'] }}
                    </p>

                    <!-- Tombol Website & Ikon Sosial Media Sesuai Figma -->
                    <div class="pt-2 flex flex-wrap items-center gap-4">
                        <a href="{{ $mitraDetail['website_url'] }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           style="background-color: #8B0000 !important; color: #ffffff !important;"
                           class="px-6 py-2.5 hover:bg-[#6b0000] text-xs sm:text-sm font-semibold rounded-xl inline-flex items-center gap-3 transition shadow-sm active:scale-95">
                            <span>{{ $mitraDetail['website_label'] }}</span>
                            <span class="text-base leading-none">&rarr;</span>
                        </a>

                        <a href="{{ $mitraDetail['instagram'] }}" 
                           target="_blank"
                           rel="noopener noreferrer"
                           style="background-color: #C8102E !important; color: #ffffff !important;"
                           class="w-10 h-10 rounded-xl flex items-center justify-center hover:opacity-90 transition active:scale-95 shadow-sm">
                            <i data-lucide="instagram" class="w-5 h-5 text-white"></i>
                        </a>

                        <a href="{{ $mitraDetail['linkedin'] }}" 
                           target="_blank"
                           rel="noopener noreferrer"
                           style="background-color: #C8102E !important; color: #ffffff !important;"
                           class="w-10 h-10 rounded-xl flex items-center justify-center hover:opacity-90 transition active:scale-95 shadow-sm">
                            <i data-lucide="linkedin" class="w-5 h-5 text-white"></i>
                        </a>
                    </div>

                </div>

                <!-- Sisi Kanan: Logo Besar Perusahaan -->
                <div class="lg:col-span-4 flex justify-center items-center p-6" data-aos="zoom-in">
                    <div class="w-full max-w-[320px] aspect-square flex items-center justify-center">
                        <img src="{{ $mitraDetail['logo'] }}" 
                             alt="{{ $mitraDetail['nama'] }}" 
                             class="max-h-72 w-auto object-contain drop-shadow-xl select-none"
                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}'nama']) }}';" loading="eager" decoding="async" fetchpriority="high">
                    </div>
                </div>

            </div>

            <!-- Garis Aksen Merah Pembatas 1 -->
            <div class="w-36 h-1 rounded-full mx-auto mt-12 mb-16" style="background-color: #C8102E !important;"></div>

            <!-- 3. Section Lowongan Kerja Terkini (Dengan Tombol HireLink) -->
            <section class="mb-20" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-center text-slate-900 mb-8 tracking-tight">
                    <span style="color: #C8102E !important;">Lowongan kerja</span> terkini
                </h2>

                <div class="bg-white/80 rounded-[2.5rem] p-6 sm:p-10 border border-gray-200/90 shadow-sm max-w-6xl mx-auto min-h-[280px] flex items-center justify-center">
                    @if(count($mitraDetail['jobs']) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
                            @foreach($mitraDetail['jobs'] as $job)
                                <div class="bg-white rounded-3xl p-5 border border-gray-200 shadow-sm hover:shadow-lg transition duration-200 flex flex-col justify-between max-w-sm">
                                    <div>
                                        <div class="mb-3">
                                            <img src="{{ $job['logo'] }}" alt="Logo" class="h-9 w-auto object-contain" onerror="this.src='{{ $mitraDetail['logo'] }}';" loading="eager" decoding="async" fetchpriority="high">
                                        </div>
                                        <h4 class="text-sm font-bold text-slate-900 leading-snug">{{ $job['title'] }}</h4>
                                        <p class="text-[11px] text-gray-500 font-medium mt-0.5">{{ $job['company'] }}</p>

                                        <div class="flex items-center gap-3 text-[11px] text-gray-400 my-4">
                                            <span class="flex items-center gap-1">
                                                <i data-lucide="map-pin" class="w-3 h-3 text-gray-400"></i>
                                                {{ $job['location'] }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <i data-lucide="clock" class="w-3 h-3 text-gray-400"></i>
                                                {{ $job['posted'] }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="pt-2">
                                        <!-- Tombol HireLink! Terkoneksi ke Alur SSO Form -->
                                        <a href="{{ route('career-center.sso') }}" 
                                           style="background-color: #2563EB !important; color: #ffffff !important;"
                                           class="w-full block text-center py-2.5 px-4 hover:bg-blue-700 active:scale-98 font-bold text-xs rounded-xl transition duration-200 shadow-sm">
                                            HireLink!
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 text-gray-400">
                            <i data-lucide="briefcase" class="w-10 h-10 mx-auto mb-2 text-gray-300"></i>
                            <p class="text-xs sm:text-sm font-medium">Saat ini belum ada lowongan kerja terbuka dari mitra ini.</p>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Garis Aksen Merah Pembatas 2 -->
            <div class="w-36 h-1 rounded-full mx-auto mb-16" style="background-color: #C8102E !important;"></div>

            <!-- 4. Section Dokumentasi Hasil PKL Siswa/i (3 Card SIJA TJAT) -->
            <section data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-center text-slate-900 mb-10 tracking-tight">
                    <span style="color: #C8102E !important;">Dokumentasi</span> hasil <span style="color: #C8102E !important;">PKL</span> Siswa/i
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto items-center">
                    <div class="rounded-3xl overflow-hidden shadow-md border border-gray-200 relative aspect-[4/3] bg-gray-100 group">
                        <img src="{{ asset('images/home/berita.webp') }}" alt="Dokumentasi PKL 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async" width="307" height="138">
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center gap-4">
                            <span class="text-3xl font-black text-white tracking-widest drop-shadow-lg">SIJA</span>
                            <span class="text-3xl font-black text-white/80 tracking-widest drop-shadow-lg">TJAT</span>
                        </div>
                    </div>

                    <div class="rounded-3xl overflow-hidden shadow-xl border-2 border-white relative aspect-[4/3] bg-gray-100 md:scale-105 z-10 group">
                        <img src="{{ asset('images/home/berita.webp') }}" alt="Dokumentasi PKL 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async" width="307" height="138">
                        <div class="absolute inset-0 bg-black/35 flex items-center justify-center gap-4">
                            <span class="text-4xl font-black text-white tracking-widest drop-shadow-xl">SIJA</span>
                            <span class="text-4xl font-black text-white/80 tracking-widest drop-shadow-xl">TJAT</span>
                        </div>
                    </div>

                    <div class="rounded-3xl overflow-hidden shadow-md border border-gray-200 relative aspect-[4/3] bg-gray-100 group">
                        <img src="{{ asset('images/home/berita.webp') }}" alt="Dokumentasi PKL 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async" width="307" height="138">
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center gap-4">
                            <span class="text-3xl font-black text-white tracking-widest drop-shadow-lg">SIJA</span>
                            <span class="text-3xl font-black text-white/80 tracking-widest drop-shadow-lg">TJAT</span>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

@else
    {{-- =========================================================================
         TAMPILAN KATALOG 13 MITRA INDUSTRI UTAMA
         ========================================================================= --}}
    <!-- 1. Hero Section Mitra Industri -->
    <section class="relative pt-40 pb-16 overflow-hidden bg-gradient-to-br from-[#EAEAEA] via-[#F4F4F4] to-white">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-gray-200/40 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <div class="lg:col-span-5 flex justify-center items-center" data-aos="zoom-in">
                    <div class="relative w-full max-w-[340px] sm:max-w-[400px]">
                        <img src="{{ asset('images/career/career1.webp') }}" 
                             alt="Siswa SMK Telkom Sidoarjo" 
                             class="w-full h-auto object-contain select-none drop-shadow-2xl"
                             onerror="this.onerror=null; this.src='{{ asset('images/home/program.webp') }}';" loading="lazy" decoding="async" width="204" height="206">
                    </div>
                </div>

                <div class="lg:col-span-7 space-y-5 text-center lg:text-left" data-aos="fade-left">
                    <div class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500">
                        <span>Tentang kami</span>
                        <span>&gt;</span>
                        <span class="text-gray-900 font-bold">Mitra industri</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-[1.1] tracking-tight">
                        <span style="color: #C8102E !important;">Mitra Industri</span> <br>
                        yang dipercaya oleh kami.
                    </h1>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-xl mx-auto lg:mx-0 font-normal">
                        Kami bekerja sama dengan berbagai perusahaan ternama untuk memastikan lulusan siap kerja dan terserap industri.
                    </p>

                    <div class="pt-2 flex justify-center lg:justify-start">
                        <a href="#katalog-mitra" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
                            Jelajahi
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Garis Pemisah Aksen Merah -->
    <div class="w-full flex justify-center py-6 bg-white">
        <div class="w-72 h-1.5 rounded-full" style="background-color: #C8102E !important;"></div>
    </div>

    <!-- 2. Katalog 13 Mitra Industri -->
    <section id="katalog-mitra" class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24" data-aos="fade-up">
        
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Temukan <span style="color: #C8102E !important;">13+ Mitra Industri</span> kami Disini
            </h2>
        </div>

        <!-- Search Bar -->
        <div class="max-w-xl mx-auto mb-12">
            <div class="relative w-full">
                <input type="text" id="searchMitraInput" placeholder="Cari nama mitra atau lokasi..." 
                    class="w-full pl-12 pr-4 py-3.5 rounded-full border border-gray-300 bg-white text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#C8102E] shadow-sm transition">
                <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-4.5 top-4"></i>
            </div>
        </div>

        <!-- Grid 13 Kartu Mitra -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="mitraGridContainer">
            @foreach($mitras as $m)
                <div class="mitra-card bg-white rounded-3xl p-6 border-2 border-dashed border-gray-300 hover:border-[#C8102E] hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="h-16 w-full flex items-center justify-start mb-4">
                            <img src="{{ $m['logo'] }}" alt="{{ $m['nama'] }}" 
                                 class="max-h-12 max-w-[150px] object-contain group-hover:scale-105 transition-transform duration-300"
                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}'nama']) }}';" loading="lazy" decoding="async">
                        </div>

                        <h3 class="text-base font-bold text-slate-900 mb-2 group-hover:text-[#C8102E] transition-colors">
                            {{ $m['nama'] }}
                        </h3>
                        <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 mb-4">
                            {{ $m['alamat'] }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-[11px] font-semibold text-gray-400">Mitra Resmi</span>
                        <!-- Tombol Selengkapnya -> Me-redirect ke view detail dinamis -->
                        <a href="{{ route('mitra-industri.show', ['slug' => $m['slug']]) }}" 
                           style="background-color: #8B0000 !important; color: #ffffff !important;"
                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold hover:bg-[#6b0000] active:scale-95 transition shadow-sm">
                            <span>Selengkapnya</span>
                            <span class="text-xs">➔</span>
                        </a>
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
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchMitraInput');
        const cards = document.querySelectorAll('.mitra-card');

        if (searchInput && cards.length > 0) {
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.toLowerCase();
                cards.forEach(card => {
                    const text = card.textContent.toLowerCase();
                    if (text.includes(query)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endpush