@extends('layouts.industry')

@section('title', 'Review Pelamar - ' . $applicant->full_name)

@section('content')
@php
    $application = $applicant->jobApplication;

    $badge = [
        'pending'   => ['label' => 'Baru',      'class' => 'bg-[#FDE68A] text-gray-800'],
        'interview' => ['label' => 'Wawancara', 'class' => 'bg-[#93C5FD] text-gray-800'],
        'accepted'  => ['label' => 'Diterima',  'class' => 'bg-[#99E5A8] text-gray-800'],
        'rejected'  => ['label' => 'Ditolak',   'class' => 'bg-[#D9534F] text-white'],
    ][$applicant->status] ?? ['label' => $applicant->status, 'class' => 'bg-gray-200 text-gray-700'];

    $skills = is_array($applicant->skills) ? $applicant->skills : [];
    $hasCv = $application && $application->resume_path;
    $hasPortfolio = $application && $application->portfolio_path;
@endphp

<div class="max-w-4xl mx-auto space-y-6">

    @if(session('success'))
        <div class="p-4 rounded-2xl bg-green-50 border border-green-200 text-xs font-bold text-green-700">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-200 shadow-sm space-y-8">

        <!-- HEADER PROFIL -->
        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-6">
            <div class="flex items-center gap-5 sm:gap-6 min-w-0">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-[#C8102E]/10 text-[#C8102E] flex items-center justify-center text-2xl font-black shrink-0">
                    {{ mb_strtoupper(mb_substr($applicant->full_name, 0, 2)) }}
                </div>
                <div class="space-y-1 min-w-0">
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight truncate">{{ $applicant->full_name }}</h2>
                    <p class="text-xs sm:text-sm text-gray-500 font-medium">{{ $applicant->email }}</p>
                    <p class="text-xs sm:text-sm text-gray-500 font-medium">{{ $applicant->phone }}</p>
                    @if($applicant->linkedin_url)
                        <a href="{{ $applicant->linkedin_url }}" target="_blank" class="text-xs sm:text-sm text-[#C8102E] font-semibold hover:underline">Lihat LinkedIn</a>
                    @endif
                </div>
            </div>

            <div class="shrink-0 self-start">
                <span class="inline-block px-4 py-1.5 rounded-lg text-sm font-bold shadow-xs {{ $badge['class'] }}">
                    {{ $badge['label'] }}
                </span>
            </div>
        </div>

        <!-- INFO SINGKAT -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="rounded-2xl border border-gray-200 p-4">
                <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wide">Jurusan</span>
                <span class="block text-sm font-semibold text-slate-800 mt-1">{{ $applicant->major ?? '-' }}</span>
            </div>
            <div class="rounded-2xl border border-gray-200 p-4">
                <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wide">SSO / DTP</span>
                <span class="block text-sm font-semibold text-slate-800 mt-1">{{ $applicant->sso_number ?: '-' }} &bull; {{ $applicant->dtp ?? '-' }}</span>
            </div>
            <div class="rounded-2xl border border-gray-200 p-4">
                <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wide">AI Match</span>
                <span class="block text-sm font-semibold text-slate-800 mt-1">{{ $applicant->ai_match_score ?? 0 }} &bull; {{ $applicant->work_preference ?? '-' }}</span>
            </div>
        </div>

        <!-- HARD SKILLS -->
        <div>
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-3">Hard Skills</h3>
            @if(count($skills))
                <div class="flex flex-wrap gap-2">
                    @foreach($skills as $skill)
                        <span class="px-3 py-1.5 rounded-lg bg-gray-100 border border-gray-200 text-xs font-semibold text-gray-700">{{ $skill }}</span>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-400 italic">Tidak ada data hard skill.</p>
            @endif
        </div>

        <!-- BERKAS -->
        <div>
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-3">Berkas Lamaran</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @if($hasCv)
                    <a href="{{ route('industry.applicants.file', [$applicant->id, 'cv']) }}"
                       class="flex items-center justify-between gap-4 px-5 py-3.5 rounded-xl border border-gray-300 hover:border-[#C8102E] transition group">
                        <span class="text-sm font-semibold text-slate-800">CV / Resume</span>
                        <svg class="w-4 h-4 text-gray-500 group-hover:text-[#C8102E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </a>
                @else
                    <div class="flex items-center justify-between gap-4 px-5 py-3.5 rounded-xl border border-dashed border-gray-300 text-gray-400">
                        <span class="text-sm font-medium">CV / Resume</span>
                        <span class="text-xs italic">Tidak tersedia</span>
                    </div>
                @endif

                @if($hasPortfolio)
                    <a href="{{ route('industry.applicants.file', [$applicant->id, 'portfolio']) }}"
                       class="flex items-center justify-between gap-4 px-5 py-3.5 rounded-xl border border-gray-300 hover:border-[#C8102E] transition group">
                        <span class="text-sm font-semibold text-slate-800">Portofolio</span>
                        <svg class="w-4 h-4 text-gray-500 group-hover:text-[#C8102E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </a>
                @else
                    <div class="flex items-center justify-between gap-4 px-5 py-3.5 rounded-xl border border-dashed border-gray-300 text-gray-400">
                        <span class="text-sm font-medium">Portofolio</span>
                        <span class="text-xs italic">Tidak tersedia</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- AKSI STATUS -->
        <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <a href="{{ route('industry.applicants.index') }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-slate-900 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Data Pelamar
            </a>

            <div class="flex flex-wrap items-center gap-3">
                <form action="{{ route('industry.applicants.updateStatus', $applicant->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="px-5 py-2.5 rounded-xl border border-red-400 text-red-600 font-bold text-xs hover:bg-red-50 transition active:scale-95">
                        Tolak
                    </button>
                </form>

                <form action="{{ route('industry.applicants.updateStatus', $applicant->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="interview">
                    <button type="submit" class="px-5 py-2.5 rounded-xl border border-blue-400 text-blue-600 font-bold text-xs hover:bg-blue-50 transition active:scale-95">
                        Undang Wawancara
                    </button>
                </form>

                <form action="{{ route('industry.applicants.updateStatus', $applicant->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="accepted">
                    <button type="submit" style="background-color: #C8102E !important; color: #ffffff !important;"
                            class="px-6 py-2.5 rounded-xl font-bold text-xs hover:bg-red-800 transition active:scale-95 shadow-sm">
                        Terima
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection
