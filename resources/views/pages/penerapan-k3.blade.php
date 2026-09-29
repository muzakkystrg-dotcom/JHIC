@extends('layouts.app')

@section('title', 'Penerapan K3 - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: Siswi Berkacamata Memegang Tablet (Folder: images/k3/siswi-k3.png) -->
        <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2">
            <!-- Lingkaran Merah di Background -->
            <div class="absolute w-[260px] h-[260px] md:w-[320px] md:h-[320px] bg-red-700 rounded-full shadow-xl"></div>
            <!-- Garis Putus-putus Melingkar -->
            <div class="absolute w-[290px] h-[290px] md:w-[350px] md:h-[350px] border-2 border-dashed border-gray-400 rounded-full pointer-events-none"></div>
            <!-- Foto Siswi -->
            <img src="{{ asset('images/k3/siswi-k3.png') }}" alt="Siswi K3 SMK Telkom" class="relative z-10 w-[240px] md:w-[280px] h-auto object-contain drop-shadow-2xl">
        </div>

        <!-- Teks Kanan -->
        <div class="md:order-2 order-1">
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
            
            <a href="#dokumen-k3" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95">
                Jelajahi 
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>

<!-- Garis Pemisah Aksen Merah Horizontal -->
<div class="w-full flex justify-center py-6 bg-white">
    <div class="w-72 h-1.5 bg-red-700 rounded-full"></div>
</div>

<!-- Section Dokumen K3 -->
<section id="dokumen-k3" class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-8">
        
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Dokumen K3
            </h2>
        </div>

        <!-- Tabel Dokumen K3 -->
        <div class="bg-gray-100 rounded-3xl p-4 shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#8B0000] text-white rounded-t-xl overflow-hidden">
                            <th class="py-4 px-6 font-bold text-sm rounded-tl-2xl">No.</th>
                            <th class="py-4 px-6 font-bold text-sm">Nama File</th>
                            <th class="py-4 px-6 font-bold text-sm">Diunggah</th>
                            <th class="py-4 px-6 font-bold text-sm rounded-tr-2xl text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700 font-medium">
                        @forelse($dokumens as $index => $doc)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-6">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 font-bold text-gray-900 flex items-center gap-2">
                                    <i data-lucide="file-text" class="w-4 h-4 text-red-600 shrink-0"></i>
                                    {{ $doc['nama_file'] }}
                                </td>
                                <td class="py-4 px-6 text-gray-500">{{ $doc['diunggah'] }}</td>
                                <td class="py-4 px-6 text-center">
                                    <a href="#" class="inline-flex items-center gap-1.5 bg-red-700 text-white text-xs px-3.5 py-2 rounded-lg hover:bg-red-800 transition shadow-sm font-bold">
                                        <i data-lucide="download" class="w-3.5 h-3.5"></i> Unduh
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500 italic">
                                    Belum ada dokumen K3 yang diunggah.
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