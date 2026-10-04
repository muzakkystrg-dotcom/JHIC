<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Industry Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    // Data mitra yang sedang login (guard: industry).
    $authIndustry = auth('industry')->user();
    $companyName = $authIndustry->company_name ?? 'Mitra Industri';
    $companyLogo = $authIndustry->logo ? asset($authIndustry->logo) : asset('images/mitra/gt.webp');

    // Inisial nama perusahaan (maks 2 huruf) untuk avatar widget bawah.
    $initials = collect(preg_split('/\s+/', trim($companyName)))
        ->filter()
        ->take(2)
        ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))
        ->implode('') ?: 'MI';

    // Item navigasi sidebar. `match` dipakai untuk menandai menu aktif.
    $navItems = [
        [
            'label' => 'Dashboard',
            'route' => 'industry.dashboard',
            'match' => 'industry.dashboard',
            'icon'  => 'M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z',
            'fill'  => true,
        ],
        [
            'label' => 'Pekerjaan',
            'route' => 'industry.jobs.index',
            'match' => 'industry.jobs.*',
            'icon'  => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
            'fill'  => false,
        ],
        [
            'label' => 'Data Pelamar',
            'route' => 'industry.applicants.index',
            'match' => 'industry.applicants.*',
            'icon'  => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-6.9 4 4 0 004 6.9zm6-4a3 3 0 10-2.83-4M3 8a3 3 0 102.83-4',
            'fill'  => false,
        ],
        [
            'label' => 'Company Profile',
            'route' => 'industry.profile.index',
            'match' => 'industry.profile.*',
            'icon'  => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
            'fill'  => false,
        ],
    ];
@endphp
<body class="bg-[#ECEEF2] text-slate-900 font-sans antialiased min-h-screen overflow-x-hidden selection:bg-red-700 selection:text-white">

<div class="min-h-screen w-full flex flex-row">

    <!-- ==================== SIDEBAR KIRI ==================== -->
    <aside class="w-72 bg-white border-r border-gray-200 flex flex-col justify-between shrink-0 min-h-screen sticky top-0 h-screen z-30">

        <div class="flex flex-col min-h-0">
            <!-- Header Logo + Nama Mitra (dinamis sesuai akun yang login) -->
            <div class="px-6 py-6 border-b border-gray-100 flex flex-col items-center gap-3">
                <img src="{{ $companyLogo }}"
                     alt="{{ $companyName }}"
                     class="max-h-14 w-auto object-contain select-none"
                     onerror="this.onerror=null; this.src='{{ asset('images/home/favicon.webp') }}';">
                <p class="text-[11px] font-bold text-gray-500 text-center leading-snug tracking-tight">
                    {{ $companyName }}
                </p>
            </div>

            <!-- Navigasi Menu Vertikal -->
            <nav class="flex flex-col w-full py-2">
                @foreach($navItems as $item)
                    @php $isActive = request()->routeIs($item['match']); @endphp
                    <a href="{{ route($item['route']) }}"
                       @if($isActive) aria-current="page" @endif
                       class="relative px-6 py-4 flex items-center gap-3.5 text-sm tracking-tight transition-colors duration-150
                              {{ $isActive
                                    ? 'font-bold text-white'
                                    : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
                       @if($isActive) style="background-color: #C8102E;" @endif>
                        @if($isActive)
                            <span class="absolute left-0 top-0 h-full w-1.5 bg-white/40"></span>
                        @endif
                        <svg class="w-5 h-5 shrink-0 {{ $isActive ? 'text-white' : 'text-gray-500' }}"
                             @if($item['fill']) fill="currentColor" @else fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" @endif
                             viewBox="0 0 24 24">
                            <path d="{{ $item['icon'] }}"/>
                        </svg>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>

        <!-- Widget Akun Mitra Bawah -->
        <div class="p-6 border-t border-gray-200 bg-white flex items-center justify-between mt-auto gap-3">
            <div class="flex items-center gap-3.5 min-w-0">
                <div class="w-11 h-11 rounded-full bg-[#C8102E]/10 text-[#C8102E] flex-shrink-0 flex items-center justify-center font-bold text-xs">
                    {{ $initials }}
                </div>
                <div class="leading-tight min-w-0">
                    <h4 class="font-bold text-gray-900 text-xs sm:text-sm truncate">{{ $companyName }}</h4>
                    <p class="text-[11px] text-gray-400 font-medium mt-0.5 truncate">
                        {{ $authIndustry->industry_id ?? 'Mitra Industri' }}
                    </p>
                </div>
            </div>

            <form action="{{ route('industry.logout') }}" method="POST" class="shrink-0">
                @csrf
                <button type="submit" title="Logout"
                        class="p-1.5 rounded-lg text-gray-400 hover:text-red-700 hover:bg-gray-50 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>

    </aside>

    <!-- ==================== KONTEN UTAMA KANAN ==================== -->
    <main class="flex-1 min-h-screen bg-[#ECEEF2] p-8 sm:p-12 lg:p-14 overflow-y-auto">
        @yield('content')
    </main>

</div>

</body>
</html>
