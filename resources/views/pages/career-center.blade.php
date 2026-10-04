@extends('layouts.app')

@section('title', 'Career Center - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#F8F9FA] min-h-screen text-slate-800">

    <!-- 1. HERO SECTION (ADAPTIF HP HINGGA DESKTOP) -->
    <section class="relative pt-24 sm:pt-32 lg:pt-44 pb-14 sm:pb-20 overflow-hidden bg-gradient-to-br from-[#EAEAEA] via-[#F4F4F4] to-white">
        <div class="absolute top-0 right-0 w-full lg:w-1/2 h-full bg-gradient-to-l from-gray-200/40 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Headline & Deskripsi -->
                <div class="lg:col-span-7 space-y-4 sm:space-y-6 text-center lg:text-left" data-aos="fade-right">
                    <div class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500">
                        <span>Program</span>
                        <span>&gt;</span>
                        <span class="text-gray-800 font-bold">Career Center</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-[1.15] tracking-tight">
                        Mulai Karir mu dari <br>
                        <span style="color: #C8102E !important;">SMK TELKOM SIDOARJO</span>
                    </h1>

                    <p class="text-xs sm:text-base text-gray-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Kami menghubungkan talenta muda terbaik dengan industri teknologi terkemuka. Temukan peluang magang, pekerjaan, dan pengembangan karier di sini.
                    </p>

                    <div class="pt-2 flex justify-center lg:justify-start">
                        <a href="#peluang-karir" 
                           style="background-color: #C8102E !important; color: #ffffff !important;"
                           class="inline-flex items-center gap-3 px-7 sm:px-8 py-3 sm:py-3.5 hover:opacity-90 font-bold text-xs sm:text-sm rounded-full shadow-lg transition active:scale-95 cursor-pointer">
                            <span>Temukan Peluang</span>
                            <span class="text-base leading-none">→</span>
                        </a>
                    </div>
                </div>

                <!-- Foto Siswi Hero (career.png) -->
                <div class="lg:col-span-5 flex justify-center items-center" data-aos="zoom-in">
                    <div class="relative w-full max-w-[320px] sm:max-w-[420px]">
                        <img src="{{ asset('images/career/career.webp') }}" 
                             alt="Siswi SMK Telkom Sidoarjo" 
                             class="w-full h-auto object-contain max-h-[380px] sm:max-h-[460px] drop-shadow-2xl select-none" loading="eager" decoding="async" fetchpriority="high" width="433" height="433">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 2. SECTION PELUANG KARIER TERBARU -->
    <section id="peluang-karir" class="py-14 sm:py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-20 sm:scroll-mt-24" data-aos="fade-up">
        <div class="mb-8 sm:mb-10 text-center sm:text-left">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Peluang Karier Terbaru</h2>
            <p class="text-xs sm:text-sm text-gray-600 mt-2 max-w-3xl leading-relaxed">
                Jelajahi berbagai posisi menarik yang tersedia dari Mitra Industri <span style="color: #C8102E;" class="font-bold">SMK TELKOM SIDOARJO</span> untuk alumni. Berbagai macam jenis dari Fulltime Hingga PKL.
            </p>
        </div>

        <!-- Grid Otomatis 1 Kolom di HP, 2 di Tablet, 3 di Desktop -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            @forelse($lowongans as $job)
                <div class="bg-white rounded-3xl p-5 sm:p-6 border border-gray-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="mb-4">
                            {{-- Box tinggi tetap: semua logo sejajar walau rasio aslinya beda --}}
                            <div class="h-11 sm:h-12 flex items-center mb-3">
                                <img src="{{ $job->logo ? asset($job->logo) : asset('images/footer/4. Garuda Spark Full Color 1.webp') }}" alt="Logo Mitra" class="mitra-logo" onerror="this.src='{{ asset('images/footer/4. Garuda Spark Full Color 1.webp') }}';" loading="eager" decoding="async" fetchpriority="high">
                            </div>
                            {{-- min-h 2 baris: judul 1 baris & 2 baris tetap bikin card rata --}}
                            <h3 class="text-base font-bold text-slate-900 leading-snug min-h-[2.75rem] line-clamp-2">{{ $job->title }}</h3>
                            <p class="text-xs text-gray-500 font-medium mt-1 line-clamp-1">{{ $job->company }}</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500 my-4">
                            <span class="flex items-center gap-1.5"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400"></i> {{ $job->location }}</span>
                            <span class="flex items-center gap-1.5"><i data-lucide="clock" class="w-3.5 h-3.5 text-gray-400"></i> {{ optional($job->posted_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="pt-2">
                        {{-- Tombol diarahkan ke LinkedIn mitra (placeholder). Klik
                             tidak langsung pindah: JS menampilkan notif di tengah
                             karena LinkedIn mitra belum tersedia. --}}
                        <a href="https://www.linkedin.com/company/{{ \Illuminate\Support\Str::slug($job->company) }}"
                           data-linkedin-url="https://www.linkedin.com/company/{{ \Illuminate\Support\Str::slug($job->company) }}"
                           rel="noopener noreferrer"
                           style="background-color: #C8102E !important; color: #ffffff !important;"
                           class="js-job-detail w-full block text-center py-2.5 px-4 hover:bg-[#8B0000] active:scale-98 font-bold text-xs sm:text-sm rounded-xl transition duration-200 shadow-md">Lihat Detail</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 text-gray-500 italic">
                    Belum ada lowongan tersedia saat ini.
                </div>
            @endforelse
        </div>
    </section>

    <!-- 3. BANNER HIRELINK MERAH (LEGA DI HP, SISWA TIDAK TERPOTONG) -->
    <section class="relative py-20 sm:py-28 lg:py-36 px-4 sm:px-6 lg:px-8 text-white overflow-hidden flex items-center justify-center min-h-[420px] sm:min-h-[500px]" style="background-color: #C8102E !important;">
        <div class="absolute left-0 bottom-0 hidden lg:flex items-end h-[90%] pointer-events-none z-10">
            <img src="{{ asset('images/career/career.webp') }}" alt="Siswi" class="h-full w-auto max-h-[420px] object-contain object-bottom opacity-95" loading="lazy" decoding="async" width="433" height="433">
        </div>
        <div class="absolute right-0 bottom-0 hidden lg:flex items-end h-[90%] pointer-events-none z-10">
            <img src="{{ asset('images/career/career1.webp') }}" alt="Siswa" class="h-full w-auto max-h-[420px] object-contain object-bottom opacity-95" onerror="this.src='{{ asset('images/home/program.webp') }}';" loading="lazy" decoding="async" width="204" height="206">
        </div>
        <div class="max-w-2xl mx-auto text-center relative z-20 space-y-4 sm:space-y-6">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight">Hirelink!</h2>
            <p class="text-xs sm:text-sm text-white/95 leading-relaxed max-w-xl mx-auto">Fitur untuk para alumni Skomda mencari kesempatan bekerja dengan mitra sekolah kami.</p>
            <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 pt-2">
                <a href="{{ route('career-center.sso') }}" class="px-7 sm:px-8 py-3 bg-white text-slate-900 font-bold text-xs sm:text-sm rounded-full shadow-lg hover:bg-gray-100 transition">Lamar Sekarang</a>
                <!-- Entry point Portal Mitra Industri (Industry Dashboard) -->
                <a href="{{ route('industry.login') }}" class="px-7 sm:px-8 py-3 bg-transparent text-white font-bold text-xs sm:text-sm rounded-full border-2 border-white shadow-lg hover:bg-white hover:text-[#C8102E] transition">Industry Dashboard</a>
            </div>
        </div>
    </section>
</div>

{{-- ==================== NOTIF: DIRECT KE LINKEDIN ==================== --}}
<div id="linkedinNotice" class="fixed inset-0 z-[9999] bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="linkedinNoticeTitle">
    <div class="relative bg-white rounded-3xl w-full max-w-md p-6 sm:p-8 text-center shadow-2xl">

        {{-- Tombol X (close) di pojok kanan atas --}}
        <button type="button" id="linkedinNoticeClose" aria-label="Tutup notifikasi"
                class="absolute top-3.5 right-3.5 w-9 h-9 flex items-center justify-center rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition focus:outline-none focus:ring-2 focus:ring-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        {{-- Ikon LinkedIn --}}
        <div class="mx-auto mb-5 w-16 h-16 rounded-2xl flex items-center justify-center" style="background-color: #0A66C2 !important;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffffff" class="w-8 h-8" aria-hidden="true">
                <path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.35V9h3.42v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.06 2.06 0 1 1 0-4.13 2.06 2.06 0 0 1 0 4.13zM7.12 20.45H3.56V9h3.56v11.45zM22.22 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.73V1.73C24 .77 23.2 0 22.22 0z"/>
            </svg>
        </div>

        <h3 id="linkedinNoticeTitle" class="text-lg sm:text-xl font-extrabold text-slate-900">Direct ke LinkedIn</h3>
        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
            Kamu akan diarahkan ke halaman LinkedIn mitra.
        </p>
        <p class="mt-3 inline-block text-xs sm:text-sm font-semibold text-[#C8102E] bg-red-50 border border-red-100 rounded-xl px-4 py-2.5">
            LinkedIn saat ini masih tidak tersedia
        </p>

        <button type="button" id="linkedinNoticeOk"
                class="mt-6 w-full py-3 rounded-xl font-bold text-sm text-white shadow-md hover:opacity-90 active:scale-[0.98] transition"
                style="background-color: #C8102E !important; color: #ffffff !important;">
            Mengerti
        </button>
    </div>
</div>

<script>
    (function () {
        'use strict';

        function initLinkedinNotice() {
            var notice = document.getElementById('linkedinNotice');
            var closeBtn = document.getElementById('linkedinNoticeClose');
            var okBtn = document.getElementById('linkedinNoticeOk');
            var triggers = document.querySelectorAll('.js-job-detail');

            if (!notice || !triggers.length) return;

            function openNotice() {
                notice.classList.remove('hidden');
                notice.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            function closeNotice() {
                notice.classList.add('hidden');
                notice.classList.remove('flex');
                document.body.style.overflow = '';
            }

            triggers.forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    // LinkedIn mitra belum tersedia -> tahan navigasi, tampilkan notif.
                    e.preventDefault();
                    openNotice();
                });
            });

            closeBtn && closeBtn.addEventListener('click', closeNotice);
            okBtn && okBtn.addEventListener('click', closeNotice);

            // Klik area gelap di luar kartu = tutup
            notice.addEventListener('click', function (e) {
                if (e.target === notice) closeNotice();
            });

            // Tekan Escape = tutup
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !notice.classList.contains('hidden')) closeNotice();
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initLinkedinNotice);
        } else {
            initLinkedinNotice();
        }
    })();
</script>
@endsection