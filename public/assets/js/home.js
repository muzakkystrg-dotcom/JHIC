function initIcons() { if (window.lucide) lucide.createIcons(); }
    document.addEventListener("DOMContentLoaded", initIcons);
    window.addEventListener("load", initIcons);

    // ===== Data Alumni =====
    const alumniList = [
      {
        name: "Aisyah Putri Ramadhani", jurusan: "SIJA",
        role: "Mahasiswi Teknik Informatika • Institut Teknologi Bandung (Lulus 2024)",
        quote: "Sekolah disini asyik banget, gabakal nyesel buat para orang tua yang nyari calon sekolah buat anaknya sih! Fasilitas lengkap dan gurunya suportif banget.",
        photo: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500&auto=format&fit=crop&q=80",
        linkedin: "https://linkedin.com"
      },
      {
        name: "Rafi Pratama Hendrawan", jurusan: "TJAT",
        role: "Network Operations Specialist • PT Telkom Indonesia (Persero) Tbk (Lulus 2023)",
        quote: "Kurikulum praktikum di Skomda sangat relevan dengan kebutuhan industri telekomunikasi. Sertifikasi internasional yang didapat saat sekolah menjadi tiket emas diterima kerja sebelum wisuda.",
        photo: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&auto=format&fit=crop&q=80",
        linkedin: "https://linkedin.com"
      },
      {
        name: "Nabila Zahra Syahrani", jurusan: "SIJA",
        role: "Associate Frontend Engineer • GoTo Financial (Lulus 2022)",
        quote: "Di program Digitalent Skomda, kami diajarkan membuat project nyata dengan standar startup modern. Mental problem-solving dan kemandirian terasah sejak kelas 10.",
        photo: "https://images.unsplash.com/photo-1544717305-2782549b5136?w=500&auto=format&fit=crop&q=80",
        linkedin: "https://linkedin.com"
      }
    ];

    let currentAlumniIndex = 0;
    function updateAlumniView() {
      const item = alumniList[currentAlumniIndex];
      document.getElementById('alumni-name').textContent = "— " + item.name;
      document.getElementById('alumni-role').textContent = item.role;
      document.getElementById('alumni-quote').textContent = '"' + item.quote + '"';
      document.getElementById('alumni-img').src = item.photo;
      document.getElementById('alumni-badge').textContent = item.jurusan;
      document.getElementById('alumni-jurusan').textContent = item.jurusan;
      document.getElementById('alumni-linkedin').href = item.linkedin;
      for (let i = 0; i < 3; i++) {
        const dot = document.getElementById('dot-' + i);
        if (dot) dot.className = i === currentAlumniIndex
          ? "transition-all duration-300 rounded-full h-2 w-7 bg-red-700"
          : "transition-all duration-300 rounded-full h-2 w-2 bg-gray-300 hover:bg-gray-400";
      }
    }
    function setAlumniSlide(idx) { currentAlumniIndex = idx; updateAlumniView(); }
    function prevAlumni() { currentAlumniIndex = (currentAlumniIndex - 1 + alumniList.length) % alumniList.length; updateAlumniView(); }
    function nextAlumni() { currentAlumniIndex = (currentAlumniIndex + 1) % alumniList.length; updateAlumniView(); }

    // ===== Filter Berita =====
    function filterNewsCategory(category, activeBtn) {
      document.querySelectorAll('.news-tab').forEach(tab => {
        tab.className = "news-tab px-4 py-1.5 rounded-full text-xs font-semibold bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition";
      });
      if (activeBtn) activeBtn.className = "news-tab px-4 py-1.5 rounded-full text-xs font-bold bg-red-700 text-white transition";
      document.querySelectorAll('.news-item-card').forEach(card => {
        card.style.display = (category === 'Semua' || card.getAttribute('data-cat') === category) ? 'flex' : 'none';
      });
    }
    function scrollNewsGrid(dir) {
      const c = document.getElementById('news-grid-container');
      if (c) c.scrollBy({ left: dir * 350, behavior: 'smooth' });
    }

    // ===== Data Berita =====
    const newsDetails = [
      { title: "Kunjungan Industri Siswa Skomda ke Data Center Nasional Telkom Group", category: "Kegiatan Sekolah", date: "2026-06-07", image: "https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&auto=format&fit=crop&q=80", author: "Humas Skomda", content: "Sebanyak 150 siswa dari jurusan SIJA dan TJAT SMK Telkom Sidoarjo mengikuti program tahunan Kunjungan Industri (KI) ke fasilitas Hyperscale Data Center Telkom Group. Kegiatan ini bertujuan memperkaya wawasan siswa mengenai infrastruktur server berdaya tampung besar, sistem pendingin presisi tinggi, dan arsitektur pengamanan data fisik maupun cyber." },
      { title: "Juara 1 Lomba Web Design Tingkat Provinsi Jawa Timur 2026", category: "Prestasi", date: "2026-06-05", image: "https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800&auto=format&fit=crop&q=80", author: "Tim Kesiswaan", content: "Prestasi membanggakan kembali diukir oleh siswa SMK Telkom Sidoarjo dalam ajang bergengsi LKS Tingkat Provinsi Jawa Timur 2026 bidang Web Technologies. Ananda Muhammad Fauzan berhasil mengungguli 38 kontestan lainnya dengan membangun aplikasi portal e-commerce ramah disabilitas dalam waktu kompetisi 6 jam." },
      { title: "Penandatanganan MoU Kelas Industri Bersama Mitra Telekomunikasi", category: "Kemitraan & Kerjasama", date: "2026-06-01", image: "https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80", author: "Hubungan Industri", content: "Bertempat di Graha Widya Skomda, Kepala SMK Telkom Sidoarjo bersama jajaran pimpinan mitra industri resmi menandatangani Nota Kesepahaman (MoU) Program Kelas Industri Fiber Optik 2026. Melalui kolaborasi ini, kurikulum industri akan diserap langsung ke pembelajaran sekolah." }
    ];
    function openNewsDetail(idx) {
      const item = newsDetails[idx];
      if (!item) return;
      document.getElementById('news-modal-title').textContent = item.title;
      document.getElementById('news-modal-cat').textContent = item.category;
      document.getElementById('news-modal-date').textContent = item.date;
      document.getElementById('news-modal-img').src = item.image;
      document.getElementById('news-modal-content').textContent = item.content;
      document.getElementById('news-modal-author').textContent = "Ditulis oleh: " + item.author;
      const m = document.getElementById('modal-news');
      m.classList.remove('hidden'); m.classList.add('flex');
    }
    function closeNewsDetail() {
      const m = document.getElementById('modal-news');
      m.classList.add('hidden'); m.classList.remove('flex');
    }

    // ===== Modal JURUFIND =====
    function openJurufindModal() {
      const m = document.getElementById('modal-jurufind');
      m.classList.remove('hidden'); m.classList.add('flex');
    }
    function closeJurufindModal() {
      const m = document.getElementById('modal-jurufind');
      m.classList.add('hidden'); m.classList.remove('flex');
      document.getElementById('quiz-question-box').classList.remove('hidden');
      document.getElementById('quiz-result-box').classList.add('hidden');
    }
    function submitQuizAnswer(type) {
      document.getElementById('quiz-question-box').classList.add('hidden');
      document.getElementById('quiz-result-box').classList.remove('hidden');
      if (type === 'SIJA') {
        document.getElementById('quiz-result-title').textContent = "Jurusan SIJA (95% Cocok)";
        document.getElementById('quiz-result-desc').textContent = "Kamu memiliki bakat kuat dalam coding, pembuatan aplikasi web/mobile, dan arsitektur software!";
      } else {
        document.getElementById('quiz-result-title').textContent = "Jurusan TJAT (95% Cocok)";
        document.getElementById('quiz-result-desc').textContent = "Kamu sangat cocok mendalami infrastruktur telekomunikasi, serat optik, dan perangkat jaringan Cisco!";
      }
    }

    // ===== Modal PPDB =====
    function openPpdbModal() {
      const m = document.getElementById('modal-ppdb');
      m.classList.remove('hidden'); m.classList.add('flex');
    }
    function closePpdbModal() {
      const m = document.getElementById('modal-ppdb');
      m.classList.add('hidden'); m.classList.remove('flex');
    }
    function handlePpdbSubmit(e) {
      e.preventDefault();
      document.getElementById('ppdb-form').classList.add('hidden');
      document.getElementById('ppdb-success').classList.remove('hidden');
    }

    // ===== Modal Detail Program =====
    function openProgramDetail(id) {
      const m = document.getElementById('modal-program');
      m.classList.remove('hidden'); m.classList.add('flex');
      if (id === 'SIJA') {
        document.getElementById('prog-badge').textContent = "Program 4 Tahun (SIJA)";
        document.getElementById('prog-title').textContent = "Sistem Informasi Jaringan & Aplikasi";
        document.getElementById('prog-desc').textContent = "Mencetak Software Engineer & Cloud Architect handal dengan magang industri penuh selama 1 tahun di tahun ke-4.";
      } else {
        document.getElementById('prog-badge').textContent = "Program 3 Tahun (TJAT)";
        document.getElementById('prog-title').textContent = "Teknik Jaringan Akses Telekomunikasi";
        document.getElementById('prog-desc').textContent = "Mencetak Network Engineer, fiber optic specialist, dan teknisi telekomunikasi bersertifikasi industri internasional.";
      }
    }
    function closeProgramDetail() {
      const m = document.getElementById('modal-program');
      m.classList.add('hidden'); m.classList.remove('flex');
    }
