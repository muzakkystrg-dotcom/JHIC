@extends('layouts.app')

@section('title', isset($dtpDetail) ? 'DTP ' . $dtpDetail['name'] . ' - SMK Telkom Sidoarjo' : 'Digital Talent Program - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#F8F9FA] min-h-screen text-slate-800 font-sans">

@if(isset($dtpDetail))
    {{-- =========================================================================
         BAGIAN 1: DETAIL PEMINATAN DTP (DESAIN MASTER FIGMA: Desktop - 41.png)
         ========================================================================= --}}
    <div class="pt-36 sm:pt-40 pb-24">
        
        <!-- ==================== HERO SECTION DETAIL DTP ==================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Sisi Kiri: Headline & Tombol CTA Jelajahi -->
                <div class="lg:col-span-6 space-y-6 text-center lg:text-left" data-aos="fade-right">
                    <p class="text-xs sm:text-sm text-gray-500 font-semibold">
                        <a href="{{ route('digital-talent.index') }}" class="hover:text-red-700 transition">Program</a>
                        &gt;
                        <a href="{{ route('digital-talent.index') }}" class="hover:text-red-700 transition">Digital Talent Program</a>
                    </p>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                        DTP {{ $dtpDetail['name'] }}
                    </h1>

                    <div class="pt-2 flex justify-center lg:justify-start">
                        <a href="#dokumentasi-dtp" 
                           style="background-color: #C8102E !important; color: #ffffff !important;"
                           class="inline-flex items-center gap-2.5 px-8 py-3 hover:opacity-90 font-bold text-xs sm:text-sm rounded-xl shadow-md transition-all duration-200 active:scale-95 cursor-pointer">
                            <span>Jelajahi</span>
                            <span class="text-base leading-none">➔</span>
                        </a>
                    </div>
                </div>

                <!-- Sisi Kanan: Visual 3D Laptop Mockup Layar Dokumen Sesuai Figma -->
                <div class="lg:col-span-6 flex justify-center items-center" data-aos="zoom-in">
                    <div class="relative w-full max-w-[340px] sm:max-w-[420px] aspect-square flex items-center justify-center">
                        <!-- Aksen Belah Ketupat Merah Miring di Belakang Laptop -->
                        <div class="absolute w-64 h-64 sm:w-80 sm:h-80 rounded-3xl transform rotate-45 shadow-xl pointer-events-none" style="background-color: #C8102E !important;"></div>
                        <!-- Garis Putus-putus Offset Pemanis -->
                        <div class="absolute w-64 h-64 sm:w-80 sm:h-80 border-2 border-dashed border-gray-400 rounded-3xl transform rotate-45 translate-x-3 translate-y-3 pointer-events-none"></div>

                        <!-- 3D Laptop Mockup -->
                        <div class="relative z-10 w-full p-4 flex items-center justify-center">
                            <img src="{{ asset('images/home/program.webp') }}" 
                                 alt="DTP Laptop Mockup" 
                                 class="w-full h-auto object-contain select-none drop-shadow-2xl"
                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}';" loading="eager" decoding="async" fetchpriority="high">
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Garis Pemisah Aksen Merah Horizontal -->
        <div class="w-full flex justify-center my-14">
            <div class="w-72 h-1.5 rounded-full" style="background-color: #C8102E !important;"></div>
        </div>

        <!-- ==================== SECTION DOKUMENTASI DTP [NAMA PEMINATAN] ==================== -->
        <section id="dokumentasi-dtp" class="py-12 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-center tracking-tight mb-12">
                <span style="color: #C8102E !important;">Dokumentasi</span> 
                <span class="text-slate-900">DTP {{ $dtpDetail['name'] }}</span>
            </h2>

            <!-- Grid 3 Kolom Box Display (Kartu Tengah Lebih Luas/Tinggi Sesuai Figma) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center max-w-5xl mx-auto mb-20">
                <div class="bg-gray-300 w-full h-44 rounded-3xl shadow-sm flex items-center justify-center text-gray-400">
                    <i data-lucide="image" class="w-8 h-8 opacity-40"></i>
                </div>
                <div class="bg-gray-300 w-full h-60 rounded-3xl shadow-md md:scale-105 z-10 flex items-center justify-center text-gray-400 border-2 border-white">
                    <i data-lucide="image" class="w-10 h-10 opacity-40"></i>
                </div>
                <div class="bg-gray-300 w-full h-44 rounded-3xl shadow-sm flex items-center justify-center text-gray-400">
                    <i data-lucide="image" class="w-8 h-8 opacity-40"></i>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION HASIL KARYA SISWA ==================== -->
        <section class="py-12 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-16" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-center text-slate-900 tracking-tight mb-12">
                Hasil Karya Siswa
            </h2>

            <!-- Grid 3 Kolom Box Portofolio Karya -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center max-w-5xl mx-auto">
                <div class="bg-gray-300 w-full h-44 rounded-3xl shadow-sm flex items-center justify-center text-gray-400">
                    <i data-lucide="folder-git-2" class="w-8 h-8 opacity-40"></i>
                </div>
                <div class="bg-gray-300 w-full h-60 rounded-3xl shadow-md md:scale-105 z-10 flex items-center justify-center text-gray-400 border-2 border-white">
                    <i data-lucide="folder-git-2" class="w-10 h-10 opacity-40"></i>
                </div>
                <div class="bg-gray-300 w-full h-44 rounded-3xl shadow-sm flex items-center justify-center text-gray-400">
                    <i data-lucide="folder-git-2" class="w-8 h-8 opacity-40"></i>
                </div>
            </div>
        </section>

    </div>

