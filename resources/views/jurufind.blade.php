@extends('layouts.app')

@section('title', 'Tes Minat Bakat (JURUFIND) - SMK Telkom Sidoarjo')

@section('content')
  <!-- ==================== 1. HERO ==================== -->
  <section class="relative bg-white overflow-hidden">
    <img src="{{ asset('images/blob.webp') }}" alt="" class="absolute -left-24 top-8 w-[520px] max-w-none opacity-60 pointer-events-none hidden md:block" loading="eager" decoding="async" fetchpriority="high">

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 sm:pt-32 lg:pt-36 pb-16 lg:pb-24">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <!-- Kiri -->
        <div>
          <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-900 leading-[1.15] tracking-tight">
            Temukan <span class="text-telkom-700">Jurusan</span> yang <br class="hidden sm:block" />
            cocok dengan mu!
          </h1>
          <p class="text-gray-600 text-sm sm:text-base leading-relaxed mt-6 max-w-lg">
            “Jangan sampai salah pilih jurusan dan nyesel di kemudian hari.
            Cari tahu minat, bakat, serta prospek karir impianmu lewat
            analisis sederhana yang siap memandu langkahmu.”
          </p>

          <a href="{{ route('jurufind.test') }}"
            class="block w-full sm:inline-block sm:w-auto mt-10 px-8 sm:px-10 py-3.5 bg-telkom-700 hover:bg-telkom-800 text-white text-sm font-bold rounded-xl shadow-md transition active:scale-95 text-center">
            Ke Bagian Tes!
          </a>
        </div>

        <!-- Kanan: maskot dalam heksagon dashed -->
        <div class="relative hidden md:flex justify-center items-center h-[420px]">
          <div class="jf-hex"></div>
          <img src="{{ asset('images/mascot.webp') }}" alt="Maskot JURUFIND" class="jf-mascot relative z-10 w-[280px] lg:w-[340px] drop-shadow-2xl" loading="eager" decoding="async" fetchpriority="high">
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== 2. INFO KARTU ==================== -->
  <section class="py-16 lg:py-20 bg-[#F5F5F5]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 lg:gap-8">
        <div class="bg-telkom-700 text-white rounded-2xl p-6 sm:p-8 shadow-md">
          <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
            <i data-lucide="clock" class="w-5 h-5 text-white"></i>
          </div>
          <p class="text-xs text-red-100 mt-6">Estimasi Waktu</p>
          <p class="text-2xl font-extrabold mt-1">6-7 Menit</p>
        </div>
        <div class="bg-white border-2 border-dashed border-red-300 rounded-2xl p-6 sm:p-8">
          <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center">
            <i data-lucide="book-open" class="w-5 h-5 text-telkom-700"></i>
          </div>
          <p class="text-xs text-gray-500 mt-6">Jumlah Pertanyaan</p>
          <p class="text-2xl font-extrabold text-telkom-700 mt-1">20 Pertanyaan</p>
        </div>
        <div class="bg-white border-2 border-dashed border-red-300 rounded-2xl p-6 sm:p-8">
          <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center">
            <i data-lucide="list-checks" class="w-5 h-5 text-telkom-700"></i>
          </div>
          <p class="text-xs text-gray-500 mt-6">Tipe Soal</p>
          <p class="text-2xl font-extrabold text-telkom-700 mt-1">Pilihan Ganda</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== 3. TIPS ==================== -->
  <section class="pb-16 lg:pb-20 bg-[#F5F5F5]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-gradient-to-r from-telkom-700 to-telkom-800 p-6 sm:p-8 flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6">
        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0">
          <i data-lucide="info" class="w-5 h-5 text-white"></i>
        </div>
        <div>
          <h3 class="text-lg font-extrabold text-white">Tips Sebelum Memulai</h3>
          <p class="text-sm text-red-100 mt-1">Tidak ada jawaban benar atau salah. Jawablah dengan jujur berdasarkan minat
            dan kesukaanmu.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== 4. LANGKAH-LANGKAH ==================== -->
  <section class="py-16 sm:py-24 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col gap-14 sm:gap-20">

        <div class="jf-step-1 flex gap-4 sm:gap-6 items-start">
          <div class="flex flex-col items-center shrink-0">
            <span class="w-4 h-4 rounded-full bg-telkom-700"></span>
            <span class="w-0.5 h-20 bg-telkom-700"></span>
          </div>
          <div class="max-w-md">
            <div class="flex items-center gap-4">
              <div class="w-10 h-10 rounded-xl bg-red-50 text-telkom-700 flex items-center justify-center">
                <i data-lucide="book-open" class="w-5 h-5"></i>
              </div>
              <h3 class="text-xl font-extrabold text-gray-900">Jawab Pertanyaan</h3>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed mt-3">Pilih jawaban yang paling menggambarkan dirimu. Tidak
              ada batasan waktu, jawab dengan santai.</p>
          </div>
        </div>

        <div class="jf-step-2 flex gap-4 sm:gap-6 items-start">
          <div class="flex flex-col items-center shrink-0">
            <span class="w-4 h-4 rounded-full bg-gray-400"></span>
            <span class="w-0.5 h-20 bg-gray-400"></span>
          </div>
          <div class="max-w-md">
            <div class="flex items-center gap-4">
              <div class="w-10 h-10 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center">
                <i data-lucide="thumbs-up" class="w-5 h-5"></i>
              </div>
              <h3 class="text-xl font-extrabold text-gray-900">Lihat Rekomendasi</h3>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed mt-3">Sistem akan mencocokkan jawabanmu dengan jurusan-jurusan
              yang tersedia di sekolah kami.</p>
          </div>
        </div>

        <div class="jf-step-3 flex gap-4 sm:gap-6 items-start">
          <div class="flex flex-col items-center shrink-0">
            <span class="w-4 h-4 rounded-full bg-gray-400"></span>
            <span class="w-0.5 h-20 bg-gray-400"></span>
          </div>
          <div class="max-w-md">
            <div class="flex items-center gap-4">
              <div class="w-10 h-10 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center">
                <i data-lucide="compass" class="w-5 h-5"></i>
              </div>
              <h3 class="text-xl font-extrabold text-gray-900">Eksplorasi Jurusan</h3>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed mt-3">Pelajari lebih dalam tentang kurikulum, fasilitas, dan
              prospek karir dari jurusan rekomendasi.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ==================== 5. CTA MERAH ==================== -->
  <section class="relative overflow-hidden bg-gradient-to-b from-telkom-700 to-telkom-800 py-16 sm:py-20 text-center">
    <img src="{{ asset('images/ppdb-dash.webp') }}" alt="" class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-[38%] w-[620px] max-w-none opacity-30 pointer-events-none" loading="lazy" decoding="async">

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6">
      <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight">Siap Menemukan Jalan mu?</h2>
      <p class="text-red-100 mt-4">Klik Tombol Dibawah untuk memulai Tes minat mu sekarang!</p>

      <!-- CTA: mulai tes -->
      <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6">
        <a href="{{ route('jurufind.test') }}"
          class="w-full sm:w-auto px-10 sm:px-12 py-3.5 bg-white text-gray-900 rounded-full text-sm font-bold shadow-lg transition hover:bg-red-50 active:scale-95">Mulai
          Tes</a>
        <button type="button"
          class="w-full sm:w-auto px-8 sm:px-10 py-3.5 border-2 border-white text-white rounded-full text-sm font-bold transition hover:bg-white/10 active:scale-95">Baca
          Panduan</button>
      </div>

      <img src="{{ asset('images/ppdb-students.webp') }}" alt="Siswa SMK Telkom Sidoarjo" class="mx-auto mt-12 w-[320px] md:w-[400px] max-w-[85%] pointer-events-none select-none" loading="lazy" decoding="async">
    </div>
  </section>

  <!-- ==================== FOOTER ==================== -->
@endsection

@push('styles')
  @vite('resources/js/jurufind.js')
@endpush