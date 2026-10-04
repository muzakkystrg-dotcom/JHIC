@extends('layouts.industry')

@section('title', 'Dashboard - ' . ($industry->company_name ?? 'Industry Dashboard'))

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    <!-- ==================== WELCOME ==================== -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-snug">
            Selamat Datang,
            <span class="text-[#C8102E]">{{ $industry->company_name ?? 'Mitra Industri' }}</span>
        </h1>
        <p class="text-xs sm:text-sm text-gray-500 mt-1.5">
            Kelola lowongan dan kandidat alumni untuk perusahaan Anda di sini.
        </p>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-2xl bg-green-50 border border-green-200 text-xs font-bold text-green-700">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- ==================== 3 KARTU METRIK ==================== -->
    @php
        $cards = [
            [
                'label' => 'Kandidat Baru',
                'value' => $metrics['kandidat_baru'],
                'hint'  => 'Belum ditindak',
                'icon'  => 'M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z',
            ],
            [
                'label' => 'Diterima Minggu Ini',
                'value' => $metrics['diterima_minggu_ini'],
                'hint'  => 'Status: accepted',
                'icon'  => 'M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z',
            ],
            [
                'label' => 'Total Kandidat',
                'value' => $metrics['total_kandidat'],
                'hint'  => 'Semua status',
                'icon'  => 'M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z',
            ],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        @foreach($cards as $card)
            <div class="bg-white rounded-3xl border border-gray-200 shadow-xs p-6 flex flex-col justify-between min-h-[150px]">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-[#C8102E]/10 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-[#C8102E]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="{{ $card['icon'] }}"/>
                        </svg>
                    </div>
                    <div class="leading-tight">
                        <span class="block text-sm font-bold text-slate-900">{{ $card['label'] }}</span>
                        <span class="block text-[11px] text-gray-400 font-medium mt-0.5">{{ $card['hint'] }}</span>
                    </div>
                </div>
                <span class="block text-5xl font-black text-slate-900 leading-none tracking-tight mt-4">
                    {{ $card['value'] }}
                </span>
            </div>
        @endforeach
    </div>

    <!-- ==================== LOWONGAN AKTIF ==================== -->
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-extrabold text-slate-900 tracking-tight">Lowongan Aktif</h2>
            <a href="{{ route('industry.jobs.index') }}" class="text-xs font-bold text-[#C8102E] hover:underline">Kelola Lowongan &rarr;</a>
        </div>

        @forelse($activeJobs as $job)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-xs p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl border border-gray-200 bg-white flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-snug">{{ $job->title }}</h3>
                        <p class="text-xs text-gray-400 font-medium mt-0.5">
                            {{ $job->created_at?->diffForHumans() ?? '-' }} &bull; {{ $job->location }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-6 sm:gap-8">
                    <div class="text-center">
                        <span class="block text-xs text-gray-400 font-medium">Kandidat</span>
                        <span class="block text-base font-extrabold text-slate-900 mt-0.5">{{ $job->applicants_count }}</span>
                    </div>
                    <span class="inline-block px-3.5 py-1 rounded-md bg-[#99E5A8] text-gray-800 text-xs font-semibold">Buka</span>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-8 text-center text-sm text-gray-500 italic">
                Belum ada lowongan aktif. Buat lewat menu <span class="font-semibold not-italic">Pekerjaan</span>.
            </div>
        @endforelse
    </div>

    <!-- ==================== LOWONGAN DITUTUP ==================== -->
    <div class="space-y-3">
        <h2 class="text-lg font-extrabold text-slate-900 tracking-tight">Lowongan Ditutup</h2>

        @forelse($inactiveJobs as $job)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-xs p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 opacity-90">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl border border-gray-200 bg-white flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-snug">{{ $job->title }}</h3>
                        <p class="text-xs text-gray-400 font-medium mt-0.5">
                            {{ $job->created_at?->diffForHumans() ?? '-' }} &bull; {{ $job->location }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-6 sm:gap-8">
                    <div class="text-center">
                        <span class="block text-xs text-gray-400 font-medium">Kandidat</span>
                        <span class="block text-base font-extrabold text-slate-900 mt-0.5">{{ $job->applicants_count }}</span>
                    </div>
                    <span class="inline-block px-3.5 py-1 rounded-md bg-[#D9534F] text-white text-xs font-semibold">Tutup</span>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-8 text-center text-sm text-gray-500 italic">
                Tidak ada lowongan yang ditutup.
            </div>
        @endforelse
    </div>

</div>
@endsection
