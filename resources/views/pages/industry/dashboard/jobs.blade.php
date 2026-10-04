@extends('layouts.industry')

@section('title', 'Pekerjaan - ' . ($industry->company_name ?? 'Industry Dashboard'))

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    @if(session('success'))
        <div class="p-4 rounded-2xl bg-green-50 border border-green-200 text-xs font-bold text-green-700">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Pekerjaan</h1>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">Kelola talent pool dan lihat kandidat yang masuk.</p>
        </div>

        <button onclick="document.getElementById('modalAddJob').classList.replace('hidden','flex')"
                style="background-color: #C8102E !important; color: #ffffff !important;"
                class="px-6 py-3 rounded-2xl font-bold text-xs sm:text-sm flex items-center gap-2 hover:bg-red-800 transition shadow-sm active:scale-95 cursor-pointer">
            <span class="text-base leading-none">+</span>
            <span>Buat Talent Pool Baru</span>
        </button>
    </div>

    <!-- Filter -->
    <form action="{{ route('industry.jobs.index') }}" method="GET"
          style="background-color: #B91C1C !important;"
          class="rounded-3xl p-4 sm:p-5 flex flex-col md:flex-row items-center justify-between gap-4 shadow-md">

        <div class="flex items-center gap-4 w-full md:w-auto flex-1">
            <div class="flex items-center gap-2 text-white font-bold text-sm shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                <span>Cari posisi</span>
            </div>

            <div class="relative w-full max-w-xs">
                <input type="text" name="skill" value="{{ request('skill') }}" placeholder="Cth, DevOps"
                       class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-white text-xs text-gray-800 placeholder-gray-400 focus:outline-none shadow-inner font-medium">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
        </div>

        <div class="flex items-center gap-3 w-full md:w-auto justify-end">
            <select name="status" class="px-5 py-2.5 rounded-xl bg-white text-xs font-semibold text-gray-700 focus:outline-none shadow-inner cursor-pointer">
                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua status</option>
                <option value="buka" {{ request('status') == 'buka' ? 'selected' : '' }}>Buka</option>
                <option value="tutup" {{ request('status') == 'tutup' ? 'selected' : '' }}>Tutup</option>
            </select>

            <button type="submit" class="px-6 py-2.5 rounded-xl bg-white text-red-700 font-bold text-xs hover:bg-gray-100 transition shadow-sm active:scale-95 cursor-pointer">
                Terapkan
            </button>
        </div>
    </form>

    <!-- Daftar lowongan -->
    <div class="space-y-4">
        @forelse($jobs as $job)
            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200 shadow-xs hover:shadow-md transition-all duration-200 flex flex-col md:flex-row md:items-center justify-between gap-5">

                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 rounded-xl border border-gray-200 flex items-center justify-center text-slate-800 bg-white shrink-0">
                        <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-snug">{{ $job->title }}</h3>
                        <p class="text-xs text-gray-400 font-medium mt-0.5">
                            {{ $job->category }} &bull; {{ $job->location }} &bull; {{ $job->created_at?->diffForHumans() ?? '-' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-5 sm:gap-7 justify-between md:justify-end">
                    <div class="text-center">
                        <span class="text-xs text-gray-400 font-medium block">Kandidat</span>
                        <span class="text-base font-extrabold text-slate-900 block mt-0.5">{{ $job->applicants_count }}</span>
                    </div>

                    <div class="text-center">
                        <span class="text-xs text-gray-400 font-medium block">Status</span>
                        @if($job->is_active)
                            <span class="inline-block mt-0.5 px-3.5 py-1 rounded-md bg-[#99E5A8] text-gray-800 text-xs font-semibold">Buka</span>
                        @else
                            <span class="inline-block mt-0.5 px-3.5 py-1 rounded-md bg-[#D9534F] text-white text-xs font-semibold">Tutup</span>
                        @endif
                    </div>

                    <a href="{{ route('industry.applicants.index') }}"
                       style="background-color: #C8102E !important; color: #ffffff !important;"
                       class="px-5 py-2.5 rounded-xl font-bold text-xs hover:bg-red-800 transition active:scale-95 shadow-sm inline-flex items-center justify-center">
                        Lihat Kandidat
                    </a>

                    @if(! $job->is_active)
                        <form action="{{ route('industry.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Hapus lowongan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus"
                                    class="w-10 h-10 rounded-xl border border-red-500 text-red-600 hover:bg-red-50 flex items-center justify-center transition active:scale-95 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        @empty
            <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-10 text-center text-sm text-gray-500 italic">
                Belum ada lowongan. Klik <span class="font-semibold not-italic">Buat Talent Pool Baru</span> untuk menambah.
            </div>
        @endforelse
    </div>

</div>

<!-- Modal Buat Lowongan Baru (pakai flex, bukan block, agar kartu terpusat) -->
<div id="modalAddJob" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-8 max-w-lg w-full space-y-6 shadow-2xl relative">
        <h3 class="text-xl font-bold text-gray-900">Buat Talent Pool Baru</h3>
        <form action="{{ route('industry.jobs.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Posisi Pekerjaan</label>
                <input type="text" name="title" required placeholder="Contoh: Junior DevOps"
                       class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-red-600 focus:outline-none">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Kategori</label>
                    <select name="category" class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:outline-none">
                        <option value="Full Time">Full Time</option>
                        <option value="PKL / Magang">PKL / Magang</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="location" value="Surabaya, Indonesia"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:outline-none">
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" onclick="document.getElementById('modalAddJob').classList.replace('flex','hidden')"
                        class="px-5 py-2.5 rounded-xl border border-gray-300 text-xs font-bold text-gray-600 hover:bg-gray-50">Batal</button>
                <button type="submit" style="background-color: #C8102E !important; color: #fff !important;"
                        class="px-6 py-2.5 rounded-xl text-xs font-bold shadow-md">Simpan Lowongan</button>
            </div>
        </form>
    </div>
</div>
@endsection
