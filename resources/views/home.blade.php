@extends('layouts.app')

@section('title', 'SMK Telkom Sidoarjo - Homepage')

@section('content')
<!-- ==================== 2. HERO SECTION (sesuai Figma: bg abu muda, arc dashed, stat card nempel di grid foto) ==================== -->
  <section id="beranda" class="pt-32 pb-24 bg-[#F0F0F0] relative overflow-hidden">
    <!-- Dekorasi background ala Figma -->
    <div class="absolute -left-10 top-16 w-[400px] h-[400px] bg-[#C9C9C9] opacity-80 pointer-events-none"></div>
    <div class="absolute left-[12%] top-48 w-[400px] h-[400px] bg-[#A3A3A3] opacity-80 rotate-12 pointer-events-none"></div>
    <div class="absolute left-[3%] -bottom-12 w-[420px] h-[420px] bg-[#E4E4E4] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <!-- Kiri: Headline & CTA -->
        <div class="lg:col-span-5 space-y-6">
          <p class="text-base font-bold text-gray-600">
            Selamat datang, di <span class="text-telkom-700 font-extrabold">SMK TELKOM SIDOARJO!</span>
          </p>
          <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-[1.15] tracking-tight">
            Sekolah Tangguh, <br />
            Berakhlak, <br />
            <span class="text-telkom-700">&amp; Berwawasan Digital</span>
          </h1>
          <div class="pt-4 flex items-center gap-4">
            <span class="text-base font-semibold text-gray-800">Udah siap Bergabung?</span>
            <button onclick="openPpdbModal()" class="px-8 py-3.5 text-base font-bold text-white bg-telkom-700 hover:bg-telkom-800 rounded-full shadow-md hover:shadow-lg transition">
              Daftar ke skomda!
            </button>
          </div>
        </div>

        <!-- Kanan: Grid 2x2 foto + 4 stat card nempel (sesuai Figma) -->
        <div class="lg:col-span-7 relative flex justify-center items-center py-8">
          <img src={{ asset('images/home/hero-grid.png') }} alt="Kolase SMK Telkom Sidoarjo"
            class="w-full max-w-[600px] h-auto select-none" />
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== 3. SAMBUTAN KEPALA SEKOLAH (sesuai Figma: teks rata tengah, bullet nama) ==================== -->
  <section id="sambutan" class="py-24 bg-white relative overflow-hidden">
    <!-- Ellipse dashed miring membentang penuh ala Figma -->
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
        <!-- Kiri: Foto kepala sekolah arch + bentuk merah -->
        <div class="lg:col-span-5 flex justify-center">
          <div class="relative w-72 h-96">
            <div class="absolute -left-6 right-[-30%] bottom-6 h-56 bg-telkom-700 rounded-full"></div>
            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&auto=format&fit=crop&q=80" alt="Kepala Sekolah"
              class="relative z-10 w-full h-full object-cover rounded-t-full rounded-b-3xl shadow-xl" />
          </div>
        </div>

        <!-- Kanan: Sambutan, teks rata tengah sesuai Figma -->
        <div class="lg:col-span-7 space-y-5 text-center">
          <span class="text-sm uppercase tracking-widest text-gray-500 font-bold block">Sambutan</span>
          <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">
            Kepala sekolah <br /><span class="text-telkom-700">SMK TELKOM SIDOARJO</span>
          </h2>
          <p class="text-base text-gray-700 leading-relaxed max-w-2xl mx-auto">
            Selamat datang di website resmi SMK Telkom Sidoarjo. Sebagai institusi pendidikan vokasi yang berfokus pada bidang teknologi dan informatika, kami berkomitmen mencetak generasi yang tidak hanya unggul dalam kompetensi, tetapi juga berkarakter dan siap menghadapi tantangan era digital. Semoga kehadiran website ini menjadi jendela informasi yang bermanfaat bagi seluruh masyarakat.
          </p>
          <div class="pt-4">
            <p class="font-extrabold text-gray-900 text-base"><span class="text-telkom-700">•</span> Abror S.hum M.pd</p>
            <span class="text-xs text-gray-500 font-medium">Kepala SMK Telkom Sidoarjo</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== 4. KENAPA HARUS PILIH SKOMDA? (sesuai Figma: bg abu, kartu dashed, judul kanan atas) ==================== -->
  <section id="keunggulan" class="py-24 bg-[#F4F5F7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

        <!-- Kiri: 6 kartu dashed 2x3 (copy persis Figma) -->
        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Card 1: Digitalent (merah solid + panah) -->
          <div class="bg-telkom-700 text-white p-8 rounded-2xl shadow-md relative">
            <div class="flex items-start justify-between">
              <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center text-white">
                <i data-lucide="cpu" class="w-5 h-5"></i>
              </div>
              <i data-lucide="arrow-up-right" class="w-5 h-5 text-white/80"></i>
            </div>
            <h3 class="text-xl font-extrabold mt-6">Program Digitalent</h3>
            <p class="text-base text-red-50 leading-relaxed mt-2">Pembekalan skill digital yang sesuai kebutuhan industri dan startup.</p>
          </div>

          <!-- Card 2 -->
          <div class="bg-white p-8 rounded-2xl border-2 border-dashed border-gray-300 space-y-0">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-telkom-700 flex items-center justify-center">
              <i data-lucide="award" class="w-5 h-5"></i>
            </div>
            <h3 class="text-xl font-extrabold text-gray-900 mt-6">Akreditasi A – Unggul</h3>
            <p class="text-base text-gray-700 leading-relaxed mt-2">Diakui secara nasional dengan standar kualitas terbaik oleh BAN-S/M.</p>
          </div>

          <!-- Card 3 -->
          <div class="bg-white p-8 rounded-2xl border-2 border-dashed border-gray-300">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-telkom-700 flex items-center justify-center">
              <i data-lucide="network" class="w-5 h-5"></i>
            </div>
            <h3 class="text-xl font-extrabold text-gray-900 mt-6">Yayasan Pendidikan Telkom</h3>
            <p class="text-base text-gray-700 leading-relaxed mt-2">Bagian dari grup pendidikan terpercaya di bawah naungan Telkom Indonesia.</p>
          </div>

          <!-- Card 4 -->
          <div class="bg-white p-8 rounded-2xl border-2 border-dashed border-gray-300">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-telkom-700 flex items-center justify-center">
              <i data-lucide="monitor" class="w-5 h-5"></i>
            </div>
            <h3 class="text-xl font-extrabold text-gray-900 mt-6">School of Digital Era</h3>
            <p class="text-base text-gray-700 leading-relaxed mt-2">Fokus pada kurikulum digital dan keterampilan teknologi masa depan.</p>
          </div>

          <!-- Card 5 -->
          <div class="bg-white p-8 rounded-2xl border-2 border-dashed border-gray-300">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-telkom-700 flex items-center justify-center">
              <i data-lucide="shield-check" class="w-5 h-5"></i>
            </div>
            <h3 class="text-xl font-extrabold text-gray-900 mt-6">ISO 21001:2018</h3>
            <p class="text-base text-gray-700 leading-relaxed mt-2">Telah menerapkan standar manajemen pendidikan internasional.</p>
          </div>

          <!-- Card 6 -->
          <div class="bg-white p-8 rounded-2xl border-2 border-dashed border-gray-300">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-telkom-700 flex items-center justify-center">
              <i data-lucide="link" class="w-5 h-5"></i>
            </div>
            <h3 class="text-xl font-extrabold text-gray-900 mt-6">Program OPES</h3>
            <p class="text-base text-gray-700 leading-relaxed mt-2">Jalur pendidikan berkelanjutan dari SMK hingga perguruan tinggi Telkom.</p>
          </div>
        </div>

        <!-- Kanan: Judul + foto siswa lingkaran merah + ring dashed (sesuai Figma) -->
        <div class="lg:col-span-5 flex flex-col items-center lg:items-start">
          <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
            Kenapa harus pilih <span class="text-telkom-700">Skomda?</span>
          </h2>
          <div class="relative w-72 h-72 sm:w-80 sm:h-80 mt-10">
            <div class="absolute -inset-4 rounded-full border-2 border-dashed border-gray-300"></div>
            <div class="absolute inset-0 bg-telkom-700 rounded-full"></div>
            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=600&auto=format&fit=crop&q=80" alt="Siswi Skomda"
              class="relative z-10 w-full h-full object-cover rounded-full border-4 border-white shadow-xl" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== 5. PROGRAM KEAHLIAN (sesuai Figma: TANPA card abu, checklist pink di sisi luar, tombol Lihat Lengkapnya) ==================== -->
  <section id="jurusan" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-extrabold text-slate-900">Program Keahlian</h2>
        <p class="text-telkom-700 text-xl font-bold mt-1">di SMK TELKOM SIDOARJO</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        <!-- Kiri: SIJA — checklist di kanan (sisir luar) -->
        <div class="lg:col-span-4 space-y-5">
          <h3 class="text-3xl font-extrabold leading-tight text-center lg:text-right">
            <span class="text-telkom-700 underline decoration-2 underline-offset-4">Sistem Informasi</span><br />
            <span class="text-slate-900">Jaringan Aplikasi</span>
          </h3>
          <p class="text-base text-gray-700 leading-relaxed text-center lg:text-right">
            Belajar merancang dan mengembangkan aplikasi, website, yang digunakan di industri.
          </p>
          <div class="space-y-3">
            <p class="text-base font-bold text-gray-900 text-center lg:text-right">Cocok untuk:</p>
            <div class="flex items-center justify-between gap-3">
              <span class="text-base text-gray-700 text-right flex-1">Suka coding &amp; membuat aplikasi</span>
              <span class="w-7 h-7 rounded-lg bg-red-100 text-telkom-700 flex items-center justify-center shrink-0"><i data-lucide="check" class="w-4 h-4"></i></span>
            </div>
            <div class="flex items-center justify-between gap-3">
              <span class="text-base text-gray-700 text-right flex-1">Senang berpikir logis dan memecahkan masalah.</span>
              <span class="w-7 h-7 rounded-lg bg-red-100 text-telkom-700 flex items-center justify-center shrink-0"><i data-lucide="check" class="w-4 h-4"></i></span>
            </div>
          </div>
          <div class="text-center lg:text-right">
            <p class="text-base font-bold text-gray-900">Prospek Kerja:</p>
            <p class="text-base text-gray-700 mt-1">Software Engineer • Web Developer • UI/UX Designer</p>
          </div>
        </div>

        <!-- Tengah: Foto arch + blob merah + tombol Lihat Lengkapnya -->
        <div class="lg:col-span-4 flex flex-col items-center">
          <div class="relative w-full max-w-[280px] aspect-[3/4]">
            <div class="absolute inset-0 bg-telkom-700 rounded-t-[130px] rounded-b-[48px]"></div>
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&auto=format&fit=crop&q=80" alt="Siswa Skomda"
              class="relative z-10 w-full h-full object-cover rounded-t-[130px] rounded-b-[48px] shadow-xl border-4 border-white" />
          </div>
          <button onclick="openProgramDetail('SIJA')"
            class="mt-8 px-8 py-3 bg-telkom-700 text-white rounded-full text-sm font-bold shadow-md hover:bg-telkom-800 transition flex items-center gap-2">
            <span>Lihat Lengkapnya</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
          </button>
        </div>

        <!-- Kanan: TJAT — checklist di kiri (sisir luar) -->
        <div class="lg:col-span-4 space-y-5">
          <h3 class="text-3xl font-extrabold leading-tight text-center lg:text-left">
            <span class="text-telkom-700 underline decoration-2 underline-offset-4">Teknik Jaringan</span><br />
            <span class="text-slate-900">Akses Telekomunikasi</span>
          </h3>
          <p class="text-base text-gray-700 leading-relaxed text-center lg:text-left">
            Belajar membangun jaringan komputer, infrastruktur telekomunikasi modern.
          </p>
          <div class="space-y-3">
            <p class="text-base font-bold text-gray-900 text-center lg:text-left">Cocok untuk:</p>
            <div class="flex items-center justify-between gap-3">
              <span class="w-7 h-7 rounded-lg bg-red-100 text-telkom-700 flex items-center justify-center shrink-0"><i data-lucide="check" class="w-4 h-4"></i></span>
              <span class="text-base text-gray-700 flex-1">Tertarik jaringan &amp; internet</span>
            </div>
            <div class="flex items-center justify-between gap-3">
              <span class="w-7 h-7 rounded-lg bg-red-100 text-telkom-700 flex items-center justify-center shrink-0"><i data-lucide="check" class="w-4 h-4"></i></span>
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

  <!-- ==================== 6. APA KATA ALUMNI? (sesuai Figma: judul rata kiri, foto diamond, LinkedIn icon) ==================== -->
  <section id="alumni" class="py-24 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
      <!-- Judul rata kiri ala Figma -->
      <div class="mb-10">
        <div class="w-10 h-10 rounded-full bg-red-100 text-red-700 flex items-center justify-center mb-3">
          <i data-lucide="graduation-cap" class="w-5 h-5"></i>
        </div>
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
          Apa Kata <span class="text-telkom-700">Alumni?</span>
        </h2>
        <p class="text-sm text-gray-500 mt-2 font-medium">Lihat Perjalanan Para Alumni Berprestasi Setelah Lulus</p>
      </div>

      <!-- Card dashed dengan foto diamond -->
      <div class="bg-white rounded-3xl border-2 border-dashed border-gray-300 p-8 sm:p-12 shadow-sm relative">
        <button onclick="prevAlumni()" aria-label="Previous"
          class="absolute -left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-700 transition z-20">
          <i data-lucide="chevron-left" class="w-4 h-4"></i>
        </button>
        <button onclick="nextAlumni()" aria-label="Next"
          class="absolute -right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-700 transition z-20">
          <i data-lucide="chevron-right" class="w-4 h-4"></i>
        </button>

        <div class="flex flex-col md:flex-row items-center gap-10">
          <!-- Foto diamond (rotasi 45°) + badge jurusan -->
          <div class="relative shrink-0">
            <div class="w-36 h-36 rotate-45 rounded-2xl bg-telkom-700 scale-90 shadow-md"></div>
            <div class="absolute inset-0 rotate-45 rounded-2xl overflow-hidden border-2 border-white shadow-md">
              <img id="alumni-img" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500&auto=format&fit=crop&q=80" alt="Alumni"
                class="w-full h-full object-cover -rotate-45 scale-[1.6]" />
            </div>
            <div id="alumni-badge" class="absolute -bottom-3 left-1/2 -translate-x-1/2 z-20 bg-slate-900 text-white font-extrabold text-[10px] px-3 py-0.5 rounded-full">SIJA</div>
          </div>

          <!-- Kutipan -->
          <div class="space-y-4 flex-1 text-center md:text-left">
            <div class="flex justify-center md:justify-start">
              <i data-lucide="quote" class="w-6 h-6 text-red-300"></i>
            </div>
            <p id="alumni-quote" class="text-lg text-gray-800 italic leading-relaxed">
              "Sekolah disini asyik banget, gabakal nyesel buat para orang tua yang nyari calon sekolah buat anaknya sih! Fasilitas lengkap dan gurunya suportif banget."
            </p>
            <div class="pt-3 border-t border-gray-100">
              <p class="text-base font-extrabold text-gray-900">
                <span id="alumni-name">— Aisyah Putri Ramadhani</span>
                <span class="text-telkom-700 font-bold"> • <span id="alumni-jurusan">SIJA</span></span>
              </p>
              <p id="alumni-role" class="text-sm text-gray-600 font-medium mt-1">Mahasiswi Teknik Informatika • Institut Teknologi Bandung (Lulus 2024)</p>
              <a id="alumni-linkedin" href="https://linkedin.com" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center gap-1.5 mt-3 text-gray-700 hover:text-red-700 transition">
                <i data-lucide="linkedin" class="w-4 h-4 text-slate-800"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Dots -->
      <div class="flex items-center justify-center gap-2 mt-8">
        <button onclick="setAlumniSlide(0)" id="dot-0" class="transition-all duration-300 rounded-full h-2 w-7 bg-red-700"></button>
        <button onclick="setAlumniSlide(1)" id="dot-1" class="transition-all duration-300 rounded-full h-2 w-2 bg-gray-300 hover:bg-gray-400"></button>
        <button onclick="setAlumniSlide(2)" id="dot-2" class="transition-all duration-300 rounded-full h-2 w-2 bg-gray-300 hover:bg-gray-400"></button>
      </div>
    </div>
  </section>

  <!-- ==================== 7. 13+ PARTNER INDUSTRI (sesuai Figma: kartu dashed, logo marquee) ==================== -->
  <section id="partner" class="py-16 bg-[#F4F5F7] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 mb-10 text-center">
      <h3 class="text-3xl font-black text-slate-900 tracking-tight">13+ Partner Industri</h3>
    </div>

    <div class="relative w-full overflow-hidden flex items-center py-2 select-none">
      <div class="animate-marquee flex items-center gap-6">
        <!-- Item (logo teks, kartu dashed ala Figma) -->
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-slate-800">JAVA CREATION</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-blue-600 normal-case">radnext</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-red-600 normal-case">markaz</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-slate-900">AXELBIT</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-red-700">GARUDA</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-red-600">TELKOM INDONESIA</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-red-700">TELKOM AKSES</span>
        </div>
        <!-- Duplikat marquee -->
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-slate-800">JAVA CREATION</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-blue-600 normal-case">radnext</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-red-600 normal-case">markaz</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-slate-900">AXELBIT</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-red-700">GARUDA</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-red-600">TELKOM INDONESIA</span>
        </div>
        <div class="flex flex-col items-center justify-center px-8 py-5 rounded-2xl border-2 border-dashed border-gray-300 bg-white min-w-[180px] min-h-[90px] shrink-0">
          <span class="font-black text-sm tracking-wide text-red-700">TELKOM AKSES</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== 8. BERITA & INFORMASI TERKINI (sesuai Figma: judul 2 baris, panah merah bulat, 6 dots) ==================== -->
  <section id="berita" class="py-24 bg-[#F4F5F7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Berita &amp; Informasi Terkini</h2>
        <h3 class="text-xl font-black text-telkom-700 tracking-wide mt-1">SMK TELKOM SIDOARJO</h3>
      </div>

      <!-- Kategori -->
      <div class="flex items-center justify-center flex-wrap gap-2 mb-12">
        <span class="text-sm font-bold text-gray-800 mr-2">Kategori Berita:</span>
        <button onclick="filterNewsCategory('Semua', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-bold bg-red-700 text-white transition">Semua</button>
        <button onclick="filterNewsCategory('Kegiatan Sekolah', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Kegiatan Sekolah</button>
        <button onclick="filterNewsCategory('Prestasi', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Prestasi</button>
        <button onclick="filterNewsCategory('Karya & Inovasi', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Karya &amp; Inovasi</button>
        <button onclick="filterNewsCategory('Kemitraan & Kerjasama', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Kemitraan &amp; Kerjasama</button>
        <button onclick="filterNewsCategory('Alumni', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Alumni</button>
        <button onclick="filterNewsCategory('Artikel Edukasi', this)" class="news-tab px-4 py-1.5 rounded-full text-sm font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Artikel Edukasi</button>
      </div>

      <!-- Carousel berita -->
      <div class="relative">
        <button onclick="scrollNewsGrid(-1)" aria-label="Previous News"
          class="absolute -left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-red-700 hover:bg-red-800 text-white shadow-lg flex items-center justify-center transition z-20">
          <i data-lucide="chevron-left" class="w-5 h-5"></i>
        </button>
        <button onclick="scrollNewsGrid(1)" aria-label="Next News"
          class="absolute -right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-red-700 hover:bg-red-800 text-white shadow-lg flex items-center justify-center transition z-20">
          <i data-lucide="chevron-right" class="w-5 h-5"></i>
        </button>

        <div id="news-grid-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Card 1 -->
          <article class="news-item-card bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group" data-cat="Kegiatan Sekolah">
            <div class="relative aspect-video overflow-hidden bg-gray-100">
              <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&auto=format&fit=crop&q=80" alt="Data Center" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
              <div class="absolute top-3 left-3 flex gap-1.5">
                <span class="px-2.5 py-1 bg-red-700 text-white font-black text-[10px] rounded-md">SIJA</span>
                <span class="px-2.5 py-1 bg-red-700 text-white font-black text-[10px] rounded-md">TJAT</span>
              </div>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
              <div class="space-y-2">
                <h3 onclick="openNewsDetail(0)" class="font-extrabold text-slate-900 text-lg leading-snug group-hover:text-red-700 transition cursor-pointer">Kunjungan Industri Siswa Skomda ke Data Center Nasional Telkom Group</h3>
                <p class="text-sm text-gray-600 leading-relaxed">Ratusan siswa kelas XI SMK Telkom Sidoarjo meninjau secara langsung teknologi data center tier 3 berstandar internasional di Surabaya.</p>
              </div>
              <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs font-bold text-red-700">Kegiatan Sekolah</span>
                <div class="flex items-center gap-3">
                  <span class="text-xs text-gray-500 flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i>2026-06-07</span>
                  <button onclick="openNewsDetail(0)" class="inline-flex items-center gap-1.5 text-xs font-bold text-red-700 hover:text-red-800 transition">Baca Selengkapnya <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i></button>
                </div>
              </div>
            </div>
          </article>

          <!-- Card 2 -->
          <article class="news-item-card bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group" data-cat="Prestasi">
            <div class="relative aspect-video overflow-hidden bg-gray-100">
              <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800&auto=format&fit=crop&q=80" alt="Juara Web Design" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
              <div class="absolute top-3 left-3 flex gap-1.5">
                <span class="px-2.5 py-1 bg-red-700 text-white font-black text-[10px] rounded-md">SIJA</span>
              </div>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
              <div class="space-y-2">
                <h3 onclick="openNewsDetail(1)" class="font-extrabold text-slate-900 text-lg leading-snug group-hover:text-red-700 transition cursor-pointer">Juara 1 Lomba Web Design Tingkat Provinsi Jawa Timur 2026</h3>
                <p class="text-sm text-gray-600 leading-relaxed">Tim perwakilan SIJA Skomda kembali membuktikan keunggulannya dengan menyabet medali emas dalam ajang Lomba Keterampilan Siswa (LKS).</p>
              </div>
              <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs font-bold text-red-700">Prestasi</span>
                <div class="flex items-center gap-3">
                  <span class="text-xs text-gray-500 flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i>2026-06-05</span>
                  <button onclick="openNewsDetail(1)" class="inline-flex items-center gap-1.5 text-xs font-bold text-red-700 hover:text-red-800 transition">Baca Selengkapnya <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i></button>
                </div>
              </div>
            </div>
          </article>

          <!-- Card 3 -->
          <article class="news-item-card bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group" data-cat="Kemitraan & Kerjasama">
            <div class="relative aspect-video overflow-hidden bg-gray-100">
              <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80" alt="MoU Mitra" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
              <div class="absolute top-3 left-3 flex gap-1.5">
                <span class="px-2.5 py-1 bg-red-700 text-white font-black text-[10px] rounded-md">TJAT</span>
              </div>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
              <div class="space-y-2">
                <h3 onclick="openNewsDetail(2)" class="font-extrabold text-red-700 text-base leading-snug hover:underline transition cursor-pointer">Penandatanganan MoU Kelas Industri Bersama Mitra Telekomunikasi</h3>
                <p class="text-sm text-gray-600 leading-relaxed">Kerjasama strategis ini membuka jalur magang prioritas dan rekrutmen kerja langsung sebelum kelulusan bagi siswa jurusan TJAT.</p>
              </div>
              <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs font-bold text-red-700">Kemitraan &amp; Kerjasama</span>
                <div class="flex items-center gap-3">
                  <span class="text-xs text-gray-500 flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i>2026-06-01</span>
                  <button onclick="openNewsDetail(2)" class="inline-flex items-center gap-1.5 text-xs font-bold text-red-700 hover:text-red-800 transition">Baca Selengkapnya <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i></button>
                </div>
              </div>
            </div>
          </article>
        </div>
      </div>

      <!-- 6 dots ala Figma -->
      <div class="flex items-center justify-center gap-2 mt-10">
        <span class="h-2 w-6 rounded-full bg-red-700"></span>
        <span class="h-2 w-2 rounded-full bg-gray-300"></span>
        <span class="h-2 w-2 rounded-full bg-gray-300"></span>
        <span class="h-2 w-2 rounded-full bg-gray-300"></span>
        <span class="h-2 w-2 rounded-full bg-gray-300"></span>
        <span class="h-2 w-2 rounded-full bg-gray-300"></span>
      </div>
    </div>
  </section>

  <!-- ==================== 9. FOOTER (sesuai Figma: 4 kolom + Career Center + statistik) ==================== -->
@endsection