@else
    {{-- =========================================================================
         BAGIAN 2: KATALOG DTP & 9 TAB FILTER (DESAIN MASTER FIGMA: Desktop - 29.png)
         ========================================================================= --}}

    <!-- ==================== 1. HERO SECTION KATALOG DTP ==================== -->
    <section class="relative pt-40 pb-16 overflow-hidden bg-gradient-to-br from-[#EAEAEA] via-[#F4F4F4] to-white">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-gray-200/40 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Sisi Kiri: Foto Siswi Berhijab Tablet iPad di Bingkai Belah Ketupat Merah -->
                <div class="lg:col-span-5 flex justify-center items-center" data-aos="zoom-in">
                    <div class="relative w-full max-w-[340px] sm:max-w-[400px]">
                        <img src="{{ asset('images/career/career.webp') }}" 
                             alt="Siswi Digital Talent Program" 
                             class="w-full h-auto object-contain select-none drop-shadow-2xl"
                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}';" loading="eager" decoding="async" fetchpriority="high" width="433" height="433">
                    </div>
                </div>

                <!-- Sisi Kanan: Headline & Deskripsi DTP -->
                <div class="lg:col-span-7 space-y-5 text-center lg:text-left" data-aos="fade-left">
                    <div class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500">
                        <span>Program</span>
                        <span>&gt;</span>
                        <span class="text-gray-900 font-bold">Digital Talent Program</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-[1.1] tracking-tight">
                        Digital Talent Program
                    </h1>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-xl mx-auto lg:mx-0 font-normal">
                        Digital Talent Program adalah kelas peminatan eksklusif di SMK Telkom Sidoarjo yang dirancang dengan 9 bidang spesialisasi teknologi mutakhir untuk mencetak talenta digital berstandar industri masa depan.
                    </p>

                    <div class="pt-2 flex justify-center lg:justify-start">
                        <a href="#section-dtp-tabs" 
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

    <!-- ==================== 2. SECTION: WUJUDKAN MIMPI DI ERA DIGITAL! (5 KARTU MERAH) ==================== -->
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-8 tracking-tight">
            Wujudkan Mimpi di <span style="color: #C8102E !important;">Era Digital!</span>
        </h2>

        <!-- Grid 5 Kartu Merah Telkom Berikon Koper Sesuai Figma -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-14">
            @for($i = 1; $i <= 5; $i++)
                <div class="rounded-2xl p-4 text-white shadow-md flex items-center gap-3.5 transition-all duration-200 hover:-translate-y-1" style="background-color: #C8102E !important;">
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shrink-0" style="color: #C8102E !important;">
                        <i data-lucide="briefcase" class="w-4 h-4"></i>
                    </div>
                    <p class="text-[11px] leading-tight font-medium text-white/95">
                        Belajar langsung dari praktisi profesional yang aktif di dunia kerja.
                    </p>
                </div>
            @endfor
        </div>

        <!-- Garis Pemisah Aksen Merah -->
        <div class="w-full flex justify-center mb-16">
            <div class="w-72 h-1.5 rounded-full" style="background-color: #C8102E !important;"></div>
        </div>

        <!-- ==================== 3. SECTION: JELAJAHI PROGRAM TALENT DI SKOMDA (9 TAB) ==================== -->
        <div id="section-dtp-tabs" class="scroll-mt-24">
            
            <h2 class="text-2xl sm:text-3xl font-extrabold text-center text-slate-900 mb-8 tracking-tight">
                Jelajahi Program Talent Di Skomda
            </h2>

            <!-- Baris 9 Tombol Tab Peminatan DTP -->
            <div class="flex flex-wrap items-center justify-center gap-3 max-w-5xl mx-auto mb-16">
                @foreach($dtpList as $slugKey => $dtp)
                    <button type="button"
                            onclick="switchDtpTab('{{ $slugKey }}')"
                            id="tab-btn-{{ $slugKey }}"
                            class="dtp-tab-button px-5 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition duration-200 shadow-sm cursor-pointer border {{ $loop->first ? 'active-tab' : 'bg-white text-gray-700 border-gray-200 hover:border-[#C8102E] hover:text-[#C8102E]' }}"
                            style="{{ $loop->first ? 'background-color: #C8102E !important; color: #ffffff !important; border-color: #C8102E !important;' : '' }}">
                        <span>{{ $dtp['icon'] }}</span>
                        <span>{{ $dtp['name'] }}</span>
                    </button>
                @endforeach
            </div>

            <!-- Featured Talent Display Card (Preview Dinamis Berdasarkan Tab Terpilih) -->
            <div class="relative grid grid-cols-1 lg:grid-cols-12 gap-10 items-center max-w-5xl mx-auto mb-20 bg-white/60 p-6 sm:p-10 rounded-3xl border border-gray-200 shadow-sm">
                
                <!-- Aksen Garis Merah Melintang di Luar Sesuai Figma -->
                <div class="absolute -left-6 top-1/2 -translate-y-1/2 w-12 h-24 border-l-2 border-red-600 hidden md:block pointer-events-none"></div>
                <div class="absolute -right-6 top-1/2 -translate-y-1/2 w-12 h-24 border-r-2 border-red-600 hidden md:block pointer-events-none"></div>

                <!-- Sisi Kiri: Visual 3D Laptop Mockup Berlatar Belah Ketupat Merah -->
                <div class="lg:col-span-5 flex justify-center items-center">
                    <div class="relative w-full max-w-[280px] sm:max-w-[320px] aspect-square flex items-center justify-center">
                        <div class="absolute w-52 h-52 sm:w-60 sm:h-60 rounded-3xl transform rotate-45 shadow-lg pointer-events-none" style="background-color: #C8102E !important;"></div>
                        <img src="{{ asset('images/home/program.webp') }}" 
                             alt="Laptop Preview" 
                             class="relative z-10 w-full h-auto object-contain select-none drop-shadow-xl"
                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder.webp') }}';" loading="lazy" decoding="async">
                    </div>
                </div>

                <!-- Sisi Kanan: Konten Informasi Peminatan Terpilih -->
                <div class="lg:col-span-7 space-y-4 text-left">
                    <p class="text-sm font-bold text-slate-900 tracking-tight">Digital Talent Program</p>
                    
                    <h3 id="previewTitle" class="text-2xl sm:text-3xl font-black tracking-tight" style="color: #C8102E !important;">
                        {{ $activeDtp['name'] }}
                    </h3>

                    <p id="previewDesc" class="text-xs sm:text-sm text-gray-600 leading-relaxed font-normal text-justify">
                        {{ $activeDtp['desc'] }}
                    </p>

                    <p class="text-xs text-gray-800 font-bold pt-1">
                        Prospek Kerja: 
                        <span id="previewProspects" class="underline decoration-gray-400 font-semibold text-gray-700">
                            {{ $activeDtp['prospects'] }}
                        </span>
                    </p>

                    <!-- Tombol Aksi: Lihat Detail & Belajar Mandiri -->
                    <div class="pt-4 flex flex-wrap items-center gap-3">
                        <!-- Tombol 1: LIHAT DETAIL (MENGARAHKAN KE HALAMAN DETAIL PEMINATAN) -->
                        <a href="{{ route('digital-talent.show', ['slug' => $activeDtp['slug']]) }}" 
                           id="previewDetailBtn"
                           class="px-6 py-2.5 border-2 rounded-xl text-xs font-bold transition active:scale-95 shadow-sm"
                           style="border-color: #C8102E !important; color: #C8102E !important;">
                            Lihat Detail
                        </a>

                        <!-- Tombol 2: Belajar Mandiri -->
                        <a href="{{ $activeDtp['learn_link'] }}" 
                           target="_blank"
                           rel="noopener noreferrer"
                           id="previewLearnBtn"
                           style="background-color: #C8102E !important; color: #ffffff !important;"
                           class="px-6 py-2.5 rounded-xl text-xs font-bold hover:opacity-90 transition active:scale-95 shadow-sm inline-flex items-center gap-2">
                            <span>Belajar Mandiri</span>
                            <span class="text-xs leading-none">➔</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </section>

