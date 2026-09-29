@extends('layouts.app')

@section('title', 'Informasi Alumni - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: Siswi Berjilbab Memegang Tablet/iPad (Folder: images/alumni/siswi-ipad.png) -->
        <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2">
            <!-- Rotated Rounded Diamond (Belah Ketupat Melengkung Merah dengan Dashed Outline) -->
            <div class="absolute w-[260px] h-[260px] md:w-[320px] md:h-[320px] bg-red-700 transform rotate-45 rounded-[2.5rem] shadow-xl"></div>
            <div class="absolute w-[290px] h-[290px] md:w-[350px] md:h-[350px] border-2 border-dashed border-gray-400 transform rotate-45 rounded-[3rem] pointer-events-none"></div>
            <!-- Foto Siswi -->
            <img src="{{ asset('images/alumni/siswi-ipad.png') }}" alt="Siswi Alumni SMK Telkom" class="relative z-10 w-[240px] md:w-[290px] h-auto object-contain drop-shadow-2xl">
        </div>

        <!-- Teks Kanan -->
        <div class="md:order-2 order-1">
            <div class="text-sm text-gray-500 font-medium mb-3 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-red-700 transition">Informasi</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-gray-900 font-semibold">Informasi Alumni</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                Informasi Alumni
            </h1>
            
            <p class="text-gray-600 text-sm md:text-base mb-8 leading-relaxed">
                Informasi resmi Alumni siswa SMK Telkom Sidoarjo. Halaman ini menyajikan data kelulusan secara transparan dan dapat diakses oleh seluruh siswa dan orang tua/wali.
            </p>
            
            <a href="#database-alumni" class="inline-flex items-center gap-2 bg-red-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition-all shadow-md hover:shadow-lg active:scale-95">
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

<!-- Section Database Alumni & Search Bar -->
<section id="database-alumni" class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-8">
        
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Database Alumni
            </h2>
        </div>

        <!-- Form Pencarian SSO (Dashed Border Input + Tombol Cari Merah) -->
        <form action="{{ route('alumni.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4 mb-16">
            <div class="relative w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukan SSO mu Disini" class="w-full pl-12 pr-4 py-4 rounded-2xl border-2 border-dashed border-gray-400 bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-red-700 text-sm font-medium text-gray-700 shadow-inner">
                <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-4 top-4.5"></i>
            </div>
            <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800 transition shadow-md active:scale-95 shrink-0">
                Cari
            </button>
        </form>

        <!-- Tabel Data Alumni -->
        <div class="bg-gray-100 rounded-3xl p-4 shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#8B0000] text-white rounded-t-xl overflow-hidden">
                            <th class="py-4 px-6 font-bold text-sm rounded-tl-2xl">No.</th>
                            <th class="py-4 px-6 font-bold text-sm">Nama Siswa</th>
                            <th class="py-4 px-6 font-bold text-sm">Jurusan</th>
                            <th class="py-4 px-6 font-bold text-sm">DTP</th>
                            <th class="py-4 px-6 font-bold text-sm rounded-tr-2xl">SSO</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700 font-medium">
                        @forelse($alumnis as $index => $alumni)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-6">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 font-bold text-gray-900">{{ $alumni['nama_siswa'] }}</td>
                                <td class="py-4 px-6"><span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-lg text-xs font-bold">{{ $alumni['jurusan'] }}</span></td>
                                <td class="py-4 px-6">{{ $alumni['dtp'] }}</td>
                                <td class="py-4 px-6 font-mono text-gray-600">{{ $alumni['sso'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500 italic">
                                    Data alumni tidak ditemukan atau masukkan nomor SSO dengan benar.
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