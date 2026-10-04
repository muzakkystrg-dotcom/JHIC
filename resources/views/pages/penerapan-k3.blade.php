@extends('layouts.app')

@section('title', 'Penerapan K3 - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section (Dilengkapi Animasi AOS) -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16" data-aos="fade-in" data-aos-duration="1000">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: Foto Siswi Murni (Tanpa Background Merah & Tanpa Dashed Line) -->
        <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2" data-aos="zoom-in" data-aos-delay="200">
            <!-- Foto Siswi (Mengambil dari folder images/home/tifany.webp) -->
            <img src="{{ asset('images/home/tifany.webp') }}" alt="Siswi K3 SMK Telkom" class="relative z-10 w-[260px] md:w-[320px] h-auto object-contain drop-shadow-2xl" loading="eager" decoding="async" fetchpriority="high" width="392" height="425">
        </div>

        <!-- Teks Kanan -->
        <div class="md:order-2 order-1" data-aos="fade-right" data-aos-delay="400">
            <div class="text-sm text-gray-500 font-medium mb-3 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-red-700 transition">Informasi</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-gray-900 font-semibold">Penerapan K3</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                Penerapan <span class="text-red-700">K3</span>
            </h1>
            
            <p class="text-gray-600 text-sm md:text-base mb-8 leading-relaxed">
                SMK Telkom Sidoarjo memprioritaskan Penerapan K3 (Keselamatan dan Kesehatan Kerja) di semua kegiatan praktik dan laboratorium. Kami memastikan siswa menguasai standar K3 industri untuk siap kerja.
            </p>
            
            <a href="#dokumen-k3" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer mt-4">
                Jelajahi
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

<!-- Garis Pemisah Aksen Merah Horizontal -->
<div class="w-full flex justify-center py-6 bg-white" data-aos="fade-up">
    <div class="w-72 h-1.5 bg-red-700 rounded-full"></div>
</div>

<!-- Section Dokumen K3 -->
<section id="dokumen-k3" class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-5xl mx-auto px-4 sm:px-8">
        
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Dokumen K3
            </h2>
        </div>

        <!-- Tabel Dokumen K3 -->
        <div class="bg-gray-100 rounded-3xl p-4 shadow-sm border border-gray-200 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead>
                        <tr class="bg-[#8B0000] text-white rounded-t-xl overflow-hidden">
                            <th class="py-4 px-6 font-bold text-sm rounded-tl-2xl w-16">No.</th>
                            <th class="py-4 px-6 font-bold text-sm">Nama File</th>
                            <th class="py-4 px-6 font-bold text-sm w-48">Diunggah</th>
                            <th class="py-4 px-6 font-bold text-sm rounded-tr-2xl text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700 font-medium bg-white">
                        @forelse($dokumens as $index => $doc)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-6 text-center">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 font-bold text-gray-900 flex items-center gap-3">
                                    <i data-lucide="file-text" class="w-5 h-5 text-red-600 shrink-0"></i>
                                    <span class="line-clamp-2 hover:text-red-700 transition cursor-pointer">{{ $doc->nama_file }}</span>
                                </td>
                                <td class="py-4 px-6 text-gray-500">{{ $doc->uploaded_at_formatted }}</td>
                                <td class="py-4 px-6 text-center">
                                    <a href="#" class="inline-flex items-center justify-center gap-1.5 bg-red-700 text-white text-xs px-4 py-2 rounded-lg hover:bg-red-800 transition shadow-sm font-bold active:scale-95">
                                        <i data-lucide="download" class="w-3.5 h-3.5"></i> Unduh
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-gray-500 italic bg-white rounded-b-xl">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <i data-lucide="folder-open" class="w-8 h-8 text-gray-300"></i>
                                        <span>Belum ada dokumen K3 yang diunggah.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

@endsection