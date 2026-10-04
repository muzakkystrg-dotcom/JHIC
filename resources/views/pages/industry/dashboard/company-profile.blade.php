@extends('layouts.industry')

@section('title', 'Profil Perusahaan - ' . $profile['name'])

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Profil Perusahaan</h1>
        <p class="text-xs sm:text-sm text-gray-500 mt-1">
            Informasi kemitraan industri resmi SMK Telkom Sidoarjo.
        </p>
    </div>

    <!-- KARTU UTAMA: LOGO, NAMA, ID -->
    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
            <div class="w-28 h-28 rounded-2xl border border-gray-200 p-3 flex items-center justify-center bg-white shrink-0">
                <img src="{{ $profile['logo'] }}" alt="Logo {{ $profile['name'] }}" class="max-h-20 w-auto object-contain">
            </div>

            <div class="text-center sm:text-left space-y-1">
                <h2 class="text-xl font-bold text-gray-900">{{ $profile['name'] }}</h2>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                    ID Mitra: {{ $profile['industry_id'] }}
                </p>
                @if($profile['website'])
                    <a href="{{ $profile['website'] }}" target="_blank"
                       class="inline-block text-sm font-semibold text-[#C8102E] hover:underline pt-1">
                        {{ $profile['website_label'] ?? $profile['website'] }}
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- KONTAK -->
    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 sm:p-8 space-y-5">
        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wide">Kontak & Lokasi</h3>

        <div>
            <span class="block text-xs font-bold text-gray-400 uppercase">Alamat Kantor</span>
            <p class="text-sm text-gray-700 mt-1">
                {{ $profile['address'] ?: 'Belum ada data alamat.' }}
            </p>
        </div>

        <div>
            <span class="block text-xs font-bold text-gray-400 uppercase">Kontak HRD</span>
            <p class="text-sm text-gray-700 mt-1">
                {{ $profile['email'] ?: 'Belum ada data kontak.' }}
            </p>
        </div>
    </div>

    <!-- TENTANG -->
    @if(!empty($profile['description']))
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 sm:p-8 space-y-3">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wide">Tentang Perusahaan</h3>
            <p class="text-sm text-gray-700 leading-relaxed">{{ $profile['description'] }}</p>
        </div>
    @endif

    <!-- SOCIAL MEDIA -->
    @if($profile['linkedin'] || $profile['instagram'])
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 sm:p-8 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wide">Social Media</h3>
            <div class="flex flex-wrap items-center gap-3">
                @if($profile['linkedin'])
                    <a href="{{ $profile['linkedin'] }}" target="_blank"
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 hover:border-[#C8102E] text-sm font-semibold text-gray-700 transition">
                        <span class="text-xs font-bold">in</span> LinkedIn
                    </a>
                @endif
                @if($profile['instagram'])
                    <a href="{{ $profile['instagram'] }}" target="_blank"
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 hover:border-[#C8102E] text-sm font-semibold text-gray-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                        Instagram
                    </a>
                @endif
            </div>
        </div>
    @endif

    <!-- CATATAN -->
    <div class="rounded-2xl bg-[#C8102E]/5 border border-[#C8102E]/20 p-5 text-xs text-gray-600 leading-relaxed">
        Perlu memperbarui data perusahaan (nama, alamat, kontak, deskripsi, sosial media)?
        Hubungi admin SMK Telkom Sidoarjo untuk proses perubahan data kemitraan.
    </div>

</div>
@endsection
