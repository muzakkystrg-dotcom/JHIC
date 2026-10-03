@extends('layouts.app')

@section('title', 'Informasi Alumni - SMK Telkom Sidoarjo')

@section('content')

<!-- Hero Section -->
<section class="relative bg-hero-pattern w-full min-h-[500px] flex items-center overflow-hidden pt-28 pb-16" data-aos="fade-in" data-aos-duration="1000">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Frame Kiri: Foto Siswi Alumni -->
        <div class="relative w-full h-[380px] md:h-[450px] flex justify-center items-center md:order-1 order-2" data-aos="zoom-in" data-aos-delay="200">
            <!-- Garis Putus-putus Melengkung Geometris -->
            <div class="absolute w-[290px] h-[290px] md:w-[350px] md:h-[350px] border-2 border-dashed border-gray-400 transform rotate-45 rounded-[3rem] pointer-events-none"></div>
            
            <!-- Foto Alumni -->
            <img src="{{ asset('images/alumni/alumni.png') }}" alt="Siswi Alumni SMK Telkom" class="relative z-10 w-[240px] md:w-[290px] h-auto object-contain drop-shadow-2xl">
        </div>

        <!-- Teks Kanan -->
        <div class="md:order-2 order-1" data-aos="fade-right" data-aos-delay="400">
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
            
            <!-- Tombol Jelajahi (Dipaksa Merah Solid Konsisten) -->
            <a href="#database-alumni" 
               style="background-color: #C8102E !important; color: #ffffff !important;" 
               class="inline-flex items-center gap-2 px-6 py-2.5 hover:opacity-90 font-bold text-sm rounded-xl shadow-md hover:shadow-lg transition-all duration-200 active:scale-95 mt-4">
                <span>Jelajahi</span>
                <span class="text-base leading-none">→</span>
            </a>
        </div>

    </div>
</section>

<!-- Garis Pemisah Aksen Merah Horizontal -->
<div class="w-full flex justify-center py-6 bg-white" data-aos="fade-up">
    <div class="w-72 h-1.5 rounded-full" style="background-color: #C8102E !important;"></div>
</div>

<!-- Section Database Alumni & Search Bar -->
<section id="database-alumni" class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-5xl mx-auto px-4 sm:px-8">
        
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Database Alumni
            </h2>
        </div>

        <!-- Form Pencarian SSO -->
        <form action="{{ route('alumni.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4 mb-16" data-aos="fade-up" data-aos-delay="100">
            <div class="relative w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukan SSO mu Disini" class="w-full pl-12 pr-4 py-4 rounded-2xl border-2 border-dashed border-gray-400 bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#C8102E] text-sm font-medium text-gray-700 shadow-inner">
                <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-4 top-4.5"></i>
            </div>
            <!-- Tombol Cari (Dipaksa Merah Solid) -->
            <button type="submit" 
                    style="background-color: #C8102E !important; color: #ffffff !important;" 
                    class="w-full sm:w-auto px-10 py-4 hover:opacity-90 font-bold rounded-xl transition shadow-md active:scale-95 shrink-0 cursor-pointer">
                Cari
            </button>
        </form>

        <!-- Tabel Data Alumni -->
        <div class="bg-gray-100 rounded-3xl p-4 shadow-sm border border-gray-200 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead>
                        <tr class="text-white rounded-t-xl overflow-hidden" style="background-color: #8B0000 !important;">
                            <th class="py-4 px-6 font-bold text-sm rounded-tl-2xl">No.</th>
                            <th class="py-4 px-6 font-bold text-sm">Nama Siswa</th>
                            <th class="py-4 px-6 font-bold text-sm">Jurusan</th>
                            <th class="py-4 px-6 font-bold text-sm">DTP</th>
                            <th class="py-4 px-6 font-bold text-sm rounded-tr-2xl">SSO</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700 font-medium bg-white">
                        @forelse($alumnis as $index => $alumni)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-6">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 font-bold text-gray-900">{{ $alumni['nama_siswa'] }}</td>
                                <td class="py-4 px-6">
                                    <span class="bg-red-50 text-red-700 px-2.5 py-1 rounded-lg text-xs font-bold">
                                        {{ $alumni['jurusan'] }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">{{ $alumni['dtp'] }}</td>
                                <td class="py-4 px-6 font-mono text-gray-600">{{ $alumni['sso'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-500 italic bg-white rounded-b-xl">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <i data-lucide="user-x" class="w-8 h-8 text-gray-300"></i>
                                        <span>Data alumni tidak ditemukan atau masukkan nomor SSO dengan benar.</span>
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