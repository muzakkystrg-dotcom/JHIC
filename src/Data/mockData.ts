import { NewsItem, AlumniTestimonial, PartnerItem, JurusanDetail, QuizQuestion } from '../types';

export const JURUSAN_DATA: Record<'SIJA' | 'TJAT', JurusanDetail> = {
  SIJA: {
    id: 'SIJA',
    name: 'SIJA',
    fullName: 'Sistem Informasi Jaringan & Aplikasi',
    duration: 'Program 4 Tahun (Vokasi Unggulan)',
    description: 'Belajar merancang, membangun, dan mengembangkan aplikasi perangkat lunak modern, website interaktif, arsitektur cloud computing, dan integrasi API yang digunakan di industri digital masa kini.',
    suitableFor: [
      'Suka coding & membuat aplikasi',
      'Senang berpikir logis dan memecahkan masalah',
      'Tertarik pada teknologi AI, web, dan mobile apps',
      'Senang berkreasi dalam desain antarmuka (UI/UX)'
    ],
    careerProspects: [
      'Software Engineer',
      'Web Developer',
      'UI/UX Designer',
      'Mobile App Developer',
      'Cloud DevOps Engineer',
      'Database Administrator'
    ],
    keySubjects: [
      'Algoritma & Pemrograman Berorientasi Objek',
      'Pengembangan Web Fullstack (React, Node.js)',
      'Basis Data Relasional & NoSQL',
      'Cloud Infrastructure & Virtualization',
      'Keamanan Aplikasi & RESTful API'
    ],
    certifications: [
      'Oracle Certified Associate (OCA)',
      'MikroTik Certified Network Associate (MTCNA)',
      'BNSP Rekayasa Perangkat Lunak',
      'AWS Certified Cloud Practitioner'
    ],
    labs: [
      'Laboratorium Software Development & AI',
      'Laboratorium Multimedia & UI/UX Studio',
      'Laboratorium Cloud & Data Center Mini'
    ],
    color: 'from-red-600 to-red-800'
  },
  TJAT: {
    id: 'TJAT',
    name: 'TJAT',
    fullName: 'Teknik Jaringan Akses Telekomunikasi',
    duration: 'Program 3 Tahun (Standar Industri Telkom)',
    description: 'Belajar merancang, mengkonfigurasi, dan memelihara infrastruktur jaringan telekomunikasi kabel fiber optic, wireless microwave, sistem transmisi seluler (4G/5G), dan routing enterprise.',
    suitableFor: [
      'Tertarik jaringan & internet berkecepatan tinggi',
      'Suka praktik perangkat jaringan dan kabel optik',
      'Tertarik dengan infrastruktur 5G dan transmisi data',
      'Senang investigasi troubleshooting jaringan'
    ],
    careerProspects: [
      'Network Engineer',
      'IT Support & Infrastructure',
      'Fiber Optic Technician',
      'Telecommunication System Engineer',
      'NOC (Network Operation Center) Specialist',
      'Wireless & Microwave Technician'
    ],
    keySubjects: [
      'Teknologi Jaringan Akses Fiber Optik (FTTx)',
      'Routing & Switching Enterprise (Cisco/MikroTik)',
      'Sistem Komunikasi Seluler & Gelombang Mikro',
      'Instalasi Perangkat Transmisi & Sentral Telepon',
      'K3 & Standar Operasional Telkom Group'
    ],
    certifications: [
      'Cisco Certified Network Associate (CCNA)',
      'MikroTik Certified Routing Engineer (MTCRE)',
      'Sertifikasi Teknisi Fiber Optik (BNSP / Telkom Akses)',
      'Huawei Certified ICT Associate (HCIA)'
    ],
    labs: [
      'Laboratorium Fiber Optik & Splicing',
      'Laboratorium Cisco & Networking Enterprise',
      'Mini Telkom Exchange & Antenna Tower Outdoor'
    ],
    color: 'from-slate-800 to-slate-900'
  }
};

export const ALUMNI_TESTIMONIALS: AlumniTestimonial[] = [
  {
    id: 'alumni-1',
    name: 'Aisyah Putri Ramadhani',
    jurusan: 'SIJA',
    currentRole: 'Mahasiswi Teknik Informatika',
    institution: 'Institut Teknologi Bandung',
    quote: 'Sekolah disini asyik banget, gabakal nyesel buat para orang tua yang nyari calon sekolah buat anaknya sih! Fasilitas lengkap dan gurunya suportif banget.',
    image: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500&auto=format&fit=crop&q=80',
    linkedinUrl: 'https://linkedin.com',
    graduationYear: 2024
  },
  {
    id: 'alumni-2',
    name: 'Rafi Pratama Hendrawan',
    jurusan: 'TJAT',
    currentRole: 'Network Operations Specialist',
    institution: 'PT Telkom Indonesia (Persero) Tbk',
    quote: 'Kurikulum praktikum di Skomda sangat relevan dengan kebutuhan industri telekomunikasi. Sertifikasi internasional yang didapat saat sekolah menjadi tiket emas diterima kerja sebelum wisuda.',
    image: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&auto=format&fit=crop&q=80',
    linkedinUrl: 'https://linkedin.com',
    graduationYear: 2023
  },
  {
    id: 'alumni-3',
    name: 'Nabila Zahra Syahrani',
    jurusan: 'SIJA',
    currentRole: 'Associate Frontend Engineer',
    institution: 'GoTo Financial',
    quote: 'Di program Digitalent Skomda, kami diajarkan membuat project nyata dengan standar startup modern. Mental problem-solving dan kemandirian terasah sejak kelas 10.',
    image: 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=500&auto=format&fit=crop&q=80',
    linkedinUrl: 'https://linkedin.com',
    graduationYear: 2022
  }
];

export const PARTNERS: PartnerItem[] = [
  { name: 'JAVA CREATION', category: 'Software House', color: 'text-gray-800' },
  { name: 'radnext', category: 'Internet Service Provider', color: 'text-blue-600' },
  { name: 'markaz', category: 'Digital Agency', color: 'text-red-600' },
  { name: 'AXELBIT', category: 'Network Solution', color: 'text-slate-900' },
  { name: 'GARUDA', category: 'IT Academy', color: 'text-red-700' },
  { name: 'TELKOM INDONESIA', category: 'Telecommunication', color: 'text-red-600' },
  { name: 'TELKOM AKSES', category: 'Infrastructure', color: 'text-red-700' },
  { name: 'CISCO ACADEMY', category: 'Networking', color: 'text-blue-700' },
  { name: 'MIKROTIK ACADEMY', category: 'Routing', color: 'text-slate-800' }
];

export const NEWS_ITEMS: NewsItem[] = [
  {
    id: 'news-1',
    title: 'Kunjungan Industri Siswa Skomda ke Data Center Nasional Telkom Group',
    category: 'Kegiatan Sekolah',
    date: '2026-06-07',
    image: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&auto=format&fit=crop&q=80',
    badges: ['SIJA', 'TJAT'],
    summary: 'Ratusan siswa kelas XI SMK Telkom Sidoarjo meninjau secara langsung teknologi data center tier 3 berstandar internasional di Surabaya.',
    content: 'Sebanyak 150 siswa dari jurusan SIJA dan TJAT SMK Telkom Sidoarjo mengikuti program tahunan Kunjungan Industri (KI) ke fasilitas Hyperscale Data Center Telkom Group. Kegiatan ini bertujuan memperkaya wawasan siswa mengenai infrastruktur server berdaya tampung besar, sistem pendingin presisi tinggi, dan arsitektur pengamanan data fisik maupun cyber.',
    author: 'Humas Skomda',
    readTime: '3 menit baca'
  },
  {
    id: 'news-2',
    title: 'Juara 1 Lomba Web Design Tingkat Provinsi Jawa Timur 2026',
    category: 'Prestasi',
    date: '2026-06-05',
    image: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800&auto=format&fit=crop&q=80',
    badges: ['SIJA'],
    summary: 'Tim perwakilan SIJA Skomda kembali membuktikan keunggulannya dengan menyabet medali emas dalam ajang Lomba Keterampilan Siswa (LKS).',
    content: 'Prestasi membanggakan kembali diukir oleh siswa SMK Telkom Sidoarjo dalam ajang bergengsi LKS Tingkat Provinsi Jawa Timur 2026 bidang Web Technologies. Ananda Muhammad Fauzan berhasil mengungguli 38 kontestan lainnya dengan membangun aplikasi portal e-commerce ramah disabilitas dalam waktu kompetisi 6 jam.',
    author: 'Tim Kesiswaan',
    readTime: '4 menit baca'
  },
  {
    id: 'news-3',
    title: 'Penandatanganan MoU Kelas Industri Bersama Mitra Telekomunikasi',
    category: 'Kemitraan & Kerjasama',
    date: '2026-06-01',
    image: 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80',
    badges: ['TJAT'],
    summary: 'Kerjasama strategis ini membuka jalur magang prioritas dan rekrutmen kerja langsung sebelum kelulusan bagi siswa jurusan TJAT.',
    content: 'Bertempat di Graha Widya Skomda, Kepala SMK Telkom Sidoarjo bersama jajaran pimpinan mitra industri resmi menandatangani Nota Kesepahaman (MoU) Program Kelas Industri Fiber Optik 2026. Melalui kolaborasi ini, kurikulum industri akan diserap langsung ke pembelajaran sekolah.',
    author: 'Hubungan Industri',
    readTime: '3 menit baca'
  },
  {
    id: 'news-4',
    title: 'Inovasi Siswa: Smart School Security Berbasis AI dan Face Recognition',
    category: 'Karya & Inovasi',
    date: '2026-05-24',
    image: 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=800&auto=format&fit=crop&q=80',
    badges: ['SIJA', 'TJAT'],
    summary: 'Kolaborasi lintas jurusan menghasilkan sistem absensi otomatis dan pengawasan gerbang sekolah pintar tanpa antrean.',
    content: 'Proyek akhir kolaboratif antara siswa SIJA yang menangani model computer vision dan siswa TJAT yang merancang jaringan kamera IP gigabit sukses diujicobakan pada gerbang utama sekolah. Sistem ini mampu mengidentifikasi siswa dalam waktu kurang dari 0.3 detik.',
    author: 'Lab Digitalent',
    readTime: '4 menit baca'
  },
  {
    id: 'news-5',
    title: 'Sharing Session Alumni: Berkarir di Silicon Valley dan Startup Unicorn',
    category: 'Alumni',
    date: '2026-05-18',
    image: 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=800&auto=format&fit=crop&q=80',
    badges: ['SIJA'],
    summary: 'Alumni angkatan 2019 berbagi tips portofolio global dan adaptasi teknologi software engineering terbaru kepada adik kelas.',
    content: 'Lebih dari 300 siswa antusias menyimak webinar interaktif bersama alumni Skomda yang saat ini bekerja secara remote untuk perusahaan teknologi terkemuka. Pembicara menekankan pentingnya penguasaan fondasi matematika, komunikasi bahasa Inggris, dan portfolio GitHub.',
    author: 'Career Center',
    readTime: '5 menit baca'
  }
];

export const QUIZ_QUESTIONS: QuizQuestion[] = [
  {
    id: 1,
    question: 'Saat menggunakan komputer atau smartphone, aktivitas mana yang paling membuatmu penasaran?',
    optionA: {
      text: 'Bagaimana aplikasi, tombol, dan tampilannya dibuat lewat kode pemrograman (Software)',
      target: 'SIJA',
      explanation: 'Kamu memiliki kecenderungan kuat ke Rekayasa Perangkat Lunak & Aplikasi!'
    },
    optionB: {
      text: 'Bagaimana sinyal WiFi, kabel fiber optik, dan internet bisa tersambung cepat ke seluruh dunia (Jaringan)',
      target: 'TJAT',
      explanation: 'Kamu memiliki bakat alami ke arah Infrastruktur Jaringan & Telekomunikasi!'
    }
  },
  {
    id: 2,
    question: 'Jika kamu diberi tugas proyek kelompok, peran mana yang paling ingin kamu ambil?',
    optionA: {
      text: 'Membuat logika website, mendesain tampilan menarik, atau mengolah database',
      target: 'SIJA',
      explanation: 'Cocok dengan peran Developer & Designer di SIJA'
    },
    optionB: {
      text: 'Memasang router, menyambung kabel transmisi, dan memastikan koneksi internet lancar stabil',
      target: 'TJAT',
      explanation: 'Cocok dengan peran Network Engineer & Specialist di TJAT'
    }
  },
  {
    id: 3,
    question: 'Tantangan mana yang lebih membuatmu bersemangat?',
    optionA: {
      text: 'Menemukan bug kode program dan merancang fitur otomatisasi baru yang bermanfaat bagi orang banyak',
      target: 'SIJA',
      explanation: 'Minat coding dan problem solving software kamu sangat menonjol!'
    },
    optionB: {
      text: 'Melakukan konfigurasi perangkat server, routing mikrotik, atau menyambung kabel fiber optik dengan presisi',
      target: 'TJAT',
      explanation: 'Ketelitian teknis perangkat keras telekomunikasi kamu sangat tinggi!'
    }
  },
  {
    id: 4,
    question: 'Cita-cita profesi masa depan mana yang paling memikat impianmu?',
    optionA: {
      text: 'Software Engineer, Fullstack Web Developer, UI/UX Designer, atau AI Application Builder',
      target: 'SIJA',
      explanation: 'Pilihan karir ini selaras 100% dengan kurikulum 4 tahun SIJA!'
    },
    optionB: {
      text: 'Network Engineer, Fiber Optic Specialist, Telekomunikasi System Engineer di Telkom Group',
      target: 'TJAT',
      explanation: 'Pilihan karir ini merupakan spesialisasi unggulan program TJAT!'
    }
  }
];
