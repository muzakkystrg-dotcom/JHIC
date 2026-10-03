@extends('layouts.app')

@section('title', 'SMK Telkom Sidoarjo - Homepage')

@section('content')

  <!-- ==================== 2. HERO SECTION (Fade In) ==================== -->
  <section id="beranda" class="pt-32 pb-24 bg-[#F0F0F0] relative overflow-hidden" data-aos="fade-in" data-aos-duration="1000">
    <div class="absolute -left-10 top-16 w-[400px] h-[400px] bg-[#C9C9C9] opacity-80 pointer-events-none"></div>
    <div class="absolute left-[12%] top-48 w-[400px] h-[400px] bg-[#A3A3A3] opacity-80 rotate-12 pointer-events-none"></div>
    <div class="absolute left-[3%] -bottom-12 w-[420px] h-[420px] bg-[#E4E4E4] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <!-- Kiri: Headline & CTA -->
        <div class="lg:col-span-5 space-y-6" data-aos="fade-right" data-aos-delay="200">
          <p class="text-base font-bold text-gray-600">
            Selamat datang, di <span class="text-red-700 font-extrabold">SMK TELKOM SIDOARJO!</span>
          </p>
          <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-[1.15] tracking-tight">
            Sekolah Tangguh, <br />
            Berakhlak, <br />
            <span class="text-red-700">&amp; Berwawasan Digital</span>
          </h1>
          <div class="pt-4 flex items-center gap-4">
            <span class="text-base font-semibold text-gray-800">Udah siap Bergabung?</span>
            <button onclick="openPpdbModal()" class="px-8 py-3.5 text-base font-bold text-white bg-red-700 hover:bg-red-800 rounded-full shadow-md hover:shadow-lg transition cursor-pointer">
              Daftar ke skomda!
            </button>
          </div>
        </div>

        <!-- Kanan: Grid 2x2 foto -->
        <div class="lg:col-span-7 relative flex justify-center items-center py-8" data-aos="zoom-in" data-aos-delay="400">
          <img src="{{ asset('images/home/hero-grid.webp') }}" alt="Kolase SMK Telkom Sidoarjo" class="w-full max-w-[600px] h-auto select-none" loading="eager" decoding="async" fetchpriority="high" width="733" height="711">
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== 3. SAMBUTAN KEPALA SEKOLAH ==================== -->
  <section id="sambutan" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none overflow-hidden">
      <svg class="w-[1700px] h-[760px] -rotate-6 opacity-80" viewBox="0 0 1700 760" fill="none">
        <ellipse cx="500" cy="380" rx="300" ry="250" stroke="#9CA3AF" stroke-width="1.5" stroke-dasharray="8 8"/>
        <ellipse cx="500" cy="380" rx="430" ry="330" stroke="#9CA3AF" stroke-width="1.5" stroke-dasharray="8 8"/>
        <ellipse cx="500" cy="380" rx="560" ry="410" stroke="#9CA3AF" stroke-width="1.5" stroke-dasharray="8 8"/>
        <ellipse cx="500" cy="380" rx="690" ry="490" stroke="#9CA3AF" stroke-width="1.5" stroke-dasharray="8 8"/>
        <ellipse cx="500" cy="380" rx="820" ry="570" stroke="#9CA3AF" stroke-width="1.5" stroke-dasharray="8 8"/>
      </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <!-- Kiri: Foto Kepala Sekolah -->
        <div class="lg:col-span-5 flex justify-center" data-aos="fade-right">
          <div class="relative w-72 h-96">
            <div class="absolute -left-6 right-[-30%] bottom-6 h-56 bg-red-700 rounded-full"></div>
            <img src="{{ asset('images/profileguru/pabror.webp') }}" alt="Kepala Sekolah - Abror S.Hum M.Pd" class="relative z-10 w-full h-full object-cover rounded-t-full rounded-b-3xl shadow-xl" loading="eager" decoding="async" fetchpriority="high" width="301" height="380">
          </div>
        </div>

        <!-- Kanan: Sambutan -->
        <div class="lg:col-span-7 space-y-5 text-center" data-aos="fade-left">
          <span class="text-sm uppercase tracking-widest text-gray-500 font-bold block">Sambutan</span>
          <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">
            Kepala sekolah <br /><span class="text-red-700">SMK TELKOM SIDOARJO</span>
          </h2>
          <p class="text-base text-gray-700 leading-relaxed max-w-2xl mx-auto">
            Selamat datang di website resmi SMK Telkom Sidoarjo. Sebagai institusi pendidikan vokasi yang berfokus pada bidang teknologi dan informatika, kami berkomitmen mencetak generasi yang tidak hanya unggul dalam kompetensi, tetapi juga berkarakter dan siap menghadapi tantangan era digital. Semoga kehadiran website ini menjadi jendela informasi yang bermanfaat bagi seluruh masyarakat.
          </p>
          <div class="pt-4">
            <p class="font-extrabold text-gray-900 text-base"><span class="text-red-700">•</span> Abror S.hum M.pd</p>
            <span class="text-xs text-gray-500 font-medium">Kepala SMK Telkom Sidoarjo</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== 4. KENAPA HARUS PILIH SKOMDA? ==================== -->
  <section id="keunggulan" class="py-24 bg-[#F4F5F7]">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 xl:gap-28 items-center">

        <!-- Kiri: 6 Kartu Dashed (Muncul bertahap dengan stagger delay) -->
        <div class="lg:col-span-7">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="bg-red-700 text-white p-8 rounded-2xl shadow-md relative flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
              <div class="flex items-start justify-between">
                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center text-white">
                  <i data-lucide="cpu" class="w-5 h-5"></i>
                </div>
                <i data-lucide="arrow-up-right" class="w-5 h-5 text-white/80"></i>
              </div>
              <div class="mt-8">
                <h3 class="text-xl font-extrabold">Program Digitalent</h3>
                <p class="text-sm text-red-50 leading-relaxed mt-2">Pembekalan skill digital yang sesuai kebutuhan industri dan startup.</p>
              </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-dashed border-gray-300 shadow-sm flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
              <div class="w-12 h-12 rounded-xl bg-red-50 text-red-700 flex items-center justify-center">
                <i data-lucide="award" class="w-5 h-5"></i>
              </div>
              <div class="mt-8">
                <h3 class="text-xl font-extrabold text-gray-900">Akreditasi A – Unggul</h3>
                <p class="text-sm text-gray-600 leading-relaxed mt-2">Diakui secara nasional dengan standar kualitas terbaik oleh BAN-S/M.</p>
              </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-dashed border-gray-300 shadow-sm flex flex-col justify-between" data-aos="fade-up" data-aos-delay="300">
              <div class="w-12 h-12 rounded-xl bg-red-50 text-red-700 flex items-center justify-center">
                <i data-lucide="network" class="w-5 h-5"></i>
              </div>
              <div class="mt-8">
                <h3 class="text-xl font-extrabold text-gray-900">Yayasan Pendidikan Telkom</h3>
                <p class="text-sm text-gray-600 leading-relaxed mt-2">Bagian dari grup pendidikan terpercaya di bawah naungan Telkom Indonesia.</p>
              </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-dashed border-gray-300 shadow-sm flex flex-col justify-between" data-aos="fade-up" data-aos-delay="400">
              <div class="w-12 h-12 rounded-xl bg-red-50 text-red-700 flex items-center justify-center">
                <i data-lucide="monitor" class="w-5 h-5"></i>
              </div>
              <div class="mt-8">
                <h3 class="text-xl font-extrabold text-gray-900">School of Digital Era</h3>
                <p class="text-sm text-gray-600 leading-relaxed mt-2">Fokus pada kurikulum digital dan keterampilan teknologi masa depan.</p>
              </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-dashed border-gray-300 shadow-sm flex flex-col justify-between" data-aos="fade-up" data-aos-delay="500">
              <div class="w-12 h-12 rounded-xl bg-red-50 text-red-700 flex items-center justify-center">
                <i data-lucide="shield-check" class="w-5 h-5"></i>
              </div>
              <div class="mt-8">
                <h3 class="text-xl font-extrabold text-gray-900">ISO 21001:2018</h3>
                <p class="text-sm text-gray-600 leading-relaxed mt-2">Telah menerapkan standar manajemen pendidikan internasional.</p>
              </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-dashed border-gray-300 shadow-sm flex flex-col justify-between" data-aos="fade-up" data-aos-delay="600">
              <div class="w-12 h-12 rounded-xl bg-red-50 text-red-700 flex items-center justify-center">
                <i data-lucide="link" class="w-5 h-5"></i>
              </div>
              <div class="mt-8">
                <h3 class="text-xl font-extrabold text-gray-900">Program OPES</h3>
                <p class="text-sm text-gray-600 leading-relaxed mt-2">Jalur pendidikan berkelanjutan dari SMK hingga perguruan tinggi Telkom.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Kanan: Judul + Foto Siswi -->
        <div class="lg:col-span-5 flex flex-col items-center lg:items-start w-full" data-aos="zoom-in" data-aos-delay="300">
          <div class="w-full max-w-md">
            <h2 class="text-4xl lg:text-5xl font-extrabold text-slate-900 leading-tight mb-10 text-center lg:text-left">
              Kenapa harus pilih <br /><span class="text-red-700">Skomda?</span>
            </h2>
            
            <div class="relative w-72 h-72 md:w-80 md:h-80 lg:w-96 lg:h-96 mx-auto lg:mx-0 flex items-center justify-center -translate-y-2 -translate-x-4">
              <div class="absolute -inset-4 rounded-full border-2 border-dashed border-gray-300 pointer-events-none"></div>
              <img src="{{ asset('images/home/tifany.webp') }}" alt="Tifany Skomda" class="relative z-10 w-full h-full object-cover rounded-full border-4 border-white shadow-2xl" loading="lazy" decoding="async" width="392" height="425">
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ==================== 5. PROGRAM KEAHLIAN ==================== -->
  <section id="jurusan" class="py-24 bg-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-extrabold text-slate-900">Program Keahlian</h2>
        <p class="text-red-700 text-xl font-bold mt-1">di SMK TELKOM SIDOARJO</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        <!-- Kiri: SIJA -->
        <div class="lg:col-span-4 space-y-5" data-aos="fade-right">
          <h3 class="text-3xl font-extrabold leading-tight text-center lg:text-right">
            <span class="text-red-700 underline decoration-2 underline-offset-4">Sistem Informasi</span><br />
            <span class="text-slate-900">Jaringan Aplikasi</span>
          </h3>
          <p class="text-base text-gray-700 leading-relaxed text-center lg:text-right">
            Belajar merancang dan mengembangkan aplikasi, website, yang digunakan di industri.
          </p>
          <div class="space-y-3">
            <p class="text-base font-bold text-gray-900 text-center lg:text-right">Cocok untuk:</p>
            <div class="flex items-center justify-between gap-3">
              <span class="text-base text-gray-700 text-right flex-1">Suka coding &amp; membuat aplikasi</span>
              <span class="w-7 h-7 rounded-lg bg-red-100 text-red-700 flex items-center justify-center shrink-0"><i data-lucide="check" class="w-4 h-4"></i></span>
            </div>
            <div class="flex items-center justify-between gap-3">
              <span class="text-base text-gray-700 text-right flex-1">Senang berpikir logis dan memecahkan masalah.</span>
              <span class="w-7 h-7 rounded-lg bg-red-100 text-red-700 flex items-center justify-center shrink-0"><i data-lucide="check" class="w-4 h-4"></i></span>
            </div>
          </div>
          <div class="text-center lg:text-right">
            <p class="text-base font-bold text-gray-900">Prospek Kerja:</p>
            <p class="text-base text-gray-700 mt-1">Software Engineer • Web Developer • UI/UX Designer</p>
          </div>
        </div>

        <!-- Tengah: Foto arch -->
        <div class="lg:col-span-4 flex flex-col items-center" data-aos="zoom-in">
          <div class="relative w-full max-w-[280px] aspect-[3/4]">
            <img src="{{ asset('images/home/program.webp') }}" alt="Siswa Skomda" class="relative z-10 w-full h-full object-cover rounded-t-[130px] rounded-b-[48px] shadow-xl border-4 border-white" loading="lazy" decoding="async" width="359" height="498">
          </div>
          <button onclick="openProgramDetail('SIJA')"
            class="mt-8 px-8 py-3 bg-red-700 text-white rounded-full text-sm font-bold shadow-md hover:bg-red-800 transition flex items-center gap-2 cursor-pointer">
            <span>Lihat Lengkapnya</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
          </button>
        </div>

        <!-- Kanan: TJAT -->
        <div class="lg:col-span-4 space-y-5" data-aos="fade-left">
          <h3 class="text-3xl font-extrabold leading-tight text-center lg:text-left">
            <span class="text-red-700 underline decoration-2 underline-offset-4">Teknik Jaringan</span><br />
            <span class="text-slate-900">Akses Telekomunikasi</span>
          </h3>
          <p class="text-base text-gray-700 leading-relaxed text-center lg:text-left">
            Belajar membangun jaringan komputer, infrastruktur telekomunikasi modern.
          </p>
          <div class="space-y-3">
            <p class="text-base font-bold text-gray-900 text-center lg:text-left">Cocok untuk:</p>
            <div class="flex items-center justify-between gap-3">
              <span class="w-7 h-7 rounded-lg bg-red-100 text-red-700 flex items-center justify-center shrink-0"><i data-lucide="check" class="w-4 h-4"></i></span>
              <span class="text-base text-gray-700 flex-1">Tertarik jaringan &amp; internet</span>
            </div>
            <div class="flex items-center justify-between gap-3">
              <span class="w-7 h-7 rounded-lg bg-red-100 text-red-700 flex items-center justify-center shrink-0"><i data-lucide="check" class="w-4 h-4"></i></span>
              <span class="text-base text-gray-700 flex-1">Suka praktik perangkat jaringan</span>
            </div>
          </div>
          <div class="text-center lg:text-left">
            <p class="text-base font-bold text-gray-900">Prospek Kerja:</p>
            <p class="text-base text-gray-700 mt-1">Network Engineer • IT Support • Fiber Optic Technician</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== 7. 10 PARTNER INDUSTRI ==================== -->
  <section id="partner" class="py-16 bg-[#F4F5F7] overflow-hidden" data-aos="fade-in">
    <div class="max-w-7xl mx-auto px-4 mb-10 text-center">
      <h3 class="text-3xl font-black text-slate-900 tracking-tight">10+ Partner Industri</h3>
    </div>

    <div class="relative w-full overflow-hidden flex items-center py-2 select-none">
      <div class="animate-marquee flex items-center gap-6 shrink-0">
        @php
          $partners = [
            ['name' => 'Axelbit', 'file' => 'axelbit.webp'],
            ['name' => 'DigiPrener', 'file' => 'digi.webp'],
            ['name' => 'Global Infra', 'file' => 'gi.webp'],
            ['name' => 'Garuda Telkom', 'file' => 'gt.webp'],
            ['name' => 'Jagoan Hosting', 'file' => 'jagoanhosting.webp'],
            ['name' => 'Javacreatiox', 'file' => 'javacreat.webp'],
            ['name' => 'Markaz Design', 'file' => 'markaz.webp'],
            ['name' => 'Radnet', 'file' => 'radnext.webp'],
            ['name' => 'Weza Group', 'file' => 'weza.webp'],
            ['name' => 'Wowrack', 'file' => 'wowrack.webp'],
          ];
        @endphp

        @foreach($partners as $p)
          <div class="flex flex-col items-center justify-center px-6 py-4 rounded-2xl border-2 border-dashed border-gray-300 bg-white w-[200px] h-[100px] shrink-0 shadow-sm hover:border-red-700 transition-colors">
            <img src="{{ asset('images/mitra/' . $p['file']) }}" alt="{{ $p['name'] }}" class="max-h-12 max-w-[140px] object-contain" loading="lazy" decoding="async">
          </div>
        @endforeach

        @foreach($partners as $p)
          <div class="flex flex-col items-center justify-center px-6 py-4 rounded-2xl border-2 border-dashed border-gray-300 bg-white w-[200px] h-[100px] shrink-0 shadow-sm hover:border-red-700 transition-all">
            <img src="{{ asset('images/mitra/' . $p['file']) }}" alt="{{ $p['name'] }}" class="max-h-12 max-w-[140px] object-contain" loading="lazy" decoding="async">
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ==================== 8. BERITA & INFORMASI TERKINI ==================== -->
  <section id="berita" class="py-24 bg-[#F4F5F7]" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Berita &amp; Informasi Terkini</h2>
        <h3 class="text-xl font-black text-red-700 tracking-wide mt-1">SMK TELKOM SIDOARJO</h3>
      </div>

      <div class="flex items-center justify-center flex-wrap gap-2 mb-12">
        <span class="text-sm font-bold text-gray-800 mr-2">Kategori Berita:</span>
        <button onclick="filterNews('Semua', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-bold bg-red-700 text-white transition cursor-pointer">Semua</button>
        <button onclick="filterNews('Kegiatan Sekolah', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition cursor-pointer">Kegiatan Sekolah</button>
        <button onclick="filterNews('Prestasi', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition cursor-pointer">Prestasi</button>
        <button onclick="filterNews('Karya & Inovasi', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition cursor-pointer">Karya &amp; Inovasi</button>
        <button onclick="filterNews('Kemitraan & Kerjasama', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition cursor-pointer">Kemitraan &amp; Kerjasama</button>
        <button onclick="filterNews('Alumni', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition cursor-pointer">Alumni</button>
        <button onclick="filterNews('Artikel Edukasi', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition cursor-pointer">Artikel Edukasi</button>
      </div>

      <div>
        <div class="overflow-hidden py-4">
          <div id="homeNewsTrack" class="flex transition-transform duration-500 ease-out gap-8">
            <div class="w-full md:w-[calc(33.333%-1.33rem)] shrink-0 news-slide-card" data-cat="Kegiatan Sekolah">
              <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full group border border-gray-100">
                <div class="relative aspect-video overflow-hidden bg-gray-100">
                  <img src="{{ asset('images/home/berita.webp') }}" alt="Berita 1" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy" decoding="async" width="307" height="138">
                  <div class="absolute top-3 left-3 flex gap-1.5">
                    <span class="px-2.5 py-1 bg-red-700 text-white font-black text-[10px] rounded-md">SIJA</span>
                    <span class="px-2.5 py-1 bg-red-700 text-white font-black text-[10px] rounded-md">TJAT</span>
                  </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                  <div class="space-y-2">
                    <h3 class="font-extrabold text-slate-900 text-lg leading-snug group-hover:text-red-700 transition cursor-pointer">Kunjungan Industri Siswa Skomda ke Data Center Nasional Telkom Group</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Ratusan siswa kelas XI SMK Telkom Sidoarjo meninjau secara langsung teknologi data center tier 3 berstandar internasional di Surabaya.</p>
                  </div>
                  <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs font-bold text-red-700">Kegiatan Sekolah</span>
                    <span class="text-xs text-gray-400 flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i>2026-06-07</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full md:w-[calc(33.333%-1.33rem)] shrink-0 news-slide-card" data-cat="Prestasi">
              <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full group border border-gray-100">
                <div class="relative aspect-video overflow-hidden bg-gray-100">
                  <img src="{{ asset('images/home/berita.webp') }}" alt="Berita 2" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy" decoding="async" width="307" height="138">
                  <div class="absolute top-3 left-3 flex gap-1.5">
                    <span class="px-2.5 py-1 bg-red-700 text-white font-black text-[10px] rounded-md">SIJA</span>
                  </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                  <div class="space-y-2">
                    <h3 class="font-extrabold text-slate-900 text-lg leading-snug group-hover:text-red-700 transition cursor-pointer">Juara 1 Lomba Web Design Tingkat Provinsi Jawa Timur 2026</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Tim perwakilan SIJA Skomda kembali membuktikan keunggulannya dengan menyabet medali emas dalam ajang Lomba Keterampilan Siswa (LKS).</p>
                  </div>
                  <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs font-bold text-red-700">Prestasi</span>
                    <span class="text-xs text-gray-400 flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i>2026-06-05</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full md:w-[calc(33.333%-1.33rem)] shrink-0 news-slide-card" data-cat="Kemitraan & Kerjasama">
              <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full group border border-gray-100">
                <div class="relative aspect-video overflow-hidden bg-gray-100">
                  <img src="{{ asset('images/home/berita.webp') }}" alt="Berita 3" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy" decoding="async" width="307" height="138">
                  <div class="absolute top-3 left-3 flex gap-1.5">
                    <span class="px-2.5 py-1 bg-red-700 text-white font-black text-[10px] rounded-md">TJAT</span>
                  </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                  <div class="space-y-2">
                    <h3 class="font-extrabold text-slate-900 text-lg leading-snug group-hover:text-red-700 transition cursor-pointer">Penandatanganan MoU Kelas Industri Bersama Mitra Telekomunikasi</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Kerjasama strategis ini membuka jalur magang prioritas dan rekrutmen kerja langsung sebelum kelulusan bagi siswa jurusan TJAT.</p>
                  </div>
                  <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs font-bold text-red-700">Kemitraan &amp; Kerjasama</span>
                    <span class="text-xs text-gray-400 flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i>2026-06-01</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full md:w-[calc(33.333%-1.33rem)] shrink-0 news-slide-card" data-cat="Karya & Inovasi">
              <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full group border border-gray-100">
                <div class="relative aspect-video overflow-hidden bg-gray-100">
                  <img src="{{ asset('images/home/berita.webp') }}" alt="Berita 4" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy" decoding="async" width="307" height="138">
                  <div class="absolute top-3 left-3 flex gap-1.5">
                    <span class="px-2.5 py-1 bg-red-700 text-white font-black text-[10px] rounded-md">SIJA</span>
                  </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                  <div class="space-y-2">
                    <h3 class="font-extrabold text-slate-900 text-lg leading-snug group-hover:text-red-700 transition cursor-pointer">Siswa Skomda Ciptakan Prototipe Smart Agriculture Berbasis IoT</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Inovasi alat penyiram tanaman otomatis berbasis sensor kelembapan tanah yang dikontrol langsung via smartphone.</p>
                  </div>
                  <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs font-bold text-red-700">Karya &amp; Inovasi</span>
                    <span class="text-xs text-gray-400 flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i>2026-05-20</span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Carousel Navigation (Panah & Dots) -->
      <div class="flex items-center justify-center gap-6 mt-12">
        <button onclick="moveNewsSlide(-1)" aria-label="Previous News"
          class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
          <i data-lucide="chevron-left" class="w-5 h-5"></i>
        </button>

        <div id="homeNewsDots" class="flex items-center justify-center gap-2">
          <span class="h-2 w-6 rounded-full bg-red-700 transition-all cursor-pointer" onclick="setNewsSlide(0)"></span>
          <span class="h-2 w-2 rounded-full bg-gray-300 hover:bg-gray-400 transition-all cursor-pointer" onclick="setNewsSlide(1)"></span>
        </div>

        <button onclick="moveNewsSlide(1)" aria-label="Next News"
          class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center hover:bg-red-800 transition shadow-md active:scale-95 cursor-pointer">
          <i data-lucide="chevron-right" class="w-5 h-5"></i>
        </button>
      </div>
    </div>
  </section>

@endsection

@push('scripts')
<script>
    let currentNewsSlide = 0;
    const totalNewsSlides = 2;

    function moveNewsSlide(direction) {
        currentNewsSlide = (currentNewsSlide + direction + totalNewsSlides) % totalNewsSlides;
        updateNewsSlider();
    }

    function setNewsSlide(index) {
        currentNewsSlide = index;
        updateNewsSlider();
    }

    function updateNewsSlider() {
        const track = document.getElementById('homeNewsTrack');
        if (!track) return;
        
        const offset = -currentNewsSlide * 100;
        track.style.transform = `translateX(${offset}%)`;

        const dots = document.querySelectorAll('#homeNewsDots span');
        dots.forEach((dot, idx) => {
            if (idx === currentNewsSlide) {
                dot.classList.remove('w-2', 'bg-gray-300');
                dot.classList.add('w-6', 'bg-red-700');
            } else {
                dot.classList.remove('w-6', 'bg-red-700');
                dot.classList.add('w-2', 'bg-gray-300');
            }
        });
    }

    function filterNews(category, btnElement) {
        const tabs = document.querySelectorAll('.news-tab');
        tabs.forEach(tab => {
            tab.classList.remove('bg-red-700', 'text-white', 'font-bold');
            tab.classList.add('bg-white', 'border', 'border-gray-200', 'text-gray-600', 'font-semibold');
        });
        btnElement.classList.remove('bg-white', 'border', 'border-gray-200', 'text-gray-600', 'font-semibold');
        btnElement.classList.add('bg-red-700', 'text-white', 'font-bold');

        const cards = document.querySelectorAll('.news-slide-card');
        cards.forEach(card => {
            const cat = card.getAttribute('data-cat');
            if (category === 'Semua' || cat === category) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endpush