@endif

</div>
@endsection

@push('scripts')
<script>
    // Dataset 9 Peminatan DTP untuk Instant Client-Side Tab Switching
    const dtpData = @json($dtpList ?? []);

    function switchDtpTab(slugKey) {
        const item = dtpData[slugKey];
        if (!item) return;

        // 1. Reset tampilan semua tombol tab
        document.querySelectorAll('.dtp-tab-button').forEach(btn => {
            btn.classList.remove('active-tab');
            btn.style.backgroundColor = '#ffffff';
            btn.style.color = '#374151';
            btn.style.borderColor = '#E5E7EB';
        });

        // 2. Aktifkan tombol tab yang dipilih (Merah Telkom Solid)
        const activeBtn = document.getElementById('tab-btn-' + slugKey);
        if (activeBtn) {
            activeBtn.classList.add('active-tab');
            activeBtn.style.setProperty('background-color', '#C8102E', 'important');
            activeBtn.style.setProperty('color', '#ffffff', 'important');
            activeBtn.style.setProperty('border-color', '#C8102E', 'important');
        }

        // 3. Perbarui teks preview di kartu informasi
        const titleEl = document.getElementById('previewTitle');
        const descEl = document.getElementById('previewDesc');
        const prospectsEl = document.getElementById('previewProspects');
        const detailBtn = document.getElementById('previewDetailBtn');
        const learnBtn = document.getElementById('previewLearnBtn');

        if (titleEl) titleEl.textContent = item.name;
        if (descEl) descEl.textContent = item.desc;
        if (prospectsEl) prospectsEl.textContent = item.prospects;
        
        // 4. Update URL direct route pada tombol "Lihat Detail"
        if (detailBtn) {
            detailBtn.href = "{{ url('/program/digital-talent-program') }}/" + item.slug;
        }

        // 5. Update tautan Belajar Mandiri
        if (learnBtn) {
            learnBtn.href = item.learn_link;
        }
    }
</script>
@endpush