@extends('layouts.app')

@section('title', 'PPDB 2026/2027 - SMK Telkom Sidoarjo')

@section('content')
<!-- ==================== HERO PPDB (merah) ==================== -->
  <section class="relative overflow-hidden ppdb-hero">
    <div class="ppdb-hero-bg"></div>

    <!-- Dekorasi dashed lingkaran di belakang judul -->
    <img src="{{ asset('images/ppdb-dash.webp') }}" alt="" class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-[65%] w-[560px] max-w-none opacity-50 pointer-events-none hidden md:block" loading="eager" decoding="async" fetchpriority="high">

    <!-- Poster pojok kiri atas -->
    <img src="{{ asset('images/poster-77.webp') }}" alt="Poster Skomda" class="absolute left-8 top-28 w-36 md:w-44 rotate-[-6deg] shadow-xl rounded-lg hidden md:block pointer-events-none" loading="eager" decoding="async" fetchpriority="high">
    <!-- Poster pojok kanan atas -->
    <img src="{{ asset('images/poster-74.webp') }}" alt="Poster Skomda" class="absolute right-8 top-28 w-36 md:w-44 rotate-[6deg] shadow-xl rounded-lg hidden md:block pointer-events-none" loading="lazy" decoding="async">
    <!-- Poster kiri tengah -->
    <img src="{{ asset('images/poster-81.webp') }}" alt="Poster Skomda" class="absolute left-24 bottom-24 w-36 md:w-44 rotate-[4deg] shadow-xl rounded-lg hidden lg:block pointer-events-none z-10" loading="lazy" decoding="async">
    <!-- Poster kanan tengah -->
    <img src="{{ asset('images/poster-80.webp') }}" alt="Poster Skomda" class="absolute right-24 bottom-24 w-36 md:w-44 rotate-[-4deg] shadow-xl rounded-lg hidden lg:block pointer-events-none z-10" loading="lazy" decoding="async">

    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 pt-36 sm:pt-44 pb-40 sm:pb-56 flex flex-col items-center text-center">
      <h1 class="text-3xl sm:text-4xl md:text-6xl font-extrabold text-white tracking-tight drop-shadow-sm">
        Jadilah Bagian Dari Kami!
      </h1>
      <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row items-stretch sm:items-center gap-4 sm:gap-5 w-full sm:w-auto">
        <a href="#informasi" class="w-full sm:w-auto justify-center px-8 sm:px-9 py-3.5 sm:py-4 bg-white text-telkom-700 rounded-full text-sm sm:text-base font-extrabold shadow-lg hover:bg-red-50 transition flex items-center gap-2 active:scale-95">
          <span>Daftar Sekarang!</span>
          <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </a>
        <a href="https://wa.me/628113021919" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto justify-center px-8 py-3.5 sm:py-4 border-2 border-dashed border-white/80 text-white rounded-full text-sm sm:text-base font-bold hover:bg-white/10 transition flex items-center gap-2">
          <i data-lucide="eye" class="w-5 h-5"></i>
          <span>Brosur</span>
        </a>
      </div>
    </div>

    <!-- Foto siswa (cutout) di bagian bawah tengah -->
    <img src="{{ asset('images/ppdb-students.webp') }}" alt="Siswa SMK Telkom Sidoarjo" class="absolute bottom-0 left-1/2 -translate-x-1/2 z-10 w-[380px] sm:w-[480px] md:w-[560px] max-w-[85%] pointer-events-none select-none" loading="lazy" decoding="async">
  </section>

  <!-- ==================== INFORMASI SISWA BARU ==================== -->
  <section id="informasi" class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
          Informasi <span class="text-telkom-700">Siswa Baru</span>
        </h2>
        <p class="text-lg text-gray-500 mt-3">Alur Pendaftaran, Biaya, Dokumen Dibutuhkan, Alur Pembelajaran</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12 sm:mt-16">
        <!-- Langkah 01 -->
        <div class="flex flex-col items-center gap-4">
          <div class="w-16 h-16 rounded-full bg-telkom-700 text-white flex items-center justify-center text-xl font-black shadow-md">01</div>
          <div class="w-full border-2 border-dashed border-gray-300 rounded-2xl bg-white p-6 text-center flex-1">
            <i data-lucide="file-text" class="w-6 h-6 text-telkom-700 mx-auto"></i>
            <p class="text-sm text-gray-600 leading-relaxed mt-4">Lakukan pendaftaran online dan lengkapi formulir dengan data diri yang benar.</p>
          </div>
        </div>
        <!-- Langkah 02 -->
        <div class="flex flex-col items-center gap-4">
          <div class="w-16 h-16 rounded-full bg-gray-300 text-white flex items-center justify-center text-xl font-black shadow-md">02</div>
          <div class="w-full border-2 border-dashed border-gray-300 rounded-2xl bg-white p-6 text-center flex-1">
            <i data-lucide="list-checks" class="w-6 h-6 text-telkom-700 mx-auto"></i>
            <p class="text-sm text-gray-600 leading-relaxed mt-4">Peserta akan mengikuti serangkaian tes, meliputi Tes Kemampuan Dasar, Psikotes Dan Wawancara</p>
          </div>
        </div>
        <!-- Langkah 03 -->
        <div class="flex flex-col items-center gap-4">
          <div class="w-16 h-16 rounded-full bg-gray-300 text-white flex items-center justify-center text-xl font-black shadow-md">03</div>
          <div class="w-full border-2 border-dashed border-gray-300 rounded-2xl bg-white p-6 text-center flex-1">
            <i data-lucide="wallet" class="w-6 h-6 text-telkom-700 mx-auto"></i>
            <p class="text-sm text-gray-600 leading-relaxed mt-4">Jika lolos seleksi, Anda wajib melakukan daftar ulang. Segera lakukan pembayaran dan lengkapi semua berkas administrasi.</p>
          </div>
        </div>
        <!-- Langkah 04 -->
        <div class="flex flex-col items-center gap-4">
          <div class="w-16 h-16 rounded-full bg-gray-300 text-white flex items-center justify-center text-xl font-black shadow-md">04</div>
          <div class="w-full border-2 border-dashed border-gray-300 rounded-2xl bg-white p-6 text-center flex-1">
            <i data-lucide="graduation-cap" class="w-6 h-6 text-telkom-700 mx-auto"></i>
            <p class="text-sm text-gray-600 leading-relaxed mt-4"><strong class="text-gray-900">Ini Yang Ditunggu!</strong> Anda resmi menjadi siswa SMK Telkom Sidoarjo. Mulai pendidikan kejuruan terbaik di bidang IT/Telekomunikasi sekarang!</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== BIAYA & DOKUMEN ==================== -->
  <section class="py-16 sm:py-24 bg-[#F5F5F5]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Kartu Biaya -->
        <div class="bg-white rounded-3xl border-2 border-red-200 p-6 sm:p-8">
          <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center shrink-0">
              <i data-lucide="wallet" class="w-7 h-7 text-telkom-700"></i>
            </div>
            <div>
              <h3 class="text-xl font-extrabold text-gray-900">Biaya</h3>
              <p class="text-sm text-gray-500">Dibutuhkan Untuk Melengkapi Para Siswa</p>
            </div>
          </div>

          <div class="mt-8 sm:mt-10 space-y-7">
            <div class="flex items-center justify-between gap-4">
              <div>
                <p class="font-bold text-gray-900">Biaya Formulir</p>
                <p class="text-xs text-gray-500 mt-0.5">Pembayaran hanya untuk PPDB</p>
              </div>
              <span class="text-telkom-700 font-extrabold whitespace-nowrap">Rp 100.000,00</span>
            </div>
            <div class="flex items-center justify-between gap-4">
              <div>
                <p class="font-bold text-gray-900">Biaya Daftar Ulang</p>
                <p class="text-xs text-gray-500 mt-0.5">Biaya Yang Dilakukan Setiap Semester</p>
              </div>
              <span class="text-telkom-700 font-extrabold whitespace-nowrap">Rp 50.000,00</span>
            </div>
            <div class="flex items-center justify-between gap-4">
              <div>
                <p class="font-bold text-gray-900">SPP</p>
                <p class="text-xs text-gray-500 mt-0.5">Biaya yang dibutuhkan setiap Bulannya</p>
              </div>
              <span class="text-telkom-700 font-extrabold whitespace-nowrap">Rp 500.000,00</span>
            </div>
          </div>
        </div>

        <!-- Kartu Dokumen -->
        <div class="bg-telkom-700 text-white rounded-3xl p-6 sm:p-8 shadow-float">
          <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center shrink-0">
              <i data-lucide="file-text" class="w-7 h-7 text-white"></i>
            </div>
            <h3 class="text-xl font-extrabold">Dokumen Yang Dibutuhkan</h3>
          </div>

          <ul class="mt-10 space-y-5">
            <li class="flex items-center gap-3">
              <i data-lucide="check-square" class="w-6 h-6 text-white shrink-0"></i>
              <span class="text-base">Fotocopy Kartu Keluarga</span>
            </li>
            <li class="flex items-center gap-3">
              <i data-lucide="check-square" class="w-6 h-6 text-white shrink-0"></i>
              <span class="text-base">Surat Kesehatan Puskesmas</span>
            </li>
            <li class="flex items-center gap-3">
              <i data-lucide="check-square" class="w-6 h-6 text-white shrink-0"></i>
              <span class="text-base">Ijazah SMP Calon Siswa</span>
            </li>
            <li class="flex items-center gap-3">
              <i data-lucide="check-square" class="w-6 h-6 text-white shrink-0"></i>
              <span class="text-base">Fotocopy Rapor SMP Calon Siswa</span>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </section>

  <!-- ==================== ALUR PEMBELAJARAN ==================== -->
  <section class="py-16 sm:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Alur Pembelajaran Di</h2>
        <p class="text-telkom-700 text-xl font-extrabold tracking-wide mt-1">SMK TELKOM SIDOARJO</p>
      </div>

      <div class="relative mt-16 sm:mt-24">
        <!-- Garis merah horizontal menghubungkan lingkaran -->
        <div class="hidden lg:block absolute top-8 left-[12%] right-[12%] h-1 bg-telkom-700 rounded-full"></div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10 relative z-10">
          <!-- KELAS X -->
          <div class="flex flex-col items-center text-center gap-5">
            <div class="w-16 h-16 rounded-full bg-telkom-700 text-white flex items-center justify-center text-xl font-black shadow-lg">01</div>
            <h4 class="font-extrabold text-gray-900 tracking-wide">KELAS X</h4>
            <div class="w-full border-2 border-dashed border-gray-300 rounded-2xl p-5 bg-white text-left">
              <ul class="list-disc pl-4 space-y-2 text-sm text-gray-600 leading-relaxed">
                <li>Pengenalan konsep dasar digital &amp; teknologi</li>
                <li>Mini project</li>
              </ul>
            </div>
          </div>
          <!-- KELAS XI -->
          <div class="flex flex-col items-center text-center gap-5">
            <div class="w-16 h-16 rounded-full bg-telkom-700 text-white flex items-center justify-center text-xl font-black shadow-lg">02</div>
            <h4 class="font-extrabold text-gray-900 tracking-wide">KELAS XI</h4>
            <div class="w-full border-2 border-dashed border-gray-300 rounded-2xl p-5 bg-white text-left">
              <ul class="list-disc pl-4 space-y-2 text-sm text-gray-600 leading-relaxed">
                <li>Pemilihan kelas peminatan Digital Talent Program (DTP)</li>
                <li>Bimbingan mentor profesional dari dunia kerja</li>
                <li>Proyek kolaborasi lintas kelas</li>
              </ul>
            </div>
          </div>
          <!-- KELAS XII -->
          <div class="flex flex-col items-center text-center gap-5">
            <div class="w-16 h-16 rounded-full bg-telkom-700 text-white flex items-center justify-center text-xl font-black shadow-lg">03</div>
            <h4 class="font-extrabold text-gray-900 tracking-wide">KELAS XII</h4>
            <div class="w-full border-2 border-dashed border-gray-300 rounded-2xl p-5 bg-white text-left space-y-4">
              <div>
                <p class="font-bold text-gray-900 text-sm">Program 4 Tahun</p>
                <ul class="list-disc pl-4 space-y-1.5 text-sm text-gray-600 leading-relaxed mt-1.5">
                  <li>Mata Pelajaran Umum &amp; Kejuruan</li>
                  <li>Penilaian Akhir Kelulusan</li>
                  <li>Program Inkubasi</li>
                </ul>
              </div>
              <div>
                <p class="font-bold text-gray-900 text-sm">Program 3 Tahun</p>
                <ul class="list-disc pl-4 space-y-1.5 text-sm text-gray-600 leading-relaxed mt-1.5">
                  <li>Praktik Kerja Lapangan</li>
                  <li>Penilaian Akhir Kelulusan</li>
                  <li>Sertifikasi Kompetensi</li>
                  <li>Program BMW</li>
                </ul>
              </div>
            </div>
          </div>
          <!-- KELAS XIII (SIJA) -->
          <div class="flex flex-col items-center text-center gap-5">
            <div class="w-16 h-16 rounded-full bg-telkom-700 text-white flex items-center justify-center text-xl font-black shadow-lg">04</div>
            <h4 class="font-extrabold text-gray-900 tracking-wide">KELAS XIII (SIJA)</h4>
            <div class="w-full border-2 border-dashed border-gray-300 rounded-2xl p-5 bg-white text-left">
              <ul class="list-disc pl-4 space-y-2 text-sm text-gray-600 leading-relaxed">
                <li>Fourth Year Program 4 Tahun</li>
                <li>Praktik Kerja Lapangan</li>
                <li>Sertifikasi Kompetensi</li>
                <li>Program BMW</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== FAQ + SKOMDA AI ==================== -->
  <section class="py-16 sm:py-24 bg-[#F5F5F5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        <!-- FAQ -->
        <div class="lg:col-span-2">
          <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
            Pertanyaan <span class="text-telkom-700">Yang Populer</span>
          </h2>
          <p class="text-gray-500 mt-2">Frequently Asked Question</p>

          <div class="mt-10 space-y-4">
            <div class="faq-item bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
              <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between gap-4 px-5 sm:px-6 py-4 sm:py-5 text-left font-bold text-sm sm:text-base text-gray-900 hover:text-telkom-700 transition">
                <span>Apa perbedaan dari jurusan SIJA dan TJAT?</span>
                <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400 shrink-0 transition-transform"></i>
              </button>
              <div class="faq-answer hidden px-5 sm:px-6 pb-5 text-sm text-gray-600 leading-relaxed">
                SIJA (Sistem Informasi Jaringan &amp; Aplikasi) berfokus pada rekayasa perangkat lunak, aplikasi web/mobile, cloud, dan AI dengan program 4 tahun termasuk magang industri penuh di kelas XIII. Sedangkan TJAT (Teknik Jaringan Akses Telekomunikasi) berfokus pada infrastruktur jaringan fiber optik, telekomunikasi, dan Cisco/MikroTik dengan program 3 tahun sehingga lebih cepat siap kerja di ISP maupun perusahaan telekomunikasi.
              </div>
            </div>

            <div class="faq-item bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
              <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between gap-4 px-5 sm:px-6 py-4 sm:py-5 text-left font-bold text-sm sm:text-base text-gray-900 hover:text-telkom-700 transition">
                <span>Apa saja syarat pendaftaran yang perlu disiapkan?</span>
                <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400 shrink-0 transition-transform"></i>
              </button>
              <div class="faq-answer hidden px-5 sm:px-6 pb-5 text-sm text-gray-600 leading-relaxed">
                Calon siswa perlu menyiapkan fotokopi Kartu Keluarga, fotokopi rapor SMP semester 1-5, pas foto berwarna 3x4, surat keterangan bebas buta warna dari puskesmas/dokter, serta mengisi formulir pendaftaran online dengan data diri yang benar.
              </div>
            </div>

            <div class="faq-item bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
              <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between gap-4 px-5 sm:px-6 py-4 sm:py-5 text-left font-bold text-sm sm:text-base text-gray-900 hover:text-telkom-700 transition">
                <span>Berapa biaya pendaftaran dan SPP di SMK Telkom Sidoarjo?</span>
                <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400 shrink-0 transition-transform"></i>
              </button>
              <div class="faq-answer hidden px-5 sm:px-6 pb-5 text-sm text-gray-600 leading-relaxed">
                Biaya formulir pendaftaran PPDB sebesar Rp 100.000,00 (sekali bayar), biaya daftar ulang Rp 50.000,00 setiap semester, dan SPP Rp 500.000,00 per bulan. Terdapat juga jalur beasiswa Yayasan Pendidikan Telkom bagi siswa berprestasi.
              </div>
            </div>
          </div>
        </div>

        <!-- Skomda AI -->
        <div>
          <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 sm:p-8 flex flex-col h-full">
            <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center">
              <i data-lucide="bot" class="w-8 h-8 text-telkom-700"></i>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 mt-6">Skomda AI</h3>
            <p class="text-base text-gray-600 leading-relaxed mt-3 flex-1">
              Need quick answers? Our AI assistant can help you with registration details, requirements, and major info 24/7.
            </p>
            <button onclick="window.openSkomdaChat && window.openSkomdaChat()" class="mt-8 w-full bg-[#2D2D2D] hover:bg-black text-white rounded-xl py-4 text-sm font-bold flex items-center justify-between px-5 transition active:scale-95">
              <span>Mulai Bincang Dengan AI!</span>
              <i data-lucide="chevron-down" class="w-4 h-4"></i>
            </button>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ==================== FOOTER ==================== -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/ppdb.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/ppdb.js') }}"></script>
@endpush
