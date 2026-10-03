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

        @php
            $lowongans = [
                ['title' => 'Junior DevOps', 'company' => 'Pt. Garuda Telekomunikasi Ind...', 'location' => 'Surabaya, Indonesia', 'posted' => '1 Hari Yang Lalu', 'logo' => asset('images/mitra/gt.webp'), 'category' => 'Full Time'],
                ['title' => 'Junior DevOps', 'company' => 'Pt. Garuda Telekomunikasi Ind...', 'location' => 'Surabaya, Indonesia', 'posted' => '1 Hari Yang Lalu', 'logo' => asset('images/mitra/gt.webp'), 'category' => 'Full Time'],
                ['title' => 'Junior DevOps', 'company' => 'Pt. Garuda Telekomunikasi Ind...', 'location' => 'Surabaya, Indonesia', 'posted' => '1 Hari Yang Lalu', 'logo' => asset('images/mitra/gt.webp'), 'category' => 'Full Time'],
                ['title' => 'Junior DevOps', 'company' => 'Pt. Garuda Telekomunikasi Ind...', 'location' => 'Surabaya, Indonesia', 'posted' => '1 Hari Yang Lalu', 'logo' => asset('images/mitra/gt.webp'), 'category' => 'Full Time'],
                ['title' => 'Junior DevOps', 'company' => 'Pt. Garuda Telekomunikasi Ind...', 'location' => 'Surabaya, Indonesia', 'posted' => '1 Hari Yang Lalu', 'logo' => asset('images/mitra/gt.webp'), 'category' => 'Full Time'],
            ];
        @endphp

        <!-- Grid Otomatis 1 Kolom di HP, 2 di Tablet, 3 di Desktop -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            @foreach($lowongans as $job)
                <div class="bg-white rounded-3xl p-5 sm:p-6 border border-gray-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="mb-4">
                            <img src="{{ $job['logo'] }}" alt="Logo Mitra" class="h-9 sm:h-10 w-auto object-contain mb-3" onerror="this.src='{{ asset('images/footer/4. Garuda Spark Full Color 1.webp') }}';" loading="eager" decoding="async" fetchpriority="high">
                            <h3 class="text-base font-bold text-slate-900 leading-snug">{{ $job['title'] }}</h3>
                            <p class="text-xs text-gray-500 font-medium mt-1">{{ $job['company'] }}</p>
                        </div>
                        <div class="flex items-center gap-4 text-xs text-gray-500 my-4">
                            <span class="flex items-center gap-1.5"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400"></i> {{ $job['location'] }}</span>
                            <span class="flex items-center gap-1.5"><i data-lucide="clock" class="w-3.5 h-3.5 text-gray-400"></i> {{ $job['posted'] }}</span>
                        </div>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('career-center.sso') }}" style="background-color: #2563EB !important; color: #ffffff !important;" class="w-full block text-center py-2.5 px-4 hover:bg-blue-700 active:scale-98 font-bold text-xs sm:text-sm rounded-xl transition duration-200 shadow-md">HireLink!</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 3. AGENDA EVENT -->
    <section class="py-14 sm:py-16 bg-white border-y border-gray-100" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-6 sm:mb-8">Agenda Event Yang Akan Datang</h2>
            <div class="space-y-4 max-w-5xl">
                <div class="rounded-2xl border border-gray-200 p-4 sm:p-5 bg-white shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4 sm:gap-5">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl border border-gray-200 flex flex-col items-center justify-center bg-gray-50 shrink-0 text-center">
                            <span class="text-lg sm:text-xl font-black text-slate-900 leading-none">8</span>
                            <span class="text-[10px] sm:text-[11px] font-semibold text-gray-500 mt-0.5">September</span>
                        </div>
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900">Sidoarjo School &amp; Job Fair 2026</h3>
                            <p class="text-xs text-gray-500 flex items-center gap-1 mt-1"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400"></i> Lippo Mall Sidoarjo</p>
                        </div>
                    </div>
                    <a href="#" style="background-color: #2563EB !important; color: #ffffff !important;" class="w-full sm:w-auto text-center px-6 sm:px-8 py-2.5 rounded-xl text-xs font-bold shadow-md">Lihat Detail</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. BANNER HIRELINK MERAH (LEGA DI HP, SISWA TIDAK TERPOTONG) -->
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
                <a href="{{ route('career-center.sso') }}" class="px-7 sm:px-8 py-3 bg-white text-slate-900 font-bold text-xs sm:text-sm rounded-full shadow-lg hover:bg-gray-100 transition">Mulai Tes</a>
                <a href="#" class="px-7 sm:px-8 py-3 border border-white bg-red-900/40 text-white font-bold text-xs sm:text-sm rounded-full hover:bg-red-900 transition">Baca Panduan</a>
            </div>
        </div>
    </section>
</div>
@endsection