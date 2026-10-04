@extends('layouts.industry')

@section('title', 'Data Pelamar - ' . ($industry->company_name ?? 'Industry Dashboard'))

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    <!-- Header -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Data Pelamar</h1>
        <p class="text-xs sm:text-sm text-gray-500 mt-1">
            Kandidat alumni yang masuk ke perusahaan Anda.
            @if($applicants->where('source', 'hirelink')->count())
                <span class="font-semibold text-[#C8102E]">
                    {{ $applicants->where('source', 'hirelink')->count() }} dari form Hirelink
                </span>
            @endif
        </p>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-2xl bg-green-50 border border-green-200 text-xs font-bold text-green-700">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($applicants as $applicant)
            @php
                $badge = [
                    'pending'   => ['label' => 'Baru',       'class' => 'bg-[#FDE68A] text-gray-800'],
                    'interview' => ['label' => 'Wawancara',  'class' => 'bg-[#93C5FD] text-gray-800'],
                    'accepted'  => ['label' => 'Diterima',   'class' => 'bg-[#99E5A8] text-gray-800'],
                    'rejected'  => ['label' => 'Ditolak',    'class' => 'bg-[#D9534F] text-white'],
                ][$applicant->status] ?? ['label' => $applicant->status, 'class' => 'bg-gray-200 text-gray-700'];
            @endphp

            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200 shadow-xs hover:shadow-md transition-all duration-200 flex flex-col md:flex-row md:items-center justify-between gap-5">

                <!-- Identitas -->
                <div class="flex items-center gap-5 min-w-0">
                    <div class="w-12 h-12 rounded-full bg-[#C8102E]/10 text-[#C8102E] flex items-center justify-center font-bold text-sm shrink-0">
                        {{ mb_strtoupper(mb_substr($applicant->full_name, 0, 2)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-snug truncate">{{ $applicant->full_name }}</h3>
                            @if($applicant->source === 'hirelink')
                                <span class="shrink-0 px-2 py-0.5 rounded-md bg-[#C8102E]/10 text-[#C8102E] text-[10px] font-bold uppercase tracking-wide">Hirelink</span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 font-medium mt-0.5 truncate">
                            {{ $applicant->major ?? 'Siswa SMK Telkom Sidoarjo' }}
                            @if($applicant->jobPosting)
                                &bull; {{ $applicant->jobPosting->title }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Aksi -->
                <div class="flex items-center gap-6 sm:gap-8 justify-between md:justify-end">
                    <div class="text-center">
                        <span class="text-xs text-gray-400 font-medium block">AI Match</span>
                        <span class="text-base font-extrabold text-slate-900 block mt-0.5">{{ $applicant->ai_match_score ?? 0 }}</span>
                    </div>

                    <div class="text-center">
                        <span class="text-xs text-gray-400 font-medium block">Status</span>
                        <span class="inline-block mt-0.5 px-3.5 py-1 rounded-md text-xs font-semibold shadow-xs {{ $badge['class'] }}">
                            {{ $badge['label'] }}
                        </span>
                    </div>

                    <a href="{{ route('industry.applicants.show', $applicant->id) }}"
                       style="background-color: #C8102E !important; color: #ffffff !important;"
                       class="px-6 py-2.5 rounded-xl font-bold text-xs hover:bg-red-800 transition active:scale-95 shadow-sm inline-flex items-center justify-center">
                        Lihat Detail
                    </a>
                </div>

            </div>
        @empty
            <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-10 text-center text-sm text-gray-500 italic">
                Belum ada pelamar masuk saat ini.
            </div>
        @endforelse
    </div>

    <!-- Navigasi Halaman (pagination server-side) -->
    @if($applicants->hasPages())
        <div class="pt-2">
            {{ $applicants->links() }}
        </div>
    @endif

</div>
@endsection